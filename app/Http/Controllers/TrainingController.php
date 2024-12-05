<?php

namespace App\Http\Controllers;

use App\Models\negara;
use App\Models\provinsi;
use App\Models\kabupaten_kota;
use App\Models\jenis_organisasi;
use App\Models\rentang_usia;
use App\Models\informasi_pelatihan;
use App\Models\reguler;
use App\Models\pelatihan;
use App\Models\peserta_pelatihan_reguler;
use App\Models\peserta_pelatihan_permintaan;
use App\Models\peserta_pelatihan_konsultasi;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $reguler = reguler::paginate(3);

        return view('user.training.index', compact('reguler'), [
            'title' => 'Pelatihan',
        ]);
    }

    public function showReguler($id)
    {
        // Fetch the specific pelatihan by its ID
        $pelatihan = reguler::findOrFail($id);
        // dd($pelatihan);

        if (!$pelatihan) {
            abort(404, 'Pelatihan not found');
        }

        // Return the view with the pelatihan details
        return view('user.training.reguler.show', compact('pelatihan'), [
            'title' => 'Detail Pelatihan',
        ]);
    }

    public function indexReguler(Request $request)
    {
        // Fetch the specific pelatihan by its ID
        $query = $request->input('search');

        if ($query) {
            // Filter pelatihan berdasarkan nama_pelatihan
            $reguler = reguler::where('nama_pelatihan', 'like', "%{$query}%")->get();
        } else {
            $reguler = reguler::all();
        }

        // Cek apakah ada pelatihan yang ditemukan
        $isEmpty = $reguler->isEmpty();

        // Return the view with the pelatihan details
        return view('user.training.reguler.index', compact('reguler', 'isEmpty'), [
            'title' => 'Detail Pelatihan',
        ]);
    }

    public function getProvinsi($negaraId)
    {
        try {
            $provinsiList = Provinsi::where('id_negara', $negaraId)->pluck('nama_provinsi', 'id')->toArray();

            return response()->json(['provinsi' => $provinsiList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getKabupaten($provinsiId)
    {
        try {
            $kabupatenList = kabupaten_kota::where('id_provinsi', $provinsiId)->pluck('nama_kabupaten_kota', 'id')->toArray();

            return response()->json(['kabupaten' => $kabupatenList], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReguler($id)
    {
        $user = auth()->user(); // Get the authenticated user
        $pelatihan = Pelatihan::findOrFail($id); // Retrieve pelatihan based on id
        $rentang_usia = Rentang_Usia::all(); // Retrieve all age ranges
        $negara = Negara::all(); // Retrieve all countries
        $jenis_organisasi = jenis_organisasi::all(); // Retrieve organization types
        $informasi_pelatihan = Informasi_Pelatihan::all(); // Retrieve training information sources

        return view('user.training.reguler.create', compact(
            'pelatihan',
            'user',
            'rentang_usia',
            'negara',
            'jenis_organisasi',
            'informasi_pelatihan'

        ), [
            'title' => 'Daftar Pelatihan',
        ]);
    }

    public function storeReguler(Request $request)
    {
        dd($request->all());
    }

    public function createPermintaan()
    {
        return view('user.training.permintaan.create', [
            'title' => 'Pelatihan Permintaan',
        ]);
    }

    public function createKonsultasi()
    {
        $negara = Negara::all();
        return view('user.training.konsultasi.create', compact(

            'negara',

        ), [
            'title' => 'Pelatihan Konsultasi',
        ]);
    }

    public function indexPelatihan()
    {
        $user = auth()->user();

        return view('user.training.pelatihan.index', compact('user'), [
            'title' => 'Pelatihan Saya',
        ]);
    }

    public function regulerList()
    {
        // dd(request()->all());
        $pelatihans = peserta_pelatihan_reguler::with('pelatihan')->where('id_user', auth()->user()->id)->get()->sortByDesc(function ($item) {
            return $item->pelatihan->tanggal_mulai; // Mengurutkan berdasarkan tanggal mulai
        });
        // dd($pelatihans);
        return view('user.training.pelatihan.reguler', compact('pelatihans'), [
            'title' => 'Pelatihan Saya',
            'pelatihan' => $pelatihans
        ]);
    }

    public function permintaanShow()
    {
        // $user = auth()->user();
        $permintaans = peserta_pelatihan_permintaan::with(['permintaan_pelatihan'])->where('id_user', auth()->user()->id)->get();
        return view('user.training.pelatihan.permintaan', compact('permintaans'),[
            'title' => 'Pelatihan Saya',
            // 'pelatihans' => $permintaans
        ]);
    }

    public function konsultasiShow()
    {
        // $user = auth()->user();
        $konsultasis = peserta_pelatihan_konsultasi::with(['pelatihan_konsultasis'])->where('id_user', auth()->user()->id)->get();
        return view('user.training.pelatihan.konsultasi', compact('konsultasis'),[
            'title' => 'Pelatihan Saya',
            // 'pelatihans' => $konsultasis
        ]);
    }






}
