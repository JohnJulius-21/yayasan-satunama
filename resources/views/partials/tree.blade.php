<ul class="list-unstyled">
    @foreach ($branch as $name => $node)
    
        @if (is_array($node) && isset($node['file_url']))
            {{-- FILE --}}
            <li class="d-flex align-items-center ms-2 my-1">
                <i class="bi bi-file-earmark-text me-2"></i>
                <a href="{{ $node['file_url'] }}" target="_blank" class="text-decoration-none">
                    {{ $node['file_name'] }}
                </a>
            </li>
    
        @elseif (is_array($node))
            {{-- FOLDER --}}
            <li x-data="{open:false}" class="my-1">
                <div class="d-flex align-items-center"
                     @click="open=!open"
                     style="cursor:pointer;">
                    <i :class="open ? 'bi-folder2-open' : 'bi-folder'" class="bi me-2"></i>
                    <span>{{ $name }}</span>
                </div>
    
                <div x-show="open" x-transition>
                    @include('partials.tree', ['branch' => $node])
                </div>
            </li>
        @endif
    
    @endforeach
    </ul>
    