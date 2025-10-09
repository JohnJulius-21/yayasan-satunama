@extends('layouts.app')

@section('title', 'Admin | Statistik MS Change the Game Batch 4')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        .loading {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-6 pb-4 mb-6 space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-900">MS Change the Game Batch 4</h1>
    </div>
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📊 Dashboard Statistik CTGA</h1>
                    <p class="text-sm text-gray-600">Monitoring & Analytics - Real Time</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Last Updated</div>
                    <div id="lastUpdate" class="text-lg font-semibold text-blue-600">--:--:--</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">

        <!-- Summary Cards - Overview Semua Halaman -->
        <div class="mb-8">
            <h2 class="text-xxl font-bold text-gray-800 mb-4">📈 Overview - Semua Halaman</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($allStats as $key => $data)
                    <div class="stat-card bg-white rounded-xl shadow-md p-6 border-l-4
                    {{ $key === 'main' ? 'border-blue-500' : '' }}
                    {{ $key === 'detail' ? 'border-green-500' : '' }}
                    {{ $key === 'batch4' ? 'border-purple-500' : '' }}">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase">
                                @if($key === 'main')
                                    🏠 Halaman Utama
                                @elseif($key === 'detail')
                                    📄 Detail Info
                                @else
                                    🎓 MS Batch 4
                                @endif
                            </h3>
                            <span class="text-2xl">
                            @if($key === 'main') 🏠
                                @elseif($key === 'detail') 📄
                                @else 🎓
                                @endif
                        </span>
                        </div>

                        <div class="mb-4">
                            <div class="text-4xl font-bold
                            {{ $key === 'main' ? 'text-blue-600' : '' }}
                            {{ $key === 'detail' ? 'text-green-600' : '' }}
                            {{ $key === 'batch4' ? 'text-purple-600' : '' }}">
                                {{ number_format($data['stats']['total_views']) }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">Total Views</div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-3 border-t">
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-800">{{ number_format($data['stats']['unique_visitors']) }}</div>
                                <div class="text-xs text-gray-500">Visitors</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-800">{{ number_format($data['stats']['views_today']) }}</div>
                                <div class="text-xs text-gray-500">Today</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-800">{{ number_format($data['stats']['views_this_week']) }}</div>
                                <div class="text-xs text-gray-500">Week</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-t-xl shadow-md">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px" role="tablist">
                    <button onclick="switchTab('main')"
                            class="tab-btn active flex-1 py-4 px-6 text-center text-sm font-medium border-b-2 border-blue-500 text-blue-600 hover:bg-blue-50 transition-colors">
                        🏠 Halaman Utama
                    </button>
                    <button onclick="switchTab('detail')"
                            class="tab-btn flex-1 py-4 px-6 text-center text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                        📄 Detail Informasi
                    </button>
                    <button onclick="switchTab('batch4')"
                            class="tab-btn flex-1 py-4 px-6 text-center text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors">
                        🎓 MS Batch 4
                    </button>
                </nav>
            </div>

            <!-- Tab Contents -->
            @foreach($allStats as $key => $data)
                <div id="tab-{{ $key }}" class="tab-content p-6 {{ $key !== 'main' ? 'hidden' : '' }}">

                    <!-- Key Metrics Row -->
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg">
                            <div class="text-xs text-blue-600 font-semibold mb-1">📅 This Week</div>
                            <div class="text-2xl font-bold text-blue-700">{{ number_format($data['stats']['views_this_week']) }}</div>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg">
                            <div class="text-xs text-green-600 font-semibold mb-1">📆 This Month</div>
                            <div class="text-2xl font-bold text-green-700">{{ number_format($data['stats']['views_this_month']) }}</div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg">
                            <div class="text-xs text-purple-600 font-semibold mb-1">💻 Desktop</div>
                            <div class="text-2xl font-bold text-purple-700">{{ $data['stats']['device_breakdown']['desktop'] ?? 0 }}</div>
                        </div>
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-lg">
                            <div class="text-xs text-orange-600 font-semibold mb-1">📱 Mobile</div>
                            <div class="text-2xl font-bold text-orange-700">{{ $data['stats']['device_breakdown']['mobile'] ?? 0 }}</div>
                        </div>
                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-4 rounded-lg">
                            <div class="text-xs text-pink-600 font-semibold mb-1">📲 Tablet</div>
                            <div class="text-2xl font-bold text-pink-700">{{ $data['stats']['device_breakdown']['tablet'] ?? 0 }}</div>
                        </div>
                    </div>

                    <!-- Charts & Stats Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                        <!-- Traffic Sources Chart -->
                        <div class="bg-white border rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <span class="mr-2">🎯</span> Traffic Sources
                            </h3>
                            <div class="space-y-3">
                                @foreach($data['stats']['traffic_sources'] as $source => $sourceData)
                                    <div class="relative">
                                        <div class="flex items-center justify-between mb-1">
                                            <div class="flex items-center">
                                        <span class="w-3 h-3 rounded-full mr-2
                                            {{ $source === 'direct' ? 'bg-blue-500' : '' }}
                                            {{ $source === 'organic' ? 'bg-green-500' : '' }}
                                            {{ $source === 'social' ? 'bg-purple-500' : '' }}
                                            {{ $source === 'paid' ? 'bg-orange-500' : '' }}">
                                        </span>
                                                <span class="font-medium capitalize text-sm">
                                            @if($source === 'direct') 🔗 Direct
                                                    @elseif($source === 'organic') 🔍 Organic
                                                    @elseif($source === 'social') 👥 Social
                                                    @else 💰 Paid Ads
                                                    @endif
                                        </span>
                                            </div>
                                            <div class="text-right">
                                                <span class="font-bold text-gray-800">{{ number_format($sourceData['count']) }}</span>
                                                <span class="text-xs text-gray-500 ml-2">({{ $sourceData['percentage'] }}%)</span>
                                            </div>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full transition-all duration-500
                                        {{ $source === 'direct' ? 'bg-blue-500' : '' }}
                                        {{ $source === 'organic' ? 'bg-green-500' : '' }}
                                        {{ $source === 'social' ? 'bg-purple-500' : '' }}
                                        {{ $source === 'paid' ? 'bg-orange-500' : '' }}"
                                                 style="width: {{ $sourceData['percentage'] }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Top Referrers -->
                        <div class="bg-white border rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <span class="mr-2">🌐</span> Top Referrers
                            </h3>
                            @if(!empty($data['stats']['top_referrers']))
                                <div class="space-y-2">
                                    @foreach($data['stats']['top_referrers'] as $index => $referrer)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                            <div class="flex items-center">
                                    <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mr-3">
                                        {{ $index + 1 }}
                                    </span>
                                                <span class="text-sm font-medium text-gray-700 truncate">{{ $referrer['referrer_domain'] }}</span>
                                            </div>
                                            <span class="font-bold text-gray-800 ml-2">{{ number_format($referrer['count']) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-400">
                                    <div class="text-4xl mb-2">📭</div>
                                    <p class="text-sm">Belum ada data referrer</p>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Campaign Performance Table -->
                    @if(!empty($data['campaign_performance']))
                        <div class="bg-white border rounded-lg p-6 shadow-sm mb-8">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <span class="mr-2">🎯</span> Campaign Performance (30 Days)
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Campaign</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Source</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Views</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Unique</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Conversions</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Conv. Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($data['campaign_performance'] as $campaign)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $campaign['campaign'] }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            {{ $campaign['source'] }}
                                        </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-gray-900">
                                                {{ number_format($campaign['views']) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700">
                                                {{ number_format($campaign['unique_visitors']) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-green-600">
                                                {{ number_format($campaign['conversions']) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full
                                            {{ $campaign['conversion_rate'] >= 5 ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $campaign['conversion_rate'] >= 2 && $campaign['conversion_rate'] < 5 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $campaign['conversion_rate'] < 2 ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $campaign['conversion_rate'] }}%
                                        </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Daily Trend Chart -->
                    <div class="bg-white border rounded-lg p-6 shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <span class="mr-2">📈</span> Views Trend (30 Days)
                        </h3>
                        <canvas id="chart-{{ $key }}" height="80"></canvas>
                    </div>

                </div>
            @endforeach

        </div>

    </div>


    <script>
        // Update timestamp
        function updateTimestamp() {
            const now = new Date();
            document.getElementById('lastUpdate').textContent = now.toLocaleTimeString('id-ID');
        }
        updateTimestamp();
        setInterval(updateTimestamp, 1000);

        // Tab switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600', 'bg-blue-50');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab
            document.getElementById(`tab-${tabName}`).classList.remove('hidden');

            // Activate button
            event.target.classList.add('active', 'border-blue-500', 'text-blue-600', 'bg-blue-50');
            event.target.classList.remove('border-transparent', 'text-gray-500');
        }

        // Initialize charts for all tabs
            @foreach($allStats as $key => $data)
        {
            const ctx{{ $key }} = document.getElementById('chart-{{ $key }}').getContext('2d');
            const dailyData{{ $key }} = @json($data['daily_stats']);

            new Chart(ctx{{ $key }}, {
                type: 'line',
                data: {
                    labels: dailyData{{ $key }}.map(d => {
                        const date = new Date(d.date);
                        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                    }),
                    datasets: [
                        {
                            label: 'Total Views',
                            data: dailyData{{ $key }}.map(d => d.views),
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: 'rgb(59, 130, 246)',
                        },
                        {
                            label: 'Unique Visitors',
                            data: dailyData{{ $key }}.map(d => d.unique_visitors),
                            borderColor: 'rgb(16, 185, 129)',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: 'rgb(16, 185, 129)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 13,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('id-ID');
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }
        @endforeach
    </script>

@endsection
