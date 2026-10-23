@php
    // Both levels must respect the current reader's permissions.
    $directoryShelves = \BookStack\Entities\Models\Bookshelf::query()
        ->scopes('visible')->with('visibleBooks')->orderBy('name')->get();
@endphp
<nav class="bl-library-directory mb-xl" aria-label="Library directory">
    <h5>Library</h5>
    @foreach($directoryShelves as $directoryShelf)
        <div class="bl-directory-group">
            <a class="bl-directory-shelf" href="{{ $directoryShelf->getUrl() }}">
                @icon('bookshelf') <span>{{ $directoryShelf->name }}</span>
            </a>
            @if($directoryShelf->visibleBooks->isNotEmpty())
                <ul>
                    @foreach($directoryShelf->visibleBooks as $directoryBook)
                        <li><a href="{{ $directoryBook->getUrl('?shelf=' . $directoryShelf->id) }}">
                            @icon('book') <span>{{ $directoryBook->name }}</span>
                        </a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</nav>
