@extends("layouts.app")

@section("content")
    <div class="cards-container">
        <div class="main-section card section-header">
            Dashboard
        </div>

        <div class="text-section card">
            <div class="center-text-container">
            <div class="some-text">
                Welcome to Cup! </br>A sports league organizator.
            </div>
            </div>
        </div>
        <div class="card">
            @if (Route::has("login"))
                @auth
                    <div class="item-nav">
                        <form
                            class="link-nav link-disclaimer link-login"
                            action="{{ route("logout") }}"
                            method="POST"
                        >   
                            @csrf
                            <button type="submit">
                                <span
                                    class="icon icon-league-link icon-login"
                                ></span>
                                Log Out
                            </button>
                        </form>
                    </div>
                @else
                    <div class="item-nav">
                        <a
                            class="link-nav link-disclaimer link-login"
                            href="{{ route("login") }}"
                            class="link-nav"
                        >
                            <span
                                class="icon icon-league-link icon-login"
                            ></span>
                            Log in
                        </a>
                    </div>

                    @if (Route::has("register"))
                        <div class="item-nav">
                            <a
                                class="link-nav link-disclaimer link-register"
                                href="{{ route("register") }}"
                                class="link-nav"
                            >
                                <span
                                    class="icon icon-league-link icon-register"
                                ></span>
                                Register
                            </a>
                        </div>
                    @endif
                @endauth
            @endif

        </div>
    </div>
@endsection
