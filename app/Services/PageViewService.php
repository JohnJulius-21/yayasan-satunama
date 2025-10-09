<?php

namespace App\Services;

use App\Models\pageview;
use App\Models\conversionevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PageViewService
{
    /**
     * Record page view dengan UTM tracking dan referrer
     */
    public function recordView(Request $request, string $url, array $options = []): bool
    {
        // Generate atau ambil visitor ID dari cookie (untuk tracking cross-session)
        $visitorId = $this->getOrCreateVisitorId($request);
        $sessionId = $request->session()->getId();
        $cacheKey = "page_view:{$url}:{$sessionId}";

        // Throttle: hanya catat 1x per session per URL dalam 30 menit
        if (Cache::has($cacheKey)) {
            return false;
        }

        // Ambil UTM parameters untuk ads tracking
        $utmParams = $this->extractUtmParameters($request);

        // Ambil referrer
        $referrer = $request->headers->get('referer');
        $referrerDomain = $referrer ? parse_url($referrer, PHP_URL_HOST) : null;

        pageview::create([
            'url' => $url,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'session_id' => $sessionId,
            'visitor_id' => $visitorId,
            'referrer' => $referrer,
            'referrer_domain' => $referrerDomain,

            // UTM Parameters untuk ads tracking
            'utm_source' => $utmParams['utm_source'] ?? null,
            'utm_medium' => $utmParams['utm_medium'] ?? null,
            'utm_campaign' => $utmParams['utm_campaign'] ?? null,
            'utm_term' => $utmParams['utm_term'] ?? null,
            'utm_content' => $utmParams['utm_content'] ?? null,

            // Additional tracking
            'device_type' => $this->getDeviceType($request),
            'browser' => $this->getBrowser($request),
            'platform' => $this->getPlatform($request),
            'country' => $options['country'] ?? null, // Bisa pakai GeoIP

            'viewed_at' => now()
        ]);

        // Set cache 30 menit
        Cache::put($cacheKey, true, now()->addMinutes(30));

        // Clear cache statistik
        $this->clearStatsCache($url);

        return true;
    }

    /**
     * Track conversion event (misal: klik tombol daftar)
     */
    public function recordConversion(Request $request, string $eventName, array $data = []): void
    {
        $visitorId = $this->getOrCreateVisitorId($request);

        conversionevent::create([
            'visitor_id' => $visitorId,
            'session_id' => $request->session()->getId(),
            'event_name' => $eventName,
            'event_data' => json_encode($data),
            'url' => $request->fullUrl(),
            'utm_source' => $request->get('utm_source'),
            'utm_campaign' => $request->get('utm_campaign'),
            'created_at' => now()
        ]);
    }

    /**
     * Dapatkan statistik lengkap dengan ads performance
     */
    public function getStats(string $url): array
    {
        return Cache::remember("page_stats:{$url}", now()->addMinutes(5), function () use ($url) {
            return [
                // Basic stats
                'total_views' => pageview::where('url', $url)->count(),
                'unique_visitors' => pageview::where('url', $url)->distinct('visitor_id')->count(),
                'views_today' => pageview::where('url', $url)
                    ->whereDate('viewed_at', today())
                    ->count(),
                'views_this_week' => pageview::where('url', $url)
                    ->where('viewed_at', '>=', now()->startOfWeek())
                    ->count(),
                'views_this_month' => pageview::where('url', $url)
                    ->where('viewed_at', '>=', now()->startOfMonth())
                    ->count(),

                // Ads performance
                'top_sources' => $this->getTopSources($url, 5),
                'top_campaigns' => $this->getTopCampaigns($url, 5),
                'top_referrers' => $this->getTopReferrers($url, 5),

                // Device breakdown
                'device_breakdown' => $this->getDeviceBreakdown($url),

                // Traffic sources breakdown
                'traffic_sources' => $this->getTrafficSources($url),
            ];
        });
    }

    /**
     * Get conversion rate by campaign
     */
    public function getCampaignPerformance(string $url, int $days = 30): array
    {
        $views = pageview::where('url', $url)
            ->where('viewed_at', '>=', now()->subDays($days))
            ->whereNotNull('utm_campaign')
            ->get();

        $performance = [];

        foreach ($views->groupBy('utm_campaign') as $campaign => $campaignViews) {
            $visitorIds = $campaignViews->pluck('visitor_id')->unique();

            $conversions = conversionevent::whereIn('visitor_id', $visitorIds)
                ->where('utm_campaign', $campaign)
                ->count();

            $performance[] = [
                'campaign' => $campaign,
                'views' => $campaignViews->count(),
                'unique_visitors' => $visitorIds->count(),
                'conversions' => $conversions,
                'conversion_rate' => $campaignViews->count() > 0
                    ? round(($conversions / $campaignViews->count()) * 100, 2)
                    : 0,
                'source' => $campaignViews->first()->utm_source ?? 'unknown'
            ];
        }

        return collect($performance)->sortByDesc('views')->values()->all();
    }

    /**
     * Daily stats untuk grafik
     */
    public function getDailyStats(string $url, int $days = 30): array
    {
        return pageview::where('url', $url)
            ->where('viewed_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(viewed_at) as date, COUNT(*) as views, COUNT(DISTINCT visitor_id) as unique_visitors')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }

    // ==================== HELPER METHODS ====================

    protected function getOrCreateVisitorId(Request $request): string
    {
        $cookieName = 'visitor_id';

        if ($request->hasCookie($cookieName)) {
            return $request->cookie($cookieName);
        }

        $visitorId = Str::uuid()->toString();
        cookie()->queue($cookieName, $visitorId, 525600); // 1 tahun

        return $visitorId;
    }

    protected function extractUtmParameters(Request $request): array
    {
        return [
            'utm_source' => $request->get('utm_source'),
            'utm_medium' => $request->get('utm_medium'),
            'utm_campaign' => $request->get('utm_campaign'),
            'utm_term' => $request->get('utm_term'),
            'utm_content' => $request->get('utm_content'),
        ];
    }

    protected function getDeviceType(Request $request): string
    {
        $userAgent = $request->userAgent();

        if (preg_match('/mobile|android|iphone|ipad|phone/i', $userAgent)) {
            return 'mobile';
        } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
            return 'tablet';
        }

        return 'desktop';
    }

    protected function getBrowser(Request $request): ?string
    {
        $userAgent = $request->userAgent();

        if (preg_match('/Firefox/i', $userAgent)) return 'Firefox';
        if (preg_match('/Chrome/i', $userAgent)) return 'Chrome';
        if (preg_match('/Safari/i', $userAgent)) return 'Safari';
        if (preg_match('/Edge/i', $userAgent)) return 'Edge';
        if (preg_match('/Opera|OPR/i', $userAgent)) return 'Opera';

        return 'Other';
    }

    protected function getPlatform(Request $request): ?string
    {
        $userAgent = $request->userAgent();

        if (preg_match('/Windows/i', $userAgent)) return 'Windows';
        if (preg_match('/Mac/i', $userAgent)) return 'MacOS';
        if (preg_match('/Linux/i', $userAgent)) return 'Linux';
        if (preg_match('/Android/i', $userAgent)) return 'Android';
        if (preg_match('/iOS|iPhone|iPad/i', $userAgent)) return 'iOS';

        return 'Other';
    }

    protected function getTopSources(string $url, int $limit): array
    {
        return pageview::where('url', $url)
            ->whereNotNull('utm_source')
            ->selectRaw('utm_source, COUNT(*) as count')
            ->groupBy('utm_source')
            ->orderByDesc('count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    protected function getTopCampaigns(string $url, int $limit): array
    {
        return pageview::where('url', $url)
            ->whereNotNull('utm_campaign')
            ->selectRaw('utm_campaign, utm_source, COUNT(*) as count')
            ->groupBy('utm_campaign', 'utm_source')
            ->orderByDesc('count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    protected function getTopReferrers(string $url, int $limit): array
    {
        return pageview::where('url', $url)
            ->whereNotNull('referrer_domain')
            ->selectRaw('referrer_domain, COUNT(*) as count')
            ->groupBy('referrer_domain')
            ->orderByDesc('count')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    protected function getDeviceBreakdown(string $url): array
    {
        return pageview::where('url', $url)
            ->selectRaw('device_type, COUNT(*) as count')
            ->groupBy('device_type')
            ->get()
            ->pluck('count', 'device_type')
            ->toArray();
    }

    protected function getTrafficSources(string $url): array
    {
        $total = pageview::where('url', $url)->count();

        $direct = pageview::where('url', $url)
            ->whereNull('referrer')
            ->whereNull('utm_source')
            ->count();

        $organic = pageview::where('url', $url)
            ->whereNotNull('referrer')
            ->whereNull('utm_source')
            ->whereNotIn('referrer_domain', ['facebook.com', 'instagram.com', 'twitter.com'])
            ->count();

        $social = pageview::where('url', $url)
            ->whereIn('referrer_domain', ['facebook.com', 'instagram.com', 'twitter.com', 'linkedin.com'])
            ->count();

        $paid = pageview::where('url', $url)
            ->whereNotNull('utm_source')
            ->count();

        return [
            'direct' => ['count' => $direct, 'percentage' => $total > 0 ? round(($direct / $total) * 100, 2) : 0],
            'organic' => ['count' => $organic, 'percentage' => $total > 0 ? round(($organic / $total) * 100, 2) : 0],
            'social' => ['count' => $social, 'percentage' => $total > 0 ? round(($social / $total) * 100, 2) : 0],
            'paid' => ['count' => $paid, 'percentage' => $total > 0 ? round(($paid / $total) * 100, 2) : 0],
        ];
    }

    protected function clearStatsCache(string $url): void
    {
        Cache::forget("page_stats:{$url}");
    }
}
