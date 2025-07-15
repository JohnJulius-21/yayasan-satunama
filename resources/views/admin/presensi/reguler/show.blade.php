@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('adminPresensiReguler') }}" style="color: green !important;">Presensi Reguler</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Presensi Pelatihan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">List Presensi Pelatihan Reguler</h6>
        <div class="d-flex justify-content-end">
            <a href="{{ route('generatePresensi', $reguler->id_reguler) }}" class="btn btn-success"><i style="width:17px"
                    data-feather="plus"></i>
                Buat
                Presensi</a>
        </div>
    </div>
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
    @if (session('warning'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-exclamation-triangle',
                    title: 'Peringatan',
                    message: "{{ session('warning') }}"
                }, {
                    type: 'warning',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 4000
                });
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-info-circle',
                    title: 'Info',
                    message: "{{ session('info') }}"
                }, {
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 4000
                });
            });
        </script>
    @endif
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Reguler</h6>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="reguler" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-1" scope="col">No</th>
                                <th class="col-md-5" scope="col">Judul Presensi</th>
                                <th class="col-md-1" scope="col">Aksi</th>
                                {{-- <th class="col-md-1" scope="col">Tindakan</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['judul_presensi'] }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('adminShowPresensiPesertaReguler', $item['id_presensi']) }}"
                                            class="btn btn-primary px-2">Daftar Peserta</a>
                                        {{-- <button class="btn btn-danger btn-delete" data-action="">
                                            <i style="width:17px" class="la la-trash"></i>
                                        </button> --}}
                                        <button class="btn btn-outline-success btn-download-qr px-2"
                                            data-qr="{{ base64_encode($item['qr_code']) }}">
                                            Download QR Code
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Sertakan jQuery dan DataTables JS -->
    {{-- <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#reguler').DataTable({
                lengthChange: true,
                responsive: true,
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                rowReorder: true,
                columnDefs: [{
                    orderable: false,
                    targets: 2
                }]
            });
        });
        document.querySelectorAll('.btn-download-qr').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const encodedSvg = this.getAttribute('data-qr');
                if (!encodedSvg) {
                    Swal.fire('QR Code tidak tersedia', '', 'error');
                    return;
                }

                const svgString = atob(encodedSvg); // Decode base64 ke string XML SVG
                const blob = new Blob([svgString], {
                    type: 'image/svg+xml'
                });
                const url = URL.createObjectURL(blob);

                const image = new Image();
                image.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = image.width;
                    canvas.height = image.height;

                    const ctx = canvas.getContext('2d');
                    ctx.fillStyle = '#ffffff'; // background putih
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(image, 0, 0);

                    const pngUrl = canvas.toDataURL('image/png');

                    const link = document.createElement('a');
                    link.href = pngUrl;
                    link.download = 'qr-code-presensi.png';
                    link.click();

                    URL.revokeObjectURL(url);
                };

                image.onerror = function() {
                    Swal.fire('Gagal memuat QR Code', '', 'error');
                };

                image.src = url;
            });
        });
    </script>
@endsection
