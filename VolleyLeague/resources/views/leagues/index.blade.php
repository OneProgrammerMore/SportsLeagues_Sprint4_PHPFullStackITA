@extends("layouts.app")

@section("content")
    <main>
        <div id="leagues-container">
            <div id="leagues-inner-container">
                @foreach ($leagues as $league)
                    <div class="league-container">
                        <div class="league-info">
                            <div class="league-img">
                                <img
                                    class="league-imgs-index"
                                    src="{{ asset($league->league_img_name ? "storage/public/" . $league->league_img_name : Vite::asset("resources/img/league.png")) }}"
                                    alt="Web Logo - The image of a Tournament Cup"
                                />
                            </div>
                            <div class="league-data">
                                <h3 class="league-name">
                                    {{ $league->league_name ?? "" }}
                                </h3>
                                <h3 class="league-status">
                                    {{ $league->league_status ?? "" }}
                                </h3>
                                <h3 class="league-type">
                                    [ {{ $league->league_type ?? "" }} ]
                                </h3>
                                <h3 class="league-date">
                                    <h2 class="title-bold">Starting on:</h2>
                                    {{ $league->league_starting_date ?? "" }}
                                </h3>
                                <h3 class="league-date">
                                    <h2 class="title-bold">Finishig on:</h2>
                                    {{ $league->league_starting_date ?? "" }}
                                </h3>
                                <h3 class="league-admin"></h3>
                            </div>
                        </div>

                        <div class="league-interactions-all">
                            <div class="league-links">
                                <div class="league-matches-link league-link">
                                    <a
                                        class="link-info"
                                        href="{{ route("matches.index", $league->league_id) }}"
                                    >
                                        <span
                                            class="icon icon-league-link icon-matches"
                                        ></span>
                                        <!-- <img class="btn-img" src="{{ asset("img/match.png") }}"> -->
                                        Matches
                                    </a>
                                </div>

                                <div class="league-teams-link league-link">
                                    <a
                                        class="link-info"
                                        href="{{ route("teams.index", $league->league_id) }}"
                                    >
                                        <!-- <img class="btn-img" src="{{ asset("img/teams.png") }}"> -->
                                        <span
                                            class="icon icon-league-link icon-teams"
                                        ></span>
                                        Teams
                                    </a>
                                </div>

                                <div class="league-info-link league-link">
                                    <a
                                        class="link-info"
                                        href="{{ route("leagues.show", $league->league_id) }}"
                                    >
                                        <!-- <img class="btn-img" src="{{ asset("img/info.png") }}"> -->
                                        <span
                                            class="icon icon-league-link icon-info"
                                        ></span>
                                        Info
                                    </a>
                                </div>
                            </div>

                            <div class="form-actions">
                                <form
                                    class="league-info-link league-link"
                                    action="{{ route("leagues.edit", $league->league_id) }}"
                                    method="post"
                                >
                                    @csrf
                                    @method("GET")
                                    <button type="submit" class="btn-edit">
                                        <!-- <img class="btn-img" src="{{ asset("img/edit.png") }}"> -->
                                        <span
                                            class="icon icon-league-link icon-pencil"
                                        ></span>
                                        Edit
                                    </button>
                                </form>

                                <form
                                    class="league-info-link league-link"
                                    action="{{ route("leagues.destroy", $league->league_id) }}"
                                    method="post"
                                >
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn-delete">
                                        <!-- <img class="btn-img" src="{{ asset("img/delete.png") }}"> -->
                                        <span
                                            class="icon icon-league-link icon-trash"
                                        ></span>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if (count($leagues) == 0)
            <!-- Empty State League Creation: -->
            <div id="leagueCreatorEmptyState">
                <h2>
                    There are not leagues to show.
                    <br />
                    Try creating a new League!
                </h2>
                <a class="btn-create" href="{{ route("leagues.create") }}">
                    <span class="icon icon-league-link icon-create"></span>
                    Create League
                </a>
            </div>
        @else
            <!-- Normal Creation Div -->

            <div id="leagueCreatorNormal">
                <h2>In order to create another League click the button!</h2>
                <a class="btn-create" href="{{ route("leagues.create") }}">
                    <span class="icon icon-league-link icon-create"></span>
                    Create League
                </a>
            </div>
        @endif
    </main>
@endsection
