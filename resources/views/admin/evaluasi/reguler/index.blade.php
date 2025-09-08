@extends('layouts.app')
@section('title', 'Admin | Evaluasi Pelatihan Reguler')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Evaluasi Pelatihan Reguler</h6>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 4000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif

    <x-data-table
        title="Data Pelatihan Reguler"
        description="Kelola data pelatihan reguler dengan mudah"
        search-placeholder="Cari pelatihan..."
        :columns="$columns"
        :add-button="false"
        search-route="{{ route('evaluasiRegulerAdmin') }}"
        table-id="pelatihanTable"
        :show-back-button="false"
        :show-pagination="true"
    >
        @include('partials.table_rows', [
            'rows' => $data,
            'columns' => $columns,
            'actions' => $actions
        ])
    </x-data-table>
@endsection
