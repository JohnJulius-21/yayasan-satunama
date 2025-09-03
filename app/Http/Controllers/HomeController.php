<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $fasilitator = DB::table('fasilitator_pelatihan')
            ->leftJoin('fasilitator_foto', 'fasilitator_pelatihan.id_fasilitator', '=', 'fasilitator_foto.id_fasilitator')
            ->select('fasilitator_pelatihan.*', 'fasilitator_foto.photo_url')
            ->get();

        $reguler = reguler::orderByRaw('MONTH(tanggal_pendaftaran) DESC')
            ->orderBy('tanggal_pendaftaran', 'DESC') // urutkan juga berdasarkan tanggal untuk urutan dalam bulan
            ->paginate(3);

            foreach ($reguler as $item) {
                $filename = DB::table('reguler_images')
                    ->where('id_reguler', $item->id_reguler)
                    ->value('image_url');

                if (!empty($filename)) {
                    $cachePath = public_path('storage/cache_drive/' . $filename);

                    if (file_exists($cachePath)) {
                        $item->image_url = asset('storage/cache_drive/' . $filename);
                    } else {
                        $item->image_url = route('file.show', ['filename' => $filename]);
                    }
                } else {
                    $item->image_url = asset('/images/stc.png'); // fallback image
                }
            }



        // dd($fasilitator);
        return view('user/home', [
            'title' => 'Beranda',
            'fasilitator' => $fasilitator,
            'reguler' => $reguler
        ]);
    }

    public function indexAdmin()
    {
        // Jumlah pelatihan berdasarkan jenis
        $jumlahReguler = DB::table('reguler')->count();
        $jumlahPeserta = DB::table('users')
            ->where('roles', 'peserta')
            ->count();

        $jumlahPermintaan = DB::table('permintaan_pelatihan')->count();
        $jumlahKonsultasi = DB::table('konsultasi')->count();

        // Peserta berdasarkan asal (contoh: asal_instansi atau asal_kota)
        $asalPeserta = DB::table('peserta_pelatihan_reguler')
            ->join('provinsi', 'peserta_pelatihan_reguler.id_provinsi', '=', 'provinsi.id')
            ->select('provinsi.nama_provinsi', DB::raw('count(*) as total'))
            ->groupBy('provinsi.nama_provinsi')
            ->orderByDesc('total')
            ->get();

        $asalPeserta = DB::table('peserta_pelatihan_reguler')
            ->join('provinsi', 'peserta_pelatihan_reguler.id_provinsi', '=', 'provinsi.id')
            ->select('provinsi.nama_provinsi', DB::raw('count(*) as total'))
            ->groupBy('provinsi.nama_provinsi')
            ->orderByDesc('total')
            ->get();


        // Fasilitator paling sering terlibat
        $topFasilitator = DB::table(function ($query) {
            $query->select('id_fasilitator')
                ->from('reguler_fasilitators')
                ->unionAll(
                    DB::table('permintaan_fasilitators')->select('id_fasilitator')
                )
                ->unionAll(
                    DB::table('konsultasi_fasilitators')->select('id_fasilitator')
                );
        }, 'all_fasilitators')
            ->join('fasilitator_pelatihan', 'all_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->select(
                'fasilitator_pelatihan.nama_fasilitator',
                DB::raw('COUNT(*) as jumlah_terlibat')
            )
            ->groupBy('fasilitator_pelatihan.id_fasilitator', 'fasilitator_pelatihan.nama_fasilitator')
            ->orderByDesc('jumlah_terlibat')
            ->limit(5)
            ->get();


        return view('admin/home', [
            'title' => 'Beranda',
            'jumlahReguler' => $jumlahReguler,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahPermintaan' => $jumlahPermintaan,
            'jumlahKonsultasi' => $jumlahKonsultasi,
            'asalPeserta' => $asalPeserta,
            'topFasilitator' => $topFasilitator,
        ]);
    }

    public function asal()
    {
        // Jumlah pelatihan berdasarkan jenis
        $jumlahReguler = DB::table('reguler')->count();
        $jumlahPeserta = DB::table('users')
            ->where('roles', 'peserta')
            ->count();
        $jumlahPermintaan = DB::table('permintaan_pelatihan')->count();
        $jumlahKonsultasi = DB::table('konsultasi')->count();

        // Peserta berdasarkan asal (contoh: asal_instansi atau asal_kota)
        $asalPeserta = DB::table('peserta_pelatihan_reguler')
            ->join('provinsi', 'peserta_pelatihan_reguler.id_provinsi', '=', 'provinsi.id')
            ->select('provinsi.nama_provinsi', DB::raw('count(*) as total'))
            ->groupBy('provinsi.nama_provinsi')
            ->orderByDesc('total')
            ->get();


        // Fasilitator paling sering terlibat
        $topFasilitator = DB::table(function ($query) {
            $query->select('id_fasilitator')
                ->from('reguler_fasilitators')
                ->unionAll(
                    DB::table('permintaan_fasilitators')->select('id_fasilitator')
                )
                ->unionAll(
                    DB::table('konsultasi_fasilitators')->select('id_fasilitator')
                );
        }, 'all_fasilitators')
            ->join('fasilitator_pelatihan', 'all_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->select(
                'fasilitator_pelatihan.nama_fasilitator',
                DB::raw('COUNT(*) as jumlah_terlibat')
            )
            ->groupBy('fasilitator_pelatihan.id_fasilitator', 'fasilitator_pelatihan.nama_fasilitator')
            ->orderByDesc('jumlah_terlibat')
            ->limit(5)
            ->get();


        return view('admin.asal', [
            'title' => 'Beranda',
            'jumlahReguler' => $jumlahReguler,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahPermintaan' => $jumlahPermintaan,
            'jumlahKonsultasi' => $jumlahKonsultasi,
            'asalPeserta' => $asalPeserta,
            'topFasilitator' => $topFasilitator,
        ]);
    }

    public function usia()
    {
        // Jumlah pelatihan berdasarkan jenis
        $jumlahReguler = DB::table('reguler')->count();
        $jumlahPeserta = DB::table('users')
            ->where('roles', 'peserta')
            ->count();
        $jumlahPermintaan = DB::table('permintaan_pelatihan')->count();
        $jumlahKonsultasi = DB::table('konsultasi')->count();

        // Menghitung jumlah peserta berdasarkan rentang usia
        $usiaPeserta = DB::table('peserta_pelatihan_reguler')
            ->select('rentang_usia', DB::raw('COUNT(*) as total'))
            ->groupBy('rentang_usia')
            ->orderByDesc('total')
            ->get();


        // Fasilitator paling sering terlibat
        $topFasilitator = DB::table(function ($query) {
            $query->select('id_fasilitator')
                ->from('reguler_fasilitators')
                ->unionAll(
                    DB::table('permintaan_fasilitators')->select('id_fasilitator')
                )
                ->unionAll(
                    DB::table('konsultasi_fasilitators')->select('id_fasilitator')
                );
        }, 'all_fasilitators')
            ->join('fasilitator_pelatihan', 'all_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->select(
                'fasilitator_pelatihan.nama_fasilitator',
                DB::raw('COUNT(*) as jumlah_terlibat')
            )
            ->groupBy('fasilitator_pelatihan.id_fasilitator', 'fasilitator_pelatihan.nama_fasilitator')
            ->orderByDesc('jumlah_terlibat')
            ->limit(5)
            ->get();


        return view('admin.rentangusia', [
            'title' => 'Beranda',
            'jumlahReguler' => $jumlahReguler,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahPermintaan' => $jumlahPermintaan,
            'jumlahKonsultasi' => $jumlahKonsultasi,
            'usiaPeserta' => $usiaPeserta,
            'topFasilitator' => $topFasilitator,
        ]);
    }

    public function informasi()
    {
        // Jumlah pelatihan berdasarkan jenis
        $jumlahReguler = DB::table('reguler')->count();
        $jumlahPeserta = DB::table('users')
            ->where('roles', 'peserta')
            ->count();
        $jumlahPermintaan = DB::table('permintaan_pelatihan')->count();
        $jumlahKonsultasi = DB::table('konsultasi')->count();

        // Menghitung jumlah peserta berdasarkan rentang usia
        // Menghitung jumlah peserta berdasarkan asal informasi
        $informasiPeserta = DB::table('peserta_pelatihan_reguler')
            ->select('informasi', DB::raw('COUNT(*) as total'))
            ->groupBy('informasi')
            ->orderByDesc('total')
            ->get();


        // Fasilitator paling sering terlibat
        $topFasilitator = DB::table(function ($query) {
            $query->select('id_fasilitator')
                ->from('reguler_fasilitators')
                ->unionAll(
                    DB::table('permintaan_fasilitators')->select('id_fasilitator')
                )
                ->unionAll(
                    DB::table('konsultasi_fasilitators')->select('id_fasilitator')
                );
        }, 'all_fasilitators')
            ->join('fasilitator_pelatihan', 'all_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->select(
                'fasilitator_pelatihan.nama_fasilitator',
                DB::raw('COUNT(*) as jumlah_terlibat')
            )
            ->groupBy('fasilitator_pelatihan.id_fasilitator', 'fasilitator_pelatihan.nama_fasilitator')
            ->orderByDesc('jumlah_terlibat')
            ->limit(5)
            ->get();


        return view('admin.informasi', [
            'title' => 'Beranda',
            'jumlahReguler' => $jumlahReguler,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahPermintaan' => $jumlahPermintaan,
            'jumlahKonsultasi' => $jumlahKonsultasi,
            'informasiPeserta' => $informasiPeserta,
            'topFasilitator' => $topFasilitator,
        ]);
    }

    public function gender()
    {
        // Jumlah pelatihan berdasarkan jenis
        $jumlahReguler = DB::table('reguler')->count();
        $jumlahPeserta = DB::table('users')
            ->where('roles', 'peserta')
            ->count();
        $jumlahPermintaan = DB::table('permintaan_pelatihan')->count();
        $jumlahKonsultasi = DB::table('konsultasi')->count();

        // Menghitung jumlah peserta berdasarkan rentang usia
        // Menghitung jumlah peserta berdasarkan asal informasi
        $genderPeserta = DB::table('peserta_pelatihan_reguler')
            ->select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->orderByDesc('total')
            ->get();


        // Fasilitator paling sering terlibat
        $topFasilitator = DB::table(function ($query) {
            $query->select('id_fasilitator')
                ->from('reguler_fasilitators')
                ->unionAll(
                    DB::table('permintaan_fasilitators')->select('id_fasilitator')
                )
                ->unionAll(
                    DB::table('konsultasi_fasilitators')->select('id_fasilitator')
                );
        }, 'all_fasilitators')
            ->join('fasilitator_pelatihan', 'all_fasilitators.id_fasilitator', '=', 'fasilitator_pelatihan.id_fasilitator')
            ->select(
                'fasilitator_pelatihan.nama_fasilitator',
                DB::raw('COUNT(*) as jumlah_terlibat')
            )
            ->groupBy('fasilitator_pelatihan.id_fasilitator', 'fasilitator_pelatihan.nama_fasilitator')
            ->orderByDesc('jumlah_terlibat')
            ->limit(5)
            ->get();


        return view('admin.gender', [
            'title' => 'Beranda',
            'jumlahReguler' => $jumlahReguler,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahPermintaan' => $jumlahPermintaan,
            'jumlahKonsultasi' => $jumlahKonsultasi,
            'genderPeserta' => $genderPeserta,
            'topFasilitator' => $topFasilitator,
        ]);
    }

}
