@extends("layouts.app")

@section("content")
    <!-- INFORMATION IN leagues/{league} -->
    <!-- League Info -->
    <!-- League Classification -->
    <!-- League Results -->
    <!-- League Next Matches -->

    <div class="league-container-show">
        <div class="league-info">
            <div class="team-img-container">
                <img
                    class="team-img"
                    src="{{ asset($team->team_img_name ? "storage/public/" . $team->team_img_name : "img/team.png") }}"
                    alt="Image of the team"
                />
            </div>
            <div class="league-data">
                <h3 class="team-name">{{ $team->team_name }}</h3>
            </div>
            <div class="team-data">
                <div class="team-email data-field">
                    <span
                        class="icon icon-league-link icon-mail team-data-img"
                    ></span>
                    <div class="field-text">
                        {{ $team->team_email }}
                    </div>
                </div>
                <div class="team-phone data-field">
                    <span
                        class="icon icon-league-link icon-phone team-data-img"
                    ></span>
                    <div class="field-text">
                        {{ $team->team_phone }}
                    </div>
                </div>

                <div class="team-address data-field">
                    <span
                        class="icon icon-league-link icon-address team-data-img"
                    ></span>
                    <div class="team-address-data">
                        {{ $team_address->street ?? "" }}
                        {{ $team_address->number ?? "" }}
                        <br />
                        {{ $team_address->floor ? $team_address->floor . " Floor" : "" }}
                        {{ $team_address->door ? $team_address->door . " Door" : "" }}
                        <br />
                        {{ $team_address->city ?? "" }}
                        {{ $team_address->postalcode ?? "" }}
                        <br />
                        {{ $team_address->country ?? "" }}
                    </div>
                </div>
            </div>

            <div class="team-data responsible-data">
                <div class="title-container">
                    <h3 class="title-section">Team Responsible:</h3>
                </div>

                <h3 class="team-responsible-name team-data-field">
                    {{ $team_responsible->person_surname_1 ?? "" }}
                    {{ $team_responsible->person_surname_2 ?? "" }}
                    {{ $team_responsible->person_name ?? "" }}
                </h3>
                <h3 class="team-responsible-mail team-data-field">
                    {{ $team_responsible->person_email ?? "" }}
                </h3>
                <h3 class="team-responsible-mail team-data-field">
                    {{ $team_responsible->person_phone ?? "" }}
                </h3>

                <h3 class="team-responsible-address team-data-field">
                    {{ $team_responsible_address->street ?? "" }}
                    {{ $team_responsible_address->number ?? "" }}
                    <br />
                    {{ $team_responsible_address->floor ? $team_responsible_address->floor . " Floor" : "" }}
                    {{ $team_responsible_address->door ? $team_responsible_address->door . " Door" : "" }}
                    <br />
                    {{ $team_responsible_address->city ?? "" }}
                    {{ $team_responsible_address->postalcode ?? "" }}
                    <br />
                    {{ $team_responsible_address->country ?? "" }}
                </h3>
            </div>
        </div>

        <div class="league-actions">
            <form
                class="league-link-action"
                action="{{ route("teams.edit", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                method="post"
            >
                @csrf
                @method("GET")
                <button type="submit" class="btn-edit">Edit</button>
            </form>

            <form
                class="league-link-action"
                action="{{ route("teams.destroy", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                method="post"
            >
                @csrf
                @method("DELETE")
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>
    </div>

    <!-- League Classification -->
    <!-- League Results -->
    <!-- League Next Matches -->

    <!-- Teams Minimal Info Show With Component -->
    @php
        $leagueId = $league->league_id;
        $teamId = $team->team_id;
    @endphp

    <x-players.showPlayersMinInfo :leagueId="$leagueId" :teamId="$teamId" />

    @if (count($players) == 0)
        <!-- Empty State team Creation: -->
        <div class="creator-empty-state creator-normal">
            <h2>
                There are not players to show...
                <br />
                Try creating a new player!
            </h2>
            <a
                class="btn-create"
                href="{{ route("players.create", ["league" => $league->league_id, "team" => $team->team_id]) }}"
            >
                Create PLayer
            </a>
        </div>
    @else
        <!-- Normal Creation Div -->

        <div class="creator-normal">
            <a
                class="btn-create"
                href="{{ route("players.create", ["league" => $league->league_id, "team" => $team->team_id]) }}"
            >
                Create player
            </a>
        </div>
    @endif
@endsection
