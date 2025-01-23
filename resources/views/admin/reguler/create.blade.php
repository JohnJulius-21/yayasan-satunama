@extends('layouts.admin')

@section('content')
    {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div> --}}

    <h1 class="h2">Form Tambah Pelatihan</h1>
    <form method="post" action="{{ route('regulerStoreAdmin') }}" enctype="multipart/form-data">
        @csrf
        <!-- Step Indicator -->
        {{-- <div class="step-indicator mb-4">
            <div class="d-flex justify-content-between">
                <span class="step active">Step 1: Informasi Pelatihan</span>
                <span class="step">Step 2: Tanggal Pelatihan</span>
                <span class="step">Step 3: Fasilitator</span>
            </div>
        </div> --}}

        <div class="stepper mb-4">
            <div class="step active">
                <div class="circle">1</div>
                <div class="label">Informasi Pelatihan</div>
            </div>
            <div class="line"></div>
            <div class="step">
                <div class="circle">2</div>
                <div class="label">Poster, Materi & Deskripsi Pelatihan</div>
            </div>
            <div class="line"></div>
            <div class="step">
                <div class="circle">3</div>
                <div class="label">Tanggal Pelatihan</div>
            </div>
            <div class="line"></div>
            <div class="step">
                <div class="circle">4</div>
                <div class="label">Fasilitator</div>
            </div>

        </div>

        <!-- Step 1 -->
        <div class="step-content active" id="step-1">
            {{-- <div class="row"> --}}
            <div class="col-sm-12 mb-4">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Reguler</h6>
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
                            <select class="form-control" name="id_tema" required>
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
                            <input type="text" class="form-control @error('fee_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Fee Pelatihan" name="fee_pelatihan" id="fee_pelatihan"
                                value="{{ old('fee_pelatihan') }}" required>
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode_pelatihan" class="form-label">Metode Pelatihan</label>
                            <select class="form-control" name="metode_pelatihan" required>
                                <option value="">Pilih Metode Pelatihan</option>
                                <option value="Online" {{ old('metode_pelatihan') == 'Online' ? 'selected' : '' }}>Online
                                </option>
                                <option value="Offline" {{ old('metode_pelatihan') == 'Offline' ? 'selected' : '' }}>Offline
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
                                value="{{ old('kuota_peserta') }}" required>
                            @error('kuota_peserta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>

                    {{-- </div> --}}
                </div>
                <button type="button" class="btn btn-success next-step">Next</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-content" id="step-2">
            {{-- <div class="row"> --}}
            <div class="col-sm-12 mb-4">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Poster, Materi & Deskripsi Pelatihan</h6>
                    </div>
                    <div class="card-body">
                        <!-- Gambar, Materi, dan Deskripsi -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Poster Pelatihan</label>
                            <input value="{{ old('image') }}" class="form-control @error('image.*') is-invalid @enderror"
                                type="file" id="image" name="image[]" multiple required>
                            @error('image.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Materi</label>
                            <input value="{{ old('file') }}" class="form-control @error('file.*') is-invalid @enderror"
                                type="file" id="file" name="file[]" multiple>
                            @error('file.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="trix-content mb-3">
                            <label for="deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan</label>
                            <input id="deskripsi_pelatihan" type="hidden" name="deskripsi_pelatihan"
                                value="{{ old('deskripsi_pelatihan') }}">
                            <trix-editor class="{{ $errors->has('deskripsi_pelatihan') ? 'is-invalid' : '' }}"
                                input="deskripsi_pelatihan" upload-url="/dashboard/reguler/upload/image"></trix-editor>
                            @error('deskripsi_pelatihan')
                                <div class="invalid-feedback">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="button" class="btn btn-success next-step">Next</button>
            </div>
            {{-- </div> --}}
        </div>

        <!-- Step 3 -->
        <div class="step-content" id="step-3">
            {{-- <div class="row"> --}}
            <div class="col-sm-12 mb-4">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tanggal Pelatihan</h6>
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
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="button" class="btn btn-success next-step">Next</button>
            </div>
            {{-- </div> --}}
        </div>

        <!-- Step 4 -->
        <div class="step-content" id="step-4">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Fasilitator Pelatihan</h6>
                </div>
                <div class="card-body">
                    <label for="fasilitator-pelatihan">Fasilitator Pelatihan</label>
                    <div class="form-group mb-2">
                        <select id="fasilitator" class="form-select" name="id_fasilitator[]" required
                            multiple="multiple" style="width: 100%">
                            <option value="">test</option>
                            @foreach ($fasilitator as $item)
                                <option value="{{ $item->id_fasilitator }}"
                                    @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>{{ $item->nama_fasilitator }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary prev-step">Previous</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>




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
    </style>

    <!-- Tambahkan JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.next-step').on('click', function() {
                const currentStep = $(this).closest('.step-content');
                let isValid = true;

                // Validasi semua input di step aktif
                currentStep.find('input, select, textarea').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        isValid = false;

                        // Tambahkan kelas error dan munculkan pesan
                        $(this).addClass('is-invalid');
                        $(this).next('.invalid-feedback').remove(); // Hapus pesan sebelumnya
                        $(this).after('<div class="invalid-feedback">Field ini wajib diisi.</div>');
                    } else {
                        // Hapus error jika valid
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    }
                });

                // Jika valid, lanjut ke step berikutnya
                if (isValid) {
                    currentStep.removeClass('active').next('.step-content').addClass('active');
                }
            });
        });

        $(document).ready(function() {
            $('#fasilitator').select2({
                placeholder: "Pilih Fasilitator",
                theme: "classic"
            });

            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid'); // Menghapus kelas 'is-invalid'
                $(this).siblings('.invalid-feedback').remove(); // Menghapus pesan kesalahan
            });
        });

        document.addEventListener('trix-initialize', function(event) {
            var editor = event.target.editor;

            // Menonaktifkan grup tombol file-tools
            var fileToolsButtonGroup = editor.toolbarElement.querySelector('[data-trix-button-group="file-tools"]');
            editor.deactivateAttribute('toolbar', fileToolsButtonGroup);
        });
    </script>
@endsection
