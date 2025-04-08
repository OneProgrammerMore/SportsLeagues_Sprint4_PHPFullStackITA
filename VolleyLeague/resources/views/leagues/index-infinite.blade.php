@extends("layouts.app")

@section("content")
    <div id="leagues-container" class="cards-container">

        @if ($leagues_count == 0)
            <!-- Empty State League Creation: -->
            <div class="creator-normal">
                <h2>
                    There are not leagues to show.
                    <br />
                    Try creating a new one!
                </h2>
                <a class="btn-create" href="{{ route("leagues.create") }}">
                    Create League
                </a>
            </div>
        @else
            <!-- Normal Creation Div -->
            <div class="creator-normal">
                <a class="btn-create" href="{{ route("leagues.create") }}">
                    Create League
                </a>
            </div>
        @endif
    </div>
    @livewire('fetch-leagues')

    
@endsection
