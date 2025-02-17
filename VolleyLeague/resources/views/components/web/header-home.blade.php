<nav id="navBar">
    <div id="webID" class="container-fluid">
        <i id="web-logo">
            <img
                id="webLogoImg"
                src="{{ Vite::asset("resources/img/cupLogoWhite.png") }}"
                alt="Web Logo - The image of a Tournament Cup"
            />
        </i>
        <a id="web-name" href="{{ route("leagues.index") }}">Cup</a>
    </div>

    <div id="navSections">
        <div class="web-nav">
            <div class="item-nav">
                <a
                    class="link-nav link-nav-section"
                    href="{{ route("leagues.index") }}"
                >
                    <span class="icon icon-league-link icon-cup"></span>
                    Home - Leagues
                </a>
            </div>
        </div>
        <div class="user-nav">
            @if (Route::has("login"))
                @auth
                    <div class="item-nav-user">
                        <a href="{{ url("/dashboard") }}" class="link-nav">
                            Dashboard
                        </a>
                    </div>
                @else
                    <div class="item-nav-user">
                        <a
                            class="link-nav link-nav-section"
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
                        <div class="item-nav-user">
                            <a
                                class="link-nav link-nav-section"
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
    <div id="menu-icon">
        <a
            href="javascript:void(0)"
            class="nav-menu-icon menu-i"
            onclick="openNav()"
        >
            <span class="icon icon-league-link icon-menu"></span>
        </a>
        <a
            href="javascript:void(0)"
            class="nav-side close-i nav-menu-icon"
            onClick="closeNav()"
        >
            <span class="icon icon-league-link icon-cancel"></span>
        </a>
    </div>
</nav>
