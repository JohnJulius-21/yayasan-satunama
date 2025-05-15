<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\reguler;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PreloadPelatihanImages extends Command
{
    protected $signature = 'preload:pelatihan-images';
    protected $description = 'Preload semua gambar pelatihan ke cache lokal';

    public function handle()
    {
        $regulers = reguler::all();
        foreach ($regulers as $item) {
            $filename = \DB::table('reguler_images')
                ->where('id_reguler', $item->id_reguler)
                ->value('image_url');

            if ($filename) {
                $cachePath = storage_path('app/public/cache_drive/' . $filename);

                if (!file_exists(dirname($cachePath))) {
                    mkdir(dirname($cachePath), 0775, true);
                }

                if (!file_exists($cachePath)) {
                    $data = Gdrive::get($filename);

                    if ($data && !empty($data->file)) {
                        file_put_contents($cachePath, $data->file);
                        $this->info("Berhasil simpan: $filename");
                    } else {
                        $this->warn("Gagal ambil: $filename");
                    }
                } else {
                    $this->line("Sudah ada: $filename");
                }
            }
        }

        $this->info("Selesai preload semua gambar pelatihan.");
    }
}

