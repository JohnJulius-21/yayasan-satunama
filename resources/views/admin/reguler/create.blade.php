@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('regulerAdmin') }}" style="color: green !important;">Reguler</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Pelatihan Reguler</li>
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


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Form Tambah Pelatihan Reguler</h6>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success btn-modal" data-action="">
                Kelola Tema Pelatihan
            </button>
        </div>
    </div>
    <form method="post" action="{{ route('regulerStoreAdmin') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-7 mb-2">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Reguler</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Informasi Pelatihan -->
                        <div class="mb-3">
                            <label for="nama_pelatihan" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Nama Pelatihan" name="nama_pelatihan" id="nama_pelatihan"
                                value="{{ old('nama_pelatihan') }}" autofocus>
                            @error('nama_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema Pelatihan</label>
                            <select class="form-control" name="id_tema">
                                <option value="">Pilih Tema Pelatihan</option>
                                @foreach ($tema as $item)
                                    <option value="{{ $item->id }}" {{ old('id_tema') == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul_tema }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="fee_pelatihan" class="form-label">Fee Pelatihan</label>
                            <input type="number" class="form-control @error('fee_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Fee Pelatihan" name="fee_pelatihan" id="fee_pelatihan"
                                value="{{ old('fee_pelatihan') }}">
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode_pelatihan" class="form-label">Metode Pelatihan</label>
                            <select class="form-control" name="metode_pelatihan">
                                <option value="">Pilih Metode Pelatihan</option>
                                <option value="Online" {{ old('metode_pelatihan') == 'Online' ? 'selected' : '' }}>Online
                                </option>
                                <option value="Offline" {{ old('metode_pelatihan') == 'Offline' ? 'selected' : '' }}>
                                    Offline
                                </option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="lokasi_pelatihan" class="form-label">Lokasi Pelatihan</label>
                            <input type="text" class="form-control @error('lokasi_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Lokasi Pelatihan" name="lokasi_pelatihan" id="lokasi_pelatihan"
                                value="{{ old('lokasi_pelatihan') }}">
                            @error('lokasi_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kuota_peserta" class="form-label">Kuota Peserta</label>
                            <input type="number" value="{{ old('kuota_peserta') }}"
                                class="form-control @error('kuota_peserta') is-invalid @enderror"
                                placeholder="Masukkan Kuota Peserta" name="kuota_peserta" id="kuota_peserta"
                                value="{{ old('kuota_peserta') }}">
                            @error('kuota_peserta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="trix-content mb-3">
                            <label for="deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan</label>
                            <input id="deskripsi_pelatihan" type="hidden" name="deskripsi_pelatihan"
                                value="{{ old('deskripsi_pelatihan') }}">
                            {{-- <trix-editor class="{{ $errors->has('deskripsi_pelatihan') ? 'is-invalid' : '' }}"
                                input="deskripsi_pelatihan" upload-url="/dashboard/reguler/upload/image"></trix-editor> --}}
                            <textarea class="ckeditor form-control" name="deskripsi_pelatihan" id="deskripsi_pelatihan"></textarea>
                            @error('deskripsi_pelatihan')
                                <div class="invalid-feedback">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="trix-content mb-3">
                            <label for="pengumuman" class="form-label">Pengumuman Pelatihan</label>
                            <input id="pengumuman" type="hidden" name="pengumuman"
                                value="{{ old('pengumuman') }}">
                            {{-- <trix-editor class="{{ $errors->has('pengumuman') ? 'is-invalid' : '' }}"
                                input="pengumuman" upload-url="/dashboard/reguler/upload/image"></trix-editor> --}}
                            <textarea class="ckeditor form-control" name="pengumuman" id="pengumuman"></textarea>
                            @error('pengumuman')
                                <div class="invalid-feedback">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-5 mb-4">
                <!-- Tanggal Pelatihan -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Tanggal Pelatihan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran Pelatihan</label>
                            <input type="date" id="tanggal_pendaftaran"
                                class="form-control @error('tanggal_pendaftaran') is-invalid @enderror"
                                name="tanggal_pendaftaran" value="{{ old('tanggal_pendaftaran') }}">
                            @error('tanggal_pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_batas_pendaftaran" class="form-label">Tanggal Batas Pendaftaran
                                Pelatihan</label>
                            <input type="date" id="tanggal_batas_pendaftaran"
                                class="form-control @error('tanggal_batas_pendaftaran') is-invalid @enderror"
                                name="tanggal_batas_pendaftaran" value="{{ old('tanggal_batas_pendaftaran') }}">
                            @error('tanggal_batas_pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pelatihan</label>
                            <input type="date" id="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pelatihan</label>
                            <input type="date" id="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Gambar dan Materi -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Poster & Materi</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="image" class="form-label">Upload Poster Pelatihan</label>
                        <input value="{{ old('image') }}" class="form-control @error('image.*') is-invalid @enderror"
                            type="file" id="image" name="image[]" multiple>
                        <div class="p-1">
                            <li><small>Poster tidak boleh lebih dari 2mb</small></li>
                        </div>
                        @error('image.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-body">
                        <label for="file" class="form-label">Upload Materi</label>
                        <input value="{{ old('file') }}" class="form-control @error('file.*') is-invalid @enderror"
                            type="file" id="file" name="file[]" multiple>
                        <div class="p-1">
                            <li><small>File tidak boleh lebih dari 5mb</small></li>
                            <li><small>Kosongkan kolom upload materi jika tidak ingin mengupload materi</small></li>
                            
                            
                        </div>
                        @error('file.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>

                <!-- Fasilitator -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Fasilitator Pelatihan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="fasilitator-pelatihan">Fasilitator Pelatihan</label>
                        <div class="form-group mb-2">
                            <select id="fasilitator" class="form-control" name="id_fasilitator[]" multiple="multiple"
                                style="width: 100%">
                                @foreach ($fasilitator as $item)
                                    <option value="{{ $item->id_fasilitator }}"
                                        @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>{{ $item->nama_fasilitator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div>
            <a class="btn btn-secondary" href="{{ route('regulerAdmin') }}">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>

    <!-- Modal tambah/hapus tema -->
    <div id="temaModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header border-bottom mb-3">
                <h5>Kelola Tema Pelatihan</h5>
                <span class="close-modal">&times;</span>
            </div>
            <form id="temaForm" method="POST" action="{{ route('regulerStoreTemaAdmin') }}">
                @csrf
                <label for="">Tambah Tema</label>
                <input type="text" name="judul_tema" class="form-control" placeholder="Tambah Tema">
                <button type="submit" class="btn btn-success mt-2">Tambah Tema</button>
            </form>

            <hr>

            <!-- Form Hapus Tema -->
            <form id="hapusTemaForm" method="POST" action="{{ route('regulerDestroyTemaAdmin', ['id' => '__ID__']) }}">
                @csrf
                @method('DELETE')
                <label for="">Hapus Tema</label>
                <select id="hapus_tema" name="id_tema" class="form-control">
                    <option value="">-- Pilih Tema --</option>
                    @foreach ($tema as $t)
                        <option value="{{ $t->id }}">{{ $t->judul_tema }}</option>
                    @endforeach
                </select>
                <button type="submit" id="btnSubmitHapus" class="btn btn-danger mt-2">Hapus Tema</button>
            </form>

        </div>
    </div>





    <!-- Tambahkan CSS -->
    <style>
        .step-indicator .step {
            display: inline-block;
            padding: 10px 15px;
            background-color: #e9ecef;
            border-radius: 50px;
            margin: 5px;
            font-weight: bold;
        }

        .step-indicator .step.active {
            background-color: #28a745;
            color: white;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        /* Stepper container */
        .stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        /* Individual step */
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }

        /* Circle */
        .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
        }

        /* Active circle */
        .step.active .circle {
            background-color: #28a745;
            color: white;
        }

        /* Step label */
        .label {
            margin-top: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        /* Line between steps */
        .line {
            flex-grow: 1;
            height: 2px;
            background-color: #e0e0e0;
        }

        /* Active line */
        .step.active~.line {
            background-color: #28a745;
        }

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

    <!-- Tambahkan JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#fasilitator').select2({
                placeholder: "Pilih Fasilitator",
                theme: "classic"
            });

            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').remove();
            });

            const modal = $('#createPesertaModal');

            // Event click untuk tombol delete
            $(document).on('click', '.btn-modal', function(e) {
                e.preventDefault();
                const actionUrl = $(this).data('action');
                const deleteForm = modal.find('form'); // pastikan form ada di dalam modal
                if (deleteForm.length) {
                    deleteForm.attr('action', actionUrl);
                }
                modal.show();
            });

            // Event untuk menutup modal
            $('.close-modal, .btn-cancel').click(function() {
                modal.hide();
                const deleteForm = modal.find('form');
                if (deleteForm.length) {
                    deleteForm.attr('action', '');
                }
            });

            // Klik di luar modal untuk menutup
            $(window).click(function(event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                    const deleteForm = modal.find('form');
                    if (deleteForm.length) {
                        deleteForm.attr('action', '');
                    }
                }
            });

            $('.btn-modal').click(function() {
                let actionUrl = "/admin/pelatihan/reguler/buat-tema-pelatihan";
                $('#temaForm').attr('action', actionUrl);
                $('#temaModal').show();
            });

            $('.close-modal, .btn-cancel').click(function() {
                $('.custom-modal').hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is('.custom-modal')) {
                    $('.custom-modal').hide();
                }
            });

            $('#btnSubmitHapus').click(function(e) {
                const idTema = $('#hapus_tema').val();

                if (!idTema) {
                    e.preventDefault();
                    alert('Silakan pilih tema terlebih dahulu.');
                    return;
                }

                const form = $('#hapusTemaForm');
                let action = form.attr('action').replace('__ID__', idTema);
                form.attr('action', action);
            });

        });

        document.addEventListener('trix-initialize', function(event) {
            var editor = event.target.editor;

            var fileToolsButtonGroup = editor.toolbarElement.querySelector('[data-trix-button-group="file-tools"]');
            if (fileToolsButtonGroup) {
                fileToolsButtonGroup.style.display = 'none';
            }
        });
    </script>
@endsection
