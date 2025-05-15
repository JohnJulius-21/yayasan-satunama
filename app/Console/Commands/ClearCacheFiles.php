<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearCacheFiles extends Command
{
    protected $signature = 'cache:clear-files'; // Nama command
    protected $description = 'Hapus file cache yang lebih dari 30 hari';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $path = storage_path('app/public/cache_drive');
        $files = File::files($path);

        foreach ($files as $file) {
            if (now()->diffInDays(File::lastModified($file)) > 30) {
                File::delete($file);
                $this->info('Deleted: ' . $file);
            }
        }

        $this->info('Cache files older than 30 days have been deleted.');
    }
}

