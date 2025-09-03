{{-- resources/views/admin/reguler/table_rows.blade.php --}}
@foreach ($reguler as $item)
    @php
        $status = App\Http\Controllers\RegulerController::getStatusByDate($item->tanggal_mulai, $item->tanggal_selesai);
    @endphp
    <tr class="hover:bg-gray-50 transition-colors duration-150" data-status="{{ $status['status'] }}"
        data-category="{{ $item->id_tema }}">
        <td class="px-12 py-3 text-gray-900">{{ $item->nama_pelatihan }}</td>
        <td class="px-4 py-3 text-gray-700">
            {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->isoFormat('D MMMM') }}
            -
            {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->isoFormat('D MMMM Y') }}
        </td>
        <td class="px-4 py-3 text-gray-700">
            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
            -
            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
        </td>
        <td class="px-4 py-3">
            <span class="text-xs px-2 py-1 font-medium">
                {{ $item->tema->judul_tema }}
            </span>
        </td>
        <td class="px-4 py-3">
            <span class="{{ $status['class'] }} text-xs px-2 py-1 rounded-full font-medium">
                {{ $status['label'] }}
            </span>
        </td>
        {{--        <td class="px-4 py-3">--}}
        {{--            <div class="flex gap-2">--}}
        {{--                <a href="{{ route('regulerShowAdmin', $item->id_reguler) }}"--}}
        {{--                   class="bg-gray-100 text-gray-700 text-xs px-3 py-1.5 rounded-md hover:bg-gray-200 transition-colors duration-150 font-medium">--}}
        {{--                    👁️ View--}}
        {{--                </a>--}}
        {{--                <a href="{{ route('regulerEditAdmin', $item->id_reguler) }}"--}}
        {{--                   class="bg-yellow-50 text-gray-700 text-xs px-3 py-1.5 rounded-md hover:bg-yellow-100 transition-colors duration-150 font-medium">--}}
        {{--                    ✏️ Edit--}}
        {{--                </a>--}}
        {{--                <form action="{{ route('regulerDestroyAdmin', $item->id_reguler) }}" method="POST" class="deleteForm inline">--}}
        {{--                    @csrf--}}
        {{--                    @method('DELETE')--}}
        {{--                    <button--}}
        {{--                        class="bg-red-50 text-red-700 text-xs px-3 py-1.5 rounded-md hover:bg-red-100 transition-colors duration-150 font-medium">--}}
        {{--                        🗑️ Delete--}}
        {{--                    </button>--}}
        {{--                </form>--}}
        {{--            </div>--}}
        {{--        </td>--}}
        <td class="px-6 py-4 whitespace-nowrap text-center">
            <div class="flex items-center justify-center space-x-1">
                <a href="{{ route('regulerShowAdmin', $item->id_reguler) }}"
                   class="inline-flex items-center p-2 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </a>
                <a href="{{ route('regulerEditAdmin', $item->id_reguler) }}"
                   class="inline-flex items-center p-2 border border-yellow-300 shadow-sm text-xs font-medium rounded-md text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </a>
                    <button type="button"
                            class="inline-flex items-center p-2 border border-red-300 shadow-sm text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                            onclick="openDeleteModal('pelatihan', '{{ route('regulerDestroyAdmin', $item->id_reguler) }}')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
            </div>
        </td>
    </tr>
@endforeach
