@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('evaluasiRegulerAdmin') }}" style="color: green !important;">Evaluasi</a>
            </li>
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('evaluasiShowRegulerAdmin', $reguler->id_reguler) }}" style="color: green !important;">Detail Evaluasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Evaluasi Pelatihan Reguler</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Buat Evaluasi Pelatihan Reguler</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Form Evaluasi</h6>
        </div>


        <div class="card-body">
            <select name="formTemplates" id="formTemplates" class="form-control mb-2">
                <option value="">Pilih template</option>
                <option value="eval">Evaluasi Form</option>
            </select>
            {{-- Hidden form for storing form data --}}
            <form id="hidden-form" action="{{ route('evaluasiStoreRegulerAdmin') }}" method="post" style="display: none;">
                @csrf
                <input type="hidden" id="form" name="form">
                <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">
            </form>

            {{-- Form builder container --}}
            <div id="form-builder-container" style="overflow: auto; height: 600px;">
                <div id="fb-editor"></div>
            </div>

            {{-- Save button --}}
            <a class="btn btn-secondary" href="{{ route('evaluasiShowRegulerAdmin', $reguler->id_reguler) }}">Kembali</a>
            <button id="save-button" class="btn btn-success">Simpan</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-builder.min.js') }}"></script>
    <script>
        jQuery(function($) {
            var options = {
                controlOrder: [
                    'header',
                    'text',
                    'paragraph'
                ],
                disabledActionButtons: [
                    'data',
                    'clear',
                    'save'
                ],
                disabledAttrs: [
                    'name',
                    'placeholder',
                    'value',
                    'access',
                    'class',
                ],
                disableFields: [
                    'autocomplete',
                    'button',
                    'hidden',
                    'number',
                    'file',
                    'paragraph',
                ]
            };

            var container = $(document.getElementById('fb-editor'));
            const templateSelect = document.getElementById("formTemplates");

            // Initialize form builder
            var formBuilderInstance = $(container).formBuilder(options);


            // Templates data
            const templates = {
                eval: [{
                    "type": "header",
                    "subtype": "h6",
                    "label": "Fasilitator&nbsp; 1 : <br><span style=\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\">Silahkan menilai dan memberi komentar untuk hal-hal berikut :</span><br>"
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "Metode yang digunakan",
                    "inline": true,
                    "name": "metode_yang_digunakan",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Kemampuan merespon peserta</span>",
                    "inline": true,
                    "name": "kemampuan_merespon_peserta",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Pengendalian/ pengembangan proses</span>",
                    "inline": true,
                    "name": "pengembangan_proses",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Kecukupan waktu</span>",
                    "inline": true,
                    "name": "kecukupan_waktu",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Penguasaan materi</span><br>",
                    "inline": true,
                    "name": "penguasaan_materi",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Kemampuan menyampaikan materi</span><br>",
                    "inline": true,
                    "name": "kemampuan_menyampaikan_materi",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "textarea",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>",
                    "className": "form-control",
                    "name": "catatan_fasilitator",
                    "subtype": "textarea"
                }, {
                    "type": "header",
                    "subtype": "h6",
                    "label": "Peserta<br><span style=\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\">Silahkan menilai dan memberi komentar untuk hal-hal berikut :</span><br>"
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Partisipasi peserta</span><br>",
                    "inline": true,
                    "name": "partisipasi_peserta",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Disiplin peserta</span><br>",
                    "inline": true,
                    "name": "disiplin_peserta",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Kemampuan menyerap materi</span><br>",
                    "inline": true,
                    "name": "kemampuan_menyerap_materi",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Keterbukaan gagasan</span><br>",
                    "inline": true,
                    "name": "keterbukaan_gagasan",
                    "other": false,
                    "values": [{
                        "label": "Kurang",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Baik",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat Baik",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "textarea",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>",
                    "className": "form-control",
                    "name": "catatan_peserta",
                    "subtype": "textarea"
                }, {
                    "type": "header",
                    "subtype": "h6",
                    "label": "Materi Pelatihan<br><span style=\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\">Dari topik-topik pembahasan di bawah, manakah yang :</span><br>"
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\"><p style=\"margin-bottom: 0px;\">Materi 1</p></span>",
                    "inline": false,
                    "name": "materi",
                    "other": false,
                    "values": [{
                        "label": "Tidak dipahami",
                        "value": "Tidak dipahami",
                        "selected": false
                    }, {
                        "label": "Mudah dipahami",
                        "value": "Mudah dipahami",
                        "selected": false
                    }, {
                        "label": "Sulit dipahami",
                        "value": "Sulit dipahami",
                        "selected": false
                    }, {
                        "label": "Sudah dipahami sebelumnya/ tidak ada hal baru",
                        "value": "Sudah dipahami sebelumnya/ tidak ada hal baru",
                        "selected": false
                    }]
                }, {
                    "type": "header",
                    "subtype": "h6",
                    "label": "Fasilitas<br>"
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\"><p style=\"margin-bottom: 0px;\">Ruang Kelas<br></p></span>",
                    "inline": true,
                    "name": "ruang_kelas",
                    "other": false,
                    "values": [{
                        "label": "Tidak memuaskan",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Kurang memuaskan",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Cukup memuaskan",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Memuaskan",
                        "value": "4",
                        "selected": false
                    }, {
                        "label": "Sangat Memuaskan",
                        "value": "5",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Konsumsi</span>",
                    "inline": true,
                    "name": "konsumsi",
                    "other": false,
                    "values": [{
                        "label": "Tidak memuaskan",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Kurang memuaskan",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Cukup memuaskan",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Memuaskan",
                        "value": "4",
                        "selected": false
                    }, {
                        "label": "Sangat Memuaskan",
                        "value": "5",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Layanan Panitia</span><br>",
                    "inline": true,
                    "name": "layanan_panitia",
                    "other": false,
                    "values": [{
                        "label": "Tidak memuaskan",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Kurang memuaskan",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Cukup memuaskan",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Memuaskan",
                        "value": "4",
                        "selected": false
                    }, {
                        "label": "Sangat Memuaskan",
                        "value": "5",
                        "selected": false
                    }]
                }, {
                    "type": "textarea",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Apa yang dapat dilakukan untuk memperbaiki pelatihan ini, baik konten/ materi pelatihan maupun fasilitas pelatihan ?&nbsp;</span><br>",
                    "className": "form-control",
                    "name": "perbaikan_pelatihan",
                    "subtype": "textarea"
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "<span class=\"M7eMe\" style=\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\">Saya akan merekomendasikan orang lain untuk mengikuti pelatihan ini<br></span>",
                    "inline": false,
                    "name": "rekomendasi_pelatihan",
                    "other": false,
                    "values": [{
                        "label": "Ya",
                        "value": "Ya",
                        "selected": false
                    }, {
                        "label": "Tidak",
                        "value": "Tidak",
                        "selected": false
                    }]
                }, {
                    "type": "text",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Jika ya, sebutkan nama, lembaga dan kontak yang bisa dihubungi:</span>",
                    "className": "form-control",
                    "name": "kontak",
                    "subtype": "text"
                }, {
                    "type": "textarea",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Hal yang paling utama yang saya dapatkan / pelajari dari pelatihan ini :</span><br>",
                    "className": "form-control",
                    "name": "manfaat_pelatihan",
                    "subtype": "textarea"
                }, {
                    "type": "textarea",
                    "required": true,
                    "label": "<span style=\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\">Pelatihan apa yang masih saya butuhkan utuk mendukung pekerjaan saya ?</span><br>",
                    "className": "form-control",
                    "name": "pelatihan_yang_dibutuhkan",
                    "subtype": "textarea"
                }]
            };

            // Event listener for template select
            templateSelect.addEventListener("change", function(e) {
                formBuilderInstance.actions.setData(templates[e.target.value]);
            });

            // Save button click event
            $('#save-button').on('click', function() {
                // Get form data
                var formData = formBuilderInstance.formData;

                // Set form data to hidden input
                $('#form').val(JSON.stringify(formData));

                // Submit the hidden form
                $('#hidden-form').submit();
            });

        });
    </script>
@endsection
