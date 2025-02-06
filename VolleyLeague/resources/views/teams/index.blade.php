@extends('layouts.app')

@section('content')
        <main>
            @if (count($teams) > 0)
                <div id="teams-container">
                    <div id="teams-inner-container">
                        @foreach ($teams as $team)
                            <div class="team-container">
                                <div class="team-info">
                                    <div class="team-img">
                                        <img
                                            class="team-img"
                                            src="{{ asset($team->team_img_name ? "storage/public/" . $team->team_img_name : "img/team.png") }}"
                                            alt="Web Logo - The image of a Tournament Cup"
                                        />
                                    </div>
                                    <div class="team-data">
                                        <h3 class="team-name">
                                            {{ $team->team_name }}
                                        </h3>
                                        <h3 class="team-email">
                                            <span
                                                class="icon icon-league-link icon-mail team-data-img"
                                            ></span>
                                            {{ $team->team_email }}
                                        </h3>
                                        <h3 class="team-phone">
                                            <span
                                                class="icon icon-league-link icon-phone team-data-img"
                                            ></span>
                                            {{ $team->team_phone }}
                                        </h3>

                                        <h3 class="team-address">
                                            <span
                                                class="icon icon-league-link icon-address team-data-img"
                                            ></span>
                                            {{ $team->address_street ?? "" }}
                                            {{ $team->address_number ?? "" }}
                                            <br />
                                            {{ $team->address_floor ? $team->address_floor . " Floor" : "" }}
                                            {{ $team->address_door ? $team->address_door . " Door" : "" }}
                                            <br />
                                            {{ $team->address_city ?? "" }}
                                            {{ $team->address_postalcode ?? "" }}
                                            <br />
                                            {{ $team->address_country ?? "" }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="team-actions">
                                    <form
                                        class="league-info-link league-link"
                                        action="{{ route("teams.show", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                                        method="post"
                                    >
                                        @csrf
                                        @method("GET")
                                        <button type="submit" class="btn-info">
                                            <span
                                                class="icon icon-league-link icon-info"
                                            ></span>
                                            Show
                                        </button>
                                    </form>

                                    <form
                                        class="league-info-link league-link"
                                        action="{{ route("teams.edit", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                                        method="post"
                                    >
                                        @csrf
                                        @method("GET")
                                        <button type="submit" class="btn-edit">
                                            <span
                                                class="icon icon-league-link icon-pencil"
                                            ></span>
                                            Edit
                                        </button>
                                    </form>

                                    <form
                                        class="league-info-link league-link"
                                        action="{{ route("teams.destroy", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                                        method="post"
                                    >
                                        @csrf
                                        @method("DELETE")
                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            <span
                                                class="icon icon-league-link icon-trash"
                                            ></span>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (count($teams) == 0 and $league != null)
                <!-- Empty State team Creation: -->
                <div class="creator-empty-state">
                    <h2>
                        There are not teams to show.
                        <br />
                        Try creating a new team!
                    </h2>
                    <a
                        class="btn-create"
                        href="{{ route("teams.create", $league->league_id) }}"
                    >
                        <span class="icon icon-league-link icon-create"></span>
                        Create team
                    </a>
                </div>
            @elseif ($league != null)
                <!-- Normal Creation Div -->

                <div class="creator-normal">
                    <h2>In order to create another team click the button!</h2>
                    <a
                        class="btn-create"
                        href="{{ route("teams.create", $league->league_id) }}"
                    >
                        <span class="icon icon-league-link icon-create"></span>
                        Create team
                    </a>
                </div>
            @endif
        </main>

@endsection