<?php

namespace App\Http\Controllers;

use App\Models\ctga;
use App\Models\negara;
use App\Models\reguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\PageViewService;

class CtgaController extends Controller
{
    protected $pageViewService;

    public function __construct(PageViewService $pageViewService)
    {
        $this->pageViewService = $pageViewService;
    }

    /**
     * Track scroll depth untuk engagement measurement
     */
    public function trackScrollDepth(Request $request)
    {
        $request->validate([
            'depth' => 'required|integer|min:0|max:100',
            'page_url' => 'required|url'
        ]);

        $this->pageViewService->recordConversion($request, 'scroll_depth', [
            'depth' => $request->get('depth'),
            'page_url' => $request->get('page_url'),
            'timestamp' => now()->toISOString()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Track external link clicks
     */
    public function trackExternalLink(Request $request)
    {
        $request->validate([
            'destination' => 'required|url',
            'page_url' => 'required|url',
            'link_text' => 'nullable|string'
        ]);

        $this->pageViewService->recordConversion($request, 'external_link_click', [
            'destination' => $request->get('destination'),
            'page_url' => $request->get('page_url'),
            'link_text' => $request->get('link_text'),
            'timestamp' => now()->toISOString()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Track registration button click
     */
    public function trackRegistrationClick(Request $request)
    {
        $request->validate([
            'button_id' => 'nullable|string',
            'page_url' => 'required|url'
        ]);

        $this->pageViewService->recordConversion($request, 'registration_click', [
            'button_id' => $request->get('button_id'),
            'page_url' => $request->get('page_url'),
            'timestamp' => now()->toISOString()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Track form submission
     */
    public function trackRegistrationSubmit(Request $request)
    {
        $request->validate([
            'form_id' => 'nullable|string',
            'batch' => 'nullable|string'
        ]);

        $this->pageViewService->recordConversion($request, 'registration_submit', [
            'form_id' => $request->get('form_id'),
            'batch' => $request->get('batch'),
            'timestamp' => now()->toISOString()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Get statistics via API
     */
    public function getViewStats(Request $request)
    {
        $url = $request->get('url');

        if (!$url) {
            return response()->json(['error' => 'URL required'], 400);
        }

        $stats = $this->pageViewService->getStats($url);
        $dailyStats = $this->pageViewService->getDailyStats($url, 30);

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'daily_stats' => $dailyStats
            ]
        ]);
    }

    public function recordTimeOnPage(Request $request)
    {
        // Ambil raw JSON (karena sendBeacon biasanya kirim sebagai text/plain)
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Invalid payload'], 400);
        }

        // Validasi manual
        $validator = \Validator::make($data, [
            'url' => 'required|string|max:500',
            'duration' => 'required|integer|min:1',
            'visitor_id' => 'nullable|string|max:36',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Cari page view terakhir berdasarkan visitor + url
        $query = PageView::where('url', $validated['url'])
            ->orderBy('viewed_at', 'desc');

        if (!empty($validated['visitor_id'])) {
            $query->where('visitor_id', $validated['visitor_id']);
        }

        $pageView = $query->first();

        if ($pageView) {
            $pageView->duration_seconds = $validated['duration'];
            $pageView->exited_at = now();
            $pageView->save();
        }

        return response()->json(['success' => true]);
    }


    /**
     * Admin Dashboard untuk melihat statistik semua halaman
     * Route: GET /admin/ctga/stats
     */
    public function statsDashboard(Request $request)
    {
        $urls = [
            'main' => 'https://training.satunama.org/change-the-game-academy',
            'detail' => 'https://training.satunama.org/change-the-game-academy/detail-informasi-ms-ctga-batch-4',
            'batch4' => 'https://training.satunama.org/change-the-game-academy/ms-ctga-batch-4',
        ];

        $allStats = [];
        foreach ($urls as $key => $url) {
            $allStats[$key] = [
                'url' => $url,
                'stats' => $this->pageViewService->getStats($url),
                'daily_stats' => $this->pageViewService->getDailyStats($url, 30),
                'campaign_performance' => $this->pageViewService->getCampaignPerformance($url, 30)
            ];
        }

        return view('admin.ctga.stats', compact('allStats'));
    }

    public function indexAdmin()
    {
        return view('admin.ctga.index', [
            'title' => 'CTGA',
        ]);
    }

    public function showAdmin()
    {
        $lembaga = ctga::with(['negara', 'provinsi', 'kabupaten'])->get();
        return view('admin.ctga.show', compact('lembaga'),[
            'title' => 'CTGA',
        ]);
    }

    public function download($id)
    {
        $lembaga = ctga::findOrFail($id);

        // Jika file di storage/app/public
        $filePath = storage_path('app/public/' . $lembaga->legalitas_lembaga);

//        dd($filePath, file_exists($filePath)); // Cek path dan apakah file ada

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        $originalName = preg_replace('/^\d+_/', '', basename($lembaga->legalitas_lembaga));

        return response()->download($filePath, $originalName);
    }

    public function index(Request $request)
    {
        $trackingUrl = 'https://training.satunama.org/change-the-game-academy';

        // Record page view dengan UTM tracking
        $this->pageViewService->recordView($request, $trackingUrl);

        // Get stats
        $stats = $this->pageViewService->getStats($trackingUrl);
        $campaignPerformance = $this->pageViewService->getCampaignPerformance($trackingUrl, 30);
        return view('user.training.ctga.index', compact('stats', 'campaignPerformance'), [
            'title' => 'CTGA',
        ]);
    }

    public function create(Request $request)
    {
        $trackingUrl = 'https://training.satunama.org/change-the-game-academy/ms-ctga-batch-4';

        $this->pageViewService->recordView($request, $trackingUrl);
        $stats = $this->pageViewService->getStats($trackingUrl);
//        $id = $this->decodeHash($hash);
        $user = auth()->user();
//        $reguler = reguler::findOrFail($id);
        $negara = Negara::all();
        $jumlahPeserta = $request->query('jumlah', 1); // Default ke 1 jika tidak ada parameter
        return view('user.training.ctga.create', compact(
//            'reguler',
            'user',
            'negara',
            'jumlahPeserta',
            'stats',
        ), [
            'title' => 'CTGA',
        ]);
    }

    public function show(request $request)
    {
        $trackingUrl = 'https://training.satunama.org/change-the-game-academy/detail-informasi-ms-ctga-batch-4';
        $this->pageViewService->recordView($request, $trackingUrl);
        $stats = $this->pageViewService->getStats($trackingUrl);
        return view('user.training.ctga.show', compact('stats'), [
            'title' => 'CTGA',
        ]);
    }

    public function store(Request $request)
    {
        // Debug: Cek data yang masuk
        \Log::info('Data request:', $request->all());

        // Validasi
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'kontak_lembaga' => 'required|string|max:100',
            'email_lembaga' => 'required|email',
            'nama_pemimpin_lembaga' => 'required|string|max:100',
            'legalitas_lembaga' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'id_negara' => 'required|exists:negara,id',
            'id_provinsi' => 'required|exists:provinsi,id',
            'id_kabupaten' => 'required|exists:kabupaten_kota,id',
            'alamat_lembaga' => 'required|string|max:100',
        ], [
            'nama_lembaga.required' => 'Nama lembaga wajib diisi',
            'kontak_lembaga.required' => 'Kontak person wajib diisi',
            'email_lembaga.required' => 'Email wajib diisi',
            'email_lembaga.email' => 'Format email harus benar',
            'nama_pemimpin_lembaga.required' => 'Nama pemimpin lembaga wajib diisi',
            'legalitas_lembaga.required' => 'File legalitas lembaga wajib diupload',
            'legalitas_lembaga.mimes' => 'File harus berformat pdf,jpg,jpeg,png,doc,docx',
            'legalitas_lembaga.max' => 'Ukuran file maksimal 5MB',
            'id_negara.required' => 'Negara wajib dipilih',
            'id_provinsi.required' => 'Provinsi wajib dipilih',
            'id_kabupaten.required' => 'Kota/Kabupaten wajib dipilih',
            'alamat_lembaga.required' => 'Alamat lengkap lembaga wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            // Upload file
            $legalitasPath = null;
            if ($request->hasFile('legalitas_lembaga')) {
                $file = $request->file('legalitas_lembaga');

                // Validasi file
                if (!$file->isValid()) {
                    throw new \Exception('File tidak valid');
                }

                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
                $legalitasPath = $file->storeAs('legalitas', $filename, 'public');

                \Log::info('File uploaded:', ['path' => $legalitasPath]);
            }

            // Insert ke database menggunakan DB Query Builder
            $inserted = DB::table('registrasi_ctga')->insert([
                'nama_lembaga' => $validated['nama_lembaga'],
                'kontak_lembaga' => $validated['kontak_lembaga'],
                'nama_pemimpin_lembaga' => $validated['nama_pemimpin_lembaga'],
                'legalitas_lembaga' => $legalitasPath,
                'id_negara' => $validated['id_negara'],
                'id_provinsi' => $validated['id_provinsi'],
                'id_kabupaten' => $validated['id_kabupaten'],
                'alamat_lembaga' => $validated['alamat_lembaga'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$inserted) {
                throw new \Exception('Gagal menyimpan data ke database');
            }

            DB::commit();

            \Log::info('Data berhasil disimpan');

            return redirect()->back()->with('success', 'Pendaftaran pelatihan berhasil! Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error detail
            \Log::error('Error saat menyimpan registrasi:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Hapus file jika gagal
            if ($legalitasPath && Storage::disk('public')->exists($legalitasPath)) {
                Storage::disk('public')->delete($legalitasPath);
                \Log::info('File deleted due to error');
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
