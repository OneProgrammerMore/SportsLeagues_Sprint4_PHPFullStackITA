@extends("layouts.app")

@section("content")
    <div class="cards-container">
        <div class="to-do main-section card section-header">
            Disclaimer
        </div>

        <div class="card">
            <div class="center-text-container">
                <div class="some-text">
                Hi! </br>
                The following links allow you to register and login.</br>
                Nonetheless remember that we do not held us responsible for any data loss or any problem or damage caused by this site usage. </br>
                If you are still willing to register or login to this site please do NOT use any real information, as email, password or other. </br>
                Any data stored in this site will be deleted peridocially after a predefined period of time. </br>
                </div>

            </div>
        </div>
        <div class="card">
            @if (Route::has("login"))
                @auth
                    <div class="item-nav">
                        <a href="{{ route("dashboard") }}" class="link-nav">
                            Dashboard
                        </a>
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
