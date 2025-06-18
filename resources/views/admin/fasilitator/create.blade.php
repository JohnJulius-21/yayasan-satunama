@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: green !important;">
                <a href="{{ route('fasilitatorAdmin') }}" style="color: green !important;">Fasilitator</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Fasilitator</li>
        </ol>
    </nav>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Form Tambah Fasilitator</h6>
    </div>
    <form method="post" action="{{ route('fasilitatorStoreAdmin') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 mb-4 ">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Fasilitator</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama_fasilitator">Nama Fasilitator</label>
                            <input type="text" class="form-control @error('nama_fasilitator') is-invalid @enderror"
                                placeholder="Masukan Nama Fasilitator" name="nama_fasilitator"
                                value="{{ old('nama_fasilitator') }}">
                            @error('nama_fasilitator')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="Masukan NIK" name="nik" value="{{ old('nik') }}" maxlength="16"
                                minlength="16" pattern="\d{16}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <label for="email_fasilitator">Email</label>
                            <input type="email" class="form-control @error('email_fasilitator') is-invalid @enderror"
                                placeholder="Masukan Email Fasilitator" name="email_fasilitator"
                                value="{{ old('email_fasilitator') }}">
                            @error('email_fasilitator')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                placeholder="Masukan Nomor Telepon Fasilitator" name="nomor_telepon"
                                value="{{ old('nomor_telepon') }}" maxlength="12" minlength="11" pattern="\d{12}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Masukan Alamat" name="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                                <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }}>
                                    Transgender</option>
                                <option value="Tidak ingin menyebutkan"
                                    {{ old('gender') == 'Tidak ingin menyebutkan' ? 'selected' : '' }}>Tidak ingin
                                    menyebutkan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Upload Foto Fasilitator</label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                            <li class="p-1"><small>Foto fasilitator tidak boleh lebih dari 2mb</small></li>
                            <li class="p-1"><small>Foto fasilitator harus berformat jpeg,png atau jpg</small></li>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_internal_eksternal">Fasilitator Internal atau Eksternal</label>
                            <select id="id_internal_eksternal"
                                class="form-control @error('id_internal_eksternal') is-invalid @enderror"
                                name="id_internal_eksternal">
                                <option value="">Pilih jenis fasilitator</option>
                                @foreach ($internal_eksternal as $item)
                                    <option value="{{ $item['id_internal_eksternal'] }}"
                                        {{ old('id_internal_eksternal') == $item['id_internal_eksternal'] ? 'selected' : '' }}>
                                        {{ $item['internal_eksternal'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_internal_eksternal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="asal-lembaga" class="form-group">
                            <label for="asal_lembaga">Asal Lembaga</label>
                            <input type="text" class="form-control  @error('asal_lembaga') is-invalid @enderror"
                                placeholder="Masukan Asal lembaga" id="asal_lembaga" name="asal_lembaga">
                            @error('asal_lembaga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div id="keahlian" class="form-group mb-3">
                            <label for="body" class="form-label">Tambahkan Keahlian</label>\
                            <textarea class="form-control" name="body" id="" value="{{ old('body') }}"></textarea>
                            @error('body')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}


                        <div class="form-group relative overflow-x-auto">
                            <label for="asal_lembaga"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tambahkan
                                Keahlian Fasilitator</label>
                            <table class="table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">No</th>
                                        <th scope="col" class="px-6 py-3">Keahlian</th>
                                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody2">
                                    @php
                                        $oldBody = old('body', [null]);
                                    @endphp
                                    @foreach ($oldBody as $index => $value)
                                        <tr class="mb-2">
                                            <td class="row-number">{{ $index + 1 }}</td>
                                            <td class="px-6 py-3">
                                                <input type="text" name="body[]"
                                                    class="form-control shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light @error('body.' . $index) border-red-500 @enderror"
                                                    value="{{ $value }}">
                                                @error('body.' . $index)
                                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}
                                                    </p>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                @if ($index === 0)
                                                    <a type="button"
                                                        class="addRow2 font-medium text-green-600 dark:text-green-500 hover:underline text-center" style="color: green">Tambah</a>
                                                @else
                                                    <a type="button"
                                                        class="removeRow font-medium text-red-600 dark:text-red-500 hover:underline text-center" style="color: rgb(230, 35, 35)">Hapus</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @error('body')
                                <div class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 ">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Link Sosial Media (Opsional)</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="facebook"><i style="width:17px" class="la la-facebook"></i> Facebook</label>
                            <input type="text" class="form-control" placeholder="Masukan url facebook"
                                name="facebook" value="{{ old('facebook') }}">

                        </div>
                        <div class="form-group">
                            <label for="x"><i style="width:17px" class="la la-twitter"></i> Twitter</label>
                            <input type="text" class="form-control" placeholder="Masukan url twitter" name="x"
                                value="{{ old('x') }}">

                        </div>
                        <div class="form-group">
                            <label for="instagram"><i style="width:17px" class="la la-instagram"></i> Instagram</label>
                            <input type="text" class="form-control" placeholder="Masukan url Instagram"
                                name="instagram" value="{{ old('instagram') }}">

                        </div>
                        <div class="form-group">
                            <label for="linkedin"><i style="width:17px" class="la la-linkedin"></i> Linkedin</label>
                            <input type="text" class="form-control" placeholder="Masukan url linkedin"
                                name="linkedin" value="{{ old('linkedin') }}">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('fasilitatorAdmin') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_internal_eksternal').change(function() {
                if ($(this).val() == 1) {
                    $('#asal-lembaga input[name="asal_lembaga"]').val('SATUNAMA');
                    $('#asal-lembaga input[name="asal_lembaga"]').prop('readonly', true);
                } else {
                    $('#asal-lembaga input[name="asal_lembaga"]').val('');
                    $('#asal-lembaga input[name="asal_lembaga"]').prop('readonly', false);
                }
            });

            function updateRowNumbers() {
                $('#tableBody2 tr').each(function(index) {
                    $(this).find('.row-number').text(index + 1);
                });
            }

            // Add row for keahlian
            $(".addRow2").click(function() {
                let newIndex = $('#tableBody2 tr').length;
                $("#tableBody2").append(
                    `<tr class="mb-2">
            <td class="row-number"></td>
            <td class="px-6 py-3">
                <input type="text" name="body[]"
                    class="form-control shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                    value="">
            </td>
            <td class="text-center">
                <a type="button" class="removeRow font-medium text-red-600 dark:text-red-500 hover:underline text-center" style="color: rgb(230, 35, 35)">Hapus</a>
            </td>
        </tr>`
                );
                updateRowNumbers();
            });

            // Remove row on button click
            $(document).on("click", ".removeRow", function() {
                $(this).closest("tr").remove();
                updateRowNumbers();
            });
        });
    </script>
@endsection
