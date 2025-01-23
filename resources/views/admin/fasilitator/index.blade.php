@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Daftar Fasilitator</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('fasilitatorCreateAdmin') }}" class="btn btn-success"><i style="width:17px"
                    data-feather="plus"></i>
                Tambah
                Fasilitator</a>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow ">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Fasilitator</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="fasilitator" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-2" scope="col">Nama Fasilitator</th>
                                <th class="col-md-1" scope="col">Internal atau Eksternal</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fasilitator as $item)
                                <tr>
                                    <td>{{ $item['nama_fasilitator'] }}</td>
                                    @if ($item['id_internal_eksternal'] == 1)
                                        <td>Internal</td>
                                    @else
                                        <td>Eksternal</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('fasilitatorShowAdmin', $item->id_fasilitator) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ route('fasilitatorEditAdmin', $item->id_fasilitator) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                        {{-- <button class="btn btn-danger btn-delete px-2"
                                            data-action="{{ route('fasilitatorDestroyAdmin', $item->id_fasilitator) }}">
                                            <i style="width:17px" data-feather="trash"></i>
                                        </button> --}}
                                        <button class="btn btn-danger btn-delete" data-action="{{ route('fasilitatorDestroyAdmin', $item->id_fasilitator) }}">
                                            <span class="icon-bg"><i class="mdi mdi-trash-can-outline"></i></span>
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
                Apakah Anda yakin ingin menghapus fasilitator ini?
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


    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#fasilitator').DataTable({
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

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmDeleteModal');
            const closeModalElements = modal.querySelectorAll('.close-modal, .btn-cancel');
            const deleteForm = document.getElementById('deleteForm');

            // Buka modal ketika tombol hapus ditekan
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const actionUrl = this.getAttribute('data-action');
                    deleteForm.setAttribute('action', actionUrl);
                    modal.style.display = 'block';
                });
            });

            // Tutup modal ketika tombol batal atau ikon close ditekan
            closeModalElements.forEach(element => {
                element.addEventListener('click', function() {
                    modal.style.display = 'none';
                    deleteForm.setAttribute('action', '');
                });
            });

            // Tutup modal ketika klik di luar modal
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    deleteForm.setAttribute('action', '');
                }
            });
        });
    </script>
@endsection
