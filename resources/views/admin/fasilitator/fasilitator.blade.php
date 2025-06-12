<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>STC - Formulir Fasilitator</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>


    <section class="bg-white dark:bg-gray-50">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <img src="{{ asset('images/stc.png') }}" alt="" class="h-14 mx-auto mb-8">
            <h5 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-dark">Form
                Fasilitator
            </h5>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Bantu kami dalam
                mengisi data diri anda yang akan digunakan untuk kepentingan pelatihan.
            </p>
            <form action="{{ route('fasilitatorStore') }}" class="space-y-8" method="POST">
                @csrf
                <h3 for="data_diri" class="block mb-4 text-lg font-large text-gray-400 dark:text-dark">Data Diri</h3>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Nama
                        Lengkap</label>
                    <input type="text" id="name" name="nama_fasilitator" value="{{ old('nama_fasilitator') }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light @error('nama_fasilitator') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror"
                        placeholder="Masukan Nama Lengkap Anda">
                    @error('nama_fasilitator')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Email</label>
                    <input type="email" id="email" name="email_fasilitator"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="cth : satunamatraining@email.com">
                </div>

                <div>
                    <label for="nomor_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">
                        Nomor Hp Anda (WhatsApp)
                    </label>
                    <input type="text" id="nomor_hp" name="nomor_telepon" maxlength="12" pattern="\d{12}"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="08XXXXXXXXXX" required>
                </div>


                <div>
                    <label for="alamat"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light @error('alamat') border-red-500 @enderror"
                        placeholder="Masukan Alamat Anda">
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Gender</label>
                    <select id="countries" name="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500">

                        <option value="">Pilih Gender</option>
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
                </div>

                <div>
                    <label for="id_internal_eksternal"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Fasilitator Internal atau
                        Eksternal</label>
                    <select id="id_internal_eksternal"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500"
                        name="id_internal_eksternal">
                        <option value="">Pilih jenis fasilitator</option>
                        @foreach ($internal_eksternal as $item)
                            <option value="{{ $item['id_internal_eksternal'] }}"
                                {{ old('id_internal_eksternal') == $item['id_internal_eksternal'] ? 'selected' : '' }}>
                                {{ $item['internal_eksternal'] }}
                            </option>
                        @endforeach
                    </select>
                    </select>
                </div>

                <div id="asal-lembaga" class="form-group">
                    <label for="asal_lembaga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Asal
                        Lembaga</label>
                    <input type="text"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="Masukan Asal lembaga" id="asal_lembaga" name="asal_lembaga">
                    @error('asal_lembaga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900"
                        for="user_avatar">Upload
                        Foto Anda</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-900 focus:outline-none dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help" id="user_avatar" type="file" name="foto">
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-500" id="user_avatar_help">
                        <li class="p-1"><small>Foto tidak boleh lebih dari 2mb</small></li>
                        <li class="p-1"><small>Foto harus berformat jpeg,png atau jpg</small></li>
                    </div>
                </div>

                <label for="asal_lembaga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tambahkan
                    Keahlian Anda</label>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light @error('body.' . $index) border-red-500 @enderror"
                                            value="{{ $value }}">
                                        @error('body.' . $index)
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    <td class="text-center">
                                        @if ($index === 0)
                                            <a type="button"
                                                class="addRow2 font-medium text-green-600 dark:text-green-500 hover:underline text-center">Tambah</a>
                                        @else
                                            <a type="button"
                                                class="removeRow font-medium text-red-600 dark:text-red-500 hover:underline text-center">Hapus</a>
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

                {{-- <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-100 dark:border-gray-600">
                    <div id="wysiwyg" class="bg-white p-4 rounded-md h-64"></div>
                </div> --}}


                <h3 for="sosial_media" class="block mb-4 text-lg font-large text-gray-400 dark:text-dark">Sosial Media
                    (Opsional)</h3>
                <div class="form-group">
                    <label for="facebook"><i style="width:17px"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900"></i>
                        Facebook</label>
                    <input type="text"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="Masukan url facebook" name="facebook" value="{{ old('facebook') }}">

                </div>
                <div class="form-group">
                    <label for="x"><i style="width:17px"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900"></i>
                        Twitter</label>
                    <input type="text"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="Masukan url twitter" name="x" value="{{ old('x') }}">

                </div>
                <div class="form-group">
                    <label for="instagram"><i style="width:17px"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900"></i>
                        Instagram</label>
                    <input type="text"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="Masukan url Instagram" name="instagram" value="{{ old('instagram') }}">

                </div>
                <div class="form-group">
                    <label for="linkedin"><i style="width:17px"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900"></i>
                        Linkedin</label>
                    <input type="text"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                        placeholder="Masukan url linkedin" name="linkedin" value="{{ old('linkedin') }}">

                </div>


                <hr>
                <button type="submit" id="submitBtn"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
            </form>
        </div>
    </section>



    <footer class="bg-white rounded-lg shadow-sm dark:bg-gray-50 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">

            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a
                    href="https://training.satunama.org/" class="hover:underline">SATUNAMA Training Center</a>. All
                Rights Reserved.</span>
        </div>
    </footer>


    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
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

            var quill = new Quill('#wysiwyg', {
                theme: 'snow'
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
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-green-500 dark:focus:border-green-500 dark:shadow-sm-light"
                    value="">
            </td>
            <td class="text-center">
                <a type="button" class="removeRow font-medium text-red-600 dark:text-red-500 hover:underline text-center">Hapus</a>
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

            $('#submitBtn').click(function(e) {
                e.preventDefault();
                let formData = new FormData($('form')[0]);

                // Untuk file upload
                let fileInput = $('#user_avatar')[0];
                if (fileInput.files.length > 0) {
                    formData.append('foto', fileInput.files[0]);
                }

                $.ajax({
                    url: "{{ route('fasilitatorStore') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data fasilitator berhasil disimpan!",
                            icon: "success",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg'
                            }
                        }).then(() => {
                            window.location.href = "{{ route('fasilitatorCreate') }}";
                        });
                    },
                    error: function(xhr) {
                        let response = xhr.responseJSON;
                        let messages = "";
                        let errorFields = [];

                        if (response && response.errors) {
                            // Gabungkan semua pesan error ke dalam list
                            messages += "<ul class='text-left list-disc pl-5'>";
                            for (let key in response.errors) {
                                if (response.errors.hasOwnProperty(key)) {
                                    messages += "<li>" + response.errors[key].join(", ") +
                                        "</li>";
                                    errorFields.push(key);
                                }
                            }
                            messages += "</ul>";
                        } else if (response && response.message) {
                            messages = response.message;
                        } else {
                            messages = "Terjadi kesalahan saat memproses data.";
                        }

                        Swal.fire({
                            title: "Gagal!",
                            html: messages,
                            icon: "error",
                            confirmButtonText: "Tutup",
                            customClass: {
                                confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg'
                            }
                        });

                        // Highlight fields yang error
                        $('.border-red-500').removeClass('border-red-500');
                        errorFields.forEach(field => {
                            $(`[name="${field}"]`).addClass('border-red-500');
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
