<?php

namespace App\Http\Controllers;

use App\Models\reguler;
use App\Models\presensi_reguler;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PresensiController extends Controller
{
    public function indexReguler()
    {
        $reguler = reguler::all();
        // $reguler = reguler::findOrFail($id);
        return view('admin.presensi.index', compact('reguler'));
    }

    public function generateQRCode($id)
    {
        $reguler = reguler::findOrFail($id);
        // $qrData = route('presensi.scan', $reguler);

        // Generate QR Code (format PNG)
        $qrCode = QrCode::size(512)->generate($reguler->id_reguler);

        // dd($qrCode);

        return view('admin.presensi.create', compact('reguler', 'qrCode'));
    }

    public function store(Request $request)
    {
        $request->validate(['judul' => 'required']);

        $presensi = presensi_reguler::create(['judul' => $request->judul]);

        // $qrData = route('presensi.scan', $presensi->id);
        $qrCode = QrCode::size(300)->generate($qrData);

        Storage::put('qrcodes/' . $presensi->id . '.png', $qrCode);

        $presensi->update(['qr_code' => 'qrcodes/' . $presensi->id . '.png']);

        return redirect()->route('presensi.show', $presensi->id);
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
