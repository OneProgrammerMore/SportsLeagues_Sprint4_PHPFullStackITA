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
                    Leagues
                </a>
            </div>

            <div class="item-nav">
                <a
                    class="link-nav link-nav-section"
                    href="{{ route("matches.index", ["league" => $league->league_id]) }}"
                >
                    <span class="icon icon-league-link icon-matches"></span>
                    Matches
                </a>
            </div>

            <div class="item-nav">
                <a
                    class="link-nav link-nav-section"
                    href="{{ route("teams.index", ["league" => $league->league_id]) }}"
                >
                    <span class="icon icon-league-link icon-teams"></span>
                    Teams
                </a>
            </div>
        </div>

        <div class="user-nav">
            @if (Route::has("login"))
                @auth
                    <div class="item-nav">
                        <a href="{{ route("dashboard") }}" class="link-nav link-nav-section">
                            Dashboard
                        </a>
                    </div>
            @else
                    <div class="item-nav">
                        <a
                            class="link-nav link-nav-section"
                            href="{{route("disclaimer-user.show")}}"
                        >
                        <span class="icon icon-login"></span>
                        </a>
                    </div>
                @endauth
            @endif
        </div>
    </div>
    <div id="menu-icon">
        <a
            id="openNavIcon"
            href="javascript:void(0)"
            class="nav-menu-icon menu-i"
        >
            <span class="icon icon-league-link icon-menu"></span>
        </a>
        <a
            id="closeNavIcon"
            href="javascript:void(0)"
            class="nav-side close-i nav-menu-icon"
        >
            <span class="icon icon-league-link icon-cancel"></span>
        </a>
    </div>
</nav>
