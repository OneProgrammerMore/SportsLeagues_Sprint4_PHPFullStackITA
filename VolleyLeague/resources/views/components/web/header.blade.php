<nav id="navBar">
    <div id="webID" class="container-fluid">
        <i id="webLogo">
            <img
                id="webLogoImg"
                src="{{ Vite::asset("resources/img/cupLogo.png") }}"
                alt="Web Logo - The image of a Tournament Cup"
            />
        </i>
        <a id="webName" href="{{ route("leagues.index") }}">Cup</a>
    </div>

    <div id="navSections" class="flex flex-row">
        <div class="itemNav">
            <a
                class="link-nav link-nav-section"
                href="{{ route("leagues.index") }}"
            >
                <span class="icon icon-league-link icon-cup"></span>
                Leagues
            </a>
        </div>

        <div class="itemNav">
            <a
                class="link-nav link-nav-section"
                href="{{ route("matches.index", ["league" => $league->league_id]) }}"
            >
                <span class="icon icon-league-link icon-matches"></span>
                Matches
            </a>
        </div>

        <div class="itemNav">
            <a
                class="link-nav link-nav-section"
                href="{{ route("teams.index", ["league" => $league->league_id]) }}"
            >
                <span class="icon icon-league-link icon-teams"></span>
                Teams
            </a>
        </div>

        @if (Route::has("login"))
            @auth
                <div class="itemNav">
                    <a href="{{ url("/dashboard") }}" class="link-nav">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="itemNav">
                    <a
                        class="link-nav link-nav-section"
                        href="{{ route("login") }}"
                        class="link-nav"
                    >
                        <span class="icon icon-league-link icon-login"></span>
                        Log in
                    </a>
                </div>

                @if (Route::has("register"))
                    <div class="itemNav">
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
</nav>
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
