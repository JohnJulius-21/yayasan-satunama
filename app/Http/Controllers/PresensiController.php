<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\permintaan_pelatihan;
use Illuminate\Http\Request;
use App\Models\presensi_reguler;
use App\Models\presensi_pelatihan_reguler;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PresensiController extends Controller
{
    public function indexReguler()
    {
        $reguler = reguler::all();
        // $reguler = reguler::findOrFail($id);
        return view('admin.presensi.reguler.index', compact('reguler'));
    }

    public function showReguler($id)
    {
        $reguler = reguler::findOrFail($id);
        $presensi = DB::table('presensi_reguler')
            ->where('id_reguler', $id)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });

        // dd($presensi);

        return view('admin.presensi.reguler.show', compact('reguler', 'presensi'));
    }

    public function showPresensiPesertaReguler($id_presensi)
    {
        $presensi = presensi_reguler::findOrFail($id_presensi);

        // Ambil semua peserta pelatihan berdasarkan id_reguler
        $peserta = DB::table('peserta_pelatihan_reguler')
            ->where('id_reguler', $presensi->id_reguler)
            ->get();

        // Ambil ID peserta yang sudah hadir
        $hadirIds = DB::table('presensi_pelatihan_reguler')
            ->where('id_presensi_reguler', $id_presensi)
            ->pluck('id_peserta')
            ->toArray();

        // Tandai status presensi pada setiap peserta
        foreach ($peserta as $p) {
            $p->status_presensi = in_array($p->id_peserta_reguler, $hadirIds) ? 'Sudah Presensi' : 'Belum Presensi';
        }

        return view('admin.presensi.reguler.show-peserta', compact('presensi', 'peserta'));
    }


    public function generateQRCode($id)
    {
        $reguler = reguler::findOrFail($id);
        // $qrData = route('presensi.reguler.scan', $reguler);

        // Generate QR Code (format PNG)
        $qrCode = QrCode::size(512)->generate($reguler->id_reguler);

        // dd($qrCode);

        return view('admin.presensi.reguler.create', compact('reguler', 'qrCode'));
    }

    public function store(Request $request, $id)
    {
        $request->validate(['judul_presensi' => 'required']);

        $reguler = reguler::findOrFail($id);

        // Step 1: Simpan dulu presensi TANPA qr_code
        $presensi = new presensi_reguler;
        $presensi->id_reguler = $reguler->id_reguler;
        $presensi->judul_presensi = $request->judul_presensi;
        $presensi->qr_code = ''; // placeholder agar tidak error jika masih NOT NULL
        // dd($presensi);
        $presensi->save(); // Sekarang ID tersedia

        // $presensiId = presensi_reguler::findOrFail($id);
        // Step 2: Buat QR Code berdasarkan ID yang baru dibuat
        $qrData = route('scanQrPresensi', [
            'id' => $reguler->id_reguler,
            'presensi' => $presensi->id_presensi,
        ]);

        // dd($qrData);
        $qrCodeSvg = QrCode::size(200)->generate($qrData);

        // Step 3: Update presensi dengan qr_code
        $presensi->qr_code = $qrCodeSvg;
        $presensi->update();

        return redirect()->route('adminShowPresensiReguler', $reguler->id_reguler)->with('success', 'Presensi berhasil disimpan');
    }

    // permintaan

    public function indexPermintaan()
    {
        $permintaan = permintaan_pelatihan::all();
        // $reguler = reguler::findOrFail($id);
        return view('admin.presensi.permintaan.index', compact('permintaan'));
    }


    public function scanQRCode($trainingId)
    {
        $training = reguler::findOrFail($trainingId);
        return view('user.attendance.scan', compact('training'));
    }

    public function processQRScan(Request $request, $trainingId)
    {
        $user = auth()->user();
        $qrData = $request->input('qr_data');

        // Validasi apakah QR Code valid
        $expectedQRData = route('attendance.scan', $trainingId);
        if ($qrData !== $expectedQRData) {
            return back()->with('error', 'QR Code tidak valid!');
        }

        // Cek apakah sudah pernah melakukan presensi
        $existingAttendance = Attendance::where('training_id', $trainingId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Anda sudah melakukan presensi sebelumnya!');
        }

        // Simpan presensi
        Attendance::create([
            'id_reguler' => $trainingId,
            'id_peserta' => $user->id,
            'tanggal_presensi' => now(),
            'qr_code' => $qrData,
        ]);

        return back()->with('success', 'Presensi berhasil!');
    }

}
