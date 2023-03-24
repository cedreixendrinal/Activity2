<div style="background-color: #2E556A">
    <div class="container p-3 pb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($page['breadcrumbs'] as $key => $breadcrumb)
                    @if ($loop->last)
                    <li class="breadcrumb-item text-light "><a class="text-decoration-none active text-light " href="{{ $breadcrumb['href'] }}">
                        {{ $breadcrumb['title'] }} </a>
                    </li>
                    @else
                    <li class="breadcrumb-item"><a class="text-decoration-none" style="color: #95bacf;" href="{{ $breadcrumb['href'] }}">
                            {{ $breadcrumb['title'] }} </a>
                    </li>
                    @endif
                @endforeach
            </ol>
        </nav>
        <div class="mt-2">
            <div class="h1 text-warning font-weight-bold mb-0"><span class="">{{ $page['title'] }}</span></div>
        </div>
        <div class="text-light font-weight-light"> {{ $page['description'] }} </div>

        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">All materials</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">All events</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>
</div>
</small></small>
</div>
