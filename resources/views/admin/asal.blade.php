@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-thumbs-up',
                    title: 'Berhasil',
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000
                });
            });
        </script>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Dashboard</h6>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    <h6>Jumlah Pelatihan Reguler</h6>
                    <p class="h6">{{ $jumlahReguler }} Pelatihan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    <h6>Jumlah Pelatihan Permintaan</h6>
                    <p class="h6">{{ $jumlahPermintaan }} Pelatihan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    <h6>Jumlah Pelatihan Konsultasi</h6>
                    <p class="h6">{{ $jumlahKonsultasi }} Pelatihan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    <h6>Jumlah Peserta</h6>
                    <p class="h6">{{ $jumlahPeserta }} Peserta</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    <h6>Fasilitator Terlibat Pelatihan Terbanyak</h6>
                    <ul class="list-group">
                        @foreach ($topFasilitator as $fasilitator)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $fasilitator->nama_fasilitator }}
                                <span class="badge bg-success rounded-pill">{{ $fasilitator->jumlah_terlibat }}
                                    Pelatihan</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-10 mb-1">
            <div class="card">
                <div class="card-body">
                    @include('partials.home')
                    <h6 class="mt-3">Asal Peserta Berdasarkan Wilayah</h6>
                    <canvas id="asalPesertaChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('asalPesertaChart').getContext('2d');
            const asalPesertaChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($asalPeserta->pluck('nama_provinsi')) !!},
                    datasets: [{
                        label: 'Jumlah Peserta',
                        data: {!! json_encode($asalPeserta->pluck('total')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y', // horizontal bar
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
