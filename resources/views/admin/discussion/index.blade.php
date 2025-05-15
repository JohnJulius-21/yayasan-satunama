@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h6 class="h4">Ruang Diskusi</h6>
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
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Daftar Ruang Diskusi</h6>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="diskusi" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-5" scope="col">Judul Ruang Diskusi</th>
                                <th class="col-md-1" scope="col">Konten</th>
                                <th class="col-md-1" scope="col">Dibuat Oleh</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discussion as $item)
                                <tr>
                                    <td>{{ $item['title'] }}</td>
                                    <td>
                                        {!! Str::limit($item->content, 200) !!}
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="{{ route('adminShowDiskusi', $item->id_diskusi) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" class="la la-eye"></i></a>
                                        <button class="btn btn-danger btn-delete"
                                            data-action="{{ route('adminDestroyDiskusi', $item->id_diskusi) }}">
                                            <i style="width:17px" class="la la-trash"></i>
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

    <!-- Modal Konfirmasi Hapus -->
    <div id="confirmDeleteModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5>Konfirmasi Hapus</h5>
                <span class="close-modal">&times;</span>
            </div>
            <div class="custom-modal-body">
                Apakah Anda yakin ingin menghapus Ruang Diskusi ini?
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-cancel">Batal</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .custom-modal-content {
            background: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-modal-header,
        .custom-modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .custom-modal-header h5 {
            margin: 0;
        }

        .custom-modal-body {
            padding: 10px 0;
            text-align: center;
        }

        .btn-cancel,
        .btn-confirm {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel {
            background: #ccc;
            color: #333;
        }

        .btn-confirm {
            background: #d9534f;
            color: white;
        }

        .close-modal {
            cursor: pointer;
            font-size: 20px;
        }
    </style>
    <!-- Sertakan jQuery dan DataTables JS -->
    {{-- <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#diskusi').DataTable({
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

            const modal = $('#confirmDeleteModal');
            const deleteForm = $('#deleteForm');

            // Event click untuk tombol delete
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const actionUrl = $(this).data('action');
                deleteForm.attr('action', actionUrl);
                modal.show();
            });

            // Event untuk menutup modal
            $('.close-modal, .btn-cancel').click(function() {
                modal.hide();
                deleteForm.attr('action', '');
            });

            // Klik di luar modal untuk menutup
            $(window).click(function(event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                    deleteForm.attr('action', '');
                }
            });
        });
    </script>
@endsection
