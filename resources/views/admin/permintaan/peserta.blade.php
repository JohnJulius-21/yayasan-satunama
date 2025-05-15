@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('permintaanAdmin') }}" style="color: green !important;">Permintaan</a>
            </li>
            <li class="breadcrumb-item" style="color: green !important;">
                <a href="{{ route('permintaanInfoAdmin', $permintaan->id_pelatihan_permintaan) }}"
                    style="color: rgb(2, 160, 2) !important;">
                    Informasi Pelatihan
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Akun Peserta Permintaan</li>
        </ol>
    </nav>
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
    @if (session('error'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-exclamation',
                    title: 'Gagal',
                    message: "{{ session('error') }}"
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000
                });
            });
        </script>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h4">Daftar Peserta permintaan</h1>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success btn-modal">Buatkan Akun Peserta</button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <p class="m-0 font-weight-bold text-success">Tabel Akun Peserta</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="permintaan" class="table table-bordered display responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Email Peserta</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)
                            <tr>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>{{ $item->email_peserta }}</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id_peserta }}"
                                        data-nama="{{ $item->nama_peserta }}" data-email="{{ $item->email_peserta }}">
                                        <i style="width:17px" class="la la-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $item->id_peserta }}">
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <p class="m-0 font-weight-bold text-success">Tabel Daftar Assesment Peserta</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="peserta" class="table table-bordered display responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Email Peserta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesertaAssesment as $item)
                            <tr>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>{{ $item->email_peserta }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Buat akun -->
    <div id="createPesertaModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5>Form Daftar Akun Peserta</h5>
                <span class="close-modal">&times;</span>
            </div>
            <div class="custom-modal-body">
                <form method="post" action="{{ route('permintaanStorePeserta', $permintaan->id_pelatihan_permintaan) }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- @foreach ($permintaan as $item) --}}
                    <input type="hidden" id="id_permintaan" name="id_permintaan" value="{{ $permintaan->id_pelatihan_permintaan }}">
                    {{-- @endforeach --}}
                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label">Nama Lengkap Peserta</label>
                        <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                            placeholder="Masukkan Nama Lengkap Peserta" name="nama_peserta" id="nama_peserta"
                            value="{{ old('nama_peserta') }}" autofocus>
                        @error('nama_peserta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email_peserta" class="form-label">Email Peserta</label>
                        <input type="email" class="form-control @error('email_peserta') is-invalid @enderror"
                            placeholder="Masukkan Email Peserta" name="email_peserta" id="email_peserta"
                            value="{{ old('email_peserta') }}" autofocus>
                        @error('email_peserta')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan Password" name="password" id="password" value="{{ old('password') }}"
                            autofocus>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn-cancel">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Peserta -->
    <div id="editPesertaModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5>Edit Data Peserta</h5>
                <span class="close-modal">&times;</span>
            </div>
            <form method="post" id="updateForm" style="display:inline;">
                @csrf
                @method('PUT')
                <div class="custom-modal-body">
                    <input type="hidden" id="edit_id_peserta" name="id_peserta">
                    <div class="mb-3">
                        <label for="edit_nama_peserta" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_peserta" id="edit_nama_peserta">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email_peserta" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_peserta" id="edit_email_peserta">
                    </div>
                    <div class="mb-3">
                        <label for="edit_password_peserta" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="edit_password_peserta">
                        <small>Kosongkan field ini jika tidak ingin mengganti Password</small>
                    </div>

                </div>
                <div class="custom-modal-footer">
                    <button type="button" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
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
                Apakah Anda yakin ingin menghapus peserta ini?
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
            text-align: start;
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
            $('#permintaan').DataTable({
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
            $('#peserta').DataTable({
                lengthChange: true,
                responsive: true,
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                rowReorder: true,
            });

            const modal = $('#createPesertaModal');
            const deleteForm = $('#deleteForm');

            // Event click untuk tombol delete
            $(document).on('click', '.btn-modal', function(e) {
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

            $('.btn-edit').click(function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let email = $(this).data('email');
                let actionUrl = "/admin/pelatihan/permintaan/update-peserta-permintaan/" + id;
                $('#edit_id_peserta').val(id);
                $('#edit_nama_peserta').val(nama);
                $('#edit_email_peserta').val(email);
                $('#updateForm').attr('action', actionUrl);
                $('#editPesertaModal').show();
            });

            $('#btnUpdatePeserta').click(function() {
                $('#editPesertaForm').submit();
            });

            $('.btn-delete').click(function() {
                let id = $(this).data('id');
                let actionUrl = "/admin/pelatihan/permintaan/hapus-peserta-permintaan/" + id;
                $('#deleteForm').attr('action', actionUrl);
                $('#confirmDeleteModal').show();
            });

            $('.close-modal, .btn-cancel').click(function() {
                $('.custom-modal').hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is('.custom-modal')) {
                    $('.custom-modal').hide();
                }
            });
        });
    </script>
@endsection
