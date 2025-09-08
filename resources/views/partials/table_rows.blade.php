{{-- File: partials/table_rows.blade.php --}}
@foreach($rows as $row)
    <tr class="bg-white hover:bg-gray-50 border-b border-gray-200 transition-colors duration-150">
        @foreach($columns as $column)
            @if($column['field'] === 'aksi')
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        @foreach($actions as $action)
                            @if(isset($action['isDelete']) && $action['isDelete'])
                                {{-- Tombol Delete dengan SweetAlert --}}
                                <button
                                    class="{{ $action['class'] }}"
                                    onclick="openDeleteModal('fasilitator', '/{{ $deleteRoutePrefix ?? '' }}/{{ $row->{$action['param']} }}')"
                                    title="Hapus Expert"
                                >
                                    {!! $action['label'] !!}
                                </button>
                            @else
                                {{-- Tombol link biasa --}}
                                <a href="{{ route($action['route'], $row->{$action['param']}) }}"
                                   class="{{ $action['class'] }}"
                                   @if($action['route'] === 'fasilitatorShowAdmin') title="Lihat Detail" @endif
                                   @if($action['route'] === 'fasilitatorEditAdmin') title="Edit Expert" @endif
                                >
                                    {!! $action['label'] !!}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </td>
            @else
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $row->{$column['field']} ?? '-' }}
                </td>
            @endif
        @endforeach
    </tr>
@endforeach
