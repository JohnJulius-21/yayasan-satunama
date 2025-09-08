<?php
// config/datatable.php

return [
    /*
    |--------------------------------------------------------------------------
    | Default DataTable Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the default configuration options for the DataTable
    | component. You can override these values when using the component.
    |
    */

    'defaults' => [
        'items_per_page' => 25,
        'debounce_delay' => 300,
        'max_page_numbers' => 5,
        'show_pagination' => true,
        'show_entries_select' => true,
        'show_back_button' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination Options
    |--------------------------------------------------------------------------
    |
    | Define the available options for entries per page dropdown
    |
    */

    'pagination_options' => [10, 25, 50, 100],

    /*
    |--------------------------------------------------------------------------
    | Default Styling
    |--------------------------------------------------------------------------
    |
    | Default CSS classes and styling options
    |
    */

    'styles' => [
        'header_gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        'primary_color' => '#667eea',
        'success_color' => '#10b981',
        'danger_color' => '#ef4444',
        'warning_color' => '#f59e0b',
    ],

    /*
    |--------------------------------------------------------------------------
    | Status Configurations
    |--------------------------------------------------------------------------
    |
    | Common status configurations for different data types
    |
    */

    'status_configs' => [
        'pelatihan' => [
            'upcoming' => [
                'class' => 'bg-yellow-100 text-yellow-800',
                'text' => 'Belum Mulai',
                'icon' => 'clock'
            ],
            'on-going' => [
                'class' => 'bg-green-100 text-green-800',
                'text' => 'Sedang Berlangsung',
                'icon' => 'play'
            ],
            'completed' => [
                'class' => 'bg-gray-100 text-gray-800',
                'text' => 'Selesai',
                'icon' => 'check'
            ],
        ],

        'peserta' => [
            'pending' => [
                'class' => 'bg-yellow-100 text-yellow-800',
                'text' => 'Menunggu',
                'icon' => 'clock'
            ],
            'confirmed' => [
                'class' => 'bg-green-100 text-green-800',
                'text' => 'Terkonfirmasi',
                'icon' => 'check-circle'
            ],
            'completed' => [
                'class' => 'bg-blue-100 text-blue-800',
                'text' => 'Selesai',
                'icon' => 'check'
            ],
            'cancelled' => [
                'class' => 'bg-red-100 text-red-800',
                'text' => 'Dibatalkan',
                'icon' => 'x-circle'
            ],
        ],

        'generic' => [
            'active' => [
                'class' => 'bg-green-100 text-green-800',
                'text' => 'Aktif',
                'icon' => 'check-circle'
            ],
            'inactive' => [
                'class' => 'bg-gray-100 text-gray-800',
                'text' => 'Tidak Aktif',
                'icon' => 'x-circle'
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Button Configurations
    |--------------------------------------------------------------------------
    |
    | Common action button configurations
    |
    */

    'actions' => [
        'view' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>',
            'class' => 'text-blue-600 hover:text-blue-900',
            'title' => 'Lihat Detail'
        ],
        'edit' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>',
            'class' => 'text-indigo-600 hover:text-indigo-900',
            'title' => 'Edit'
        ],
        'delete' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>',
            'class' => 'text-red-600 hover:text-red-900',
            'title' => 'Hapus'
        ],
        'confirm' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
            'class' => 'text-green-600 hover:text-green-900',
            'title' => 'Konfirmasi'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    |
    | Text localization for the component
    |
    */

    'lang' => [
        'search_placeholder' => 'Cari data...',
        'all_status' => 'Semua Status',
        'all_categories' => 'Semua Kategori',
        'add_button' => 'Tambah Data',
        'showing' => 'Menampilkan',
        'to' => 'sampai',
        'of' => 'dari',
        'entries' => 'data',
        'show' => 'Tampilkan:',
        'no_data' => 'Tidak ada data yang ditemukan',
        'no_data_filter' => 'Tidak ada data yang sesuai dengan filter',
        'loading' => 'Memuat data...',
        'error_loading' => 'Terjadi kesalahan saat memuat data',
        'confirm_delete' => 'Yakin hapus?',
        'confirm_delete_text' => 'Data yang dihapus tidak bisa dikembalikan!',
        'yes_delete' => 'Ya, hapus!',
        'cancel' => 'Batal',
    ],
];
