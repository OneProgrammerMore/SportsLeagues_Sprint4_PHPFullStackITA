@extends("layouts.app")

@section("content")
    <div id="teams-container" class="cards-container">
        @if (count($teams) > 0)
            @foreach ($teams as $team)
                <div class="team-container">
                    <div class="team-info">
                        <div class="league-info-link">
                            <a
                                class="link-info"
                                href="{{ route("teams.show", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                            >
                                <span
                                    class="icon icon-league-link icon-info"
                                ></span>
                            </a>
                        </div>
                        <div class="team-img-container">
                            <img
                                class=""
                                src="{{ asset($team->team_img_name ? "storage/" . $team->team_img_name : "img/team.png") }}"
                                alt="Web Logo - The image of a Tournament Cup"
                            />
                        </div>

                        <div class="team-header">
                            <h3 class="team-name">
                                {{ $team->team_name }}
                            </h3>
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
                            @if($team->address_country)
                            <div class="team-address data-field">
                                <span
                                    class="icon icon-league-link icon-address team-data-img"
                                ></span>
                                <div class="team-address-data">
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
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @auth
        @if (count($teams) == 0 and $league != null)
            <!-- Empty State team Creation: -->
            <div class="cards-container">
            <div class="creator-normal">
                <h2>
                    There are not teams to show.
                    <br />
                    Try creating a new team!
                </h2>
                <a
                    class="btn-create"
                    href="{{ route("teams.create", $league->league_id) }}"
                >
                    Create team
                </a>
            </div>
            </div>
        @elseif ($league != null)
            <!-- Normal Creation Div -->
            <div class="cards-container">
            <div class="creator-normal">
                <h2>Create a new team</h2>
                <a
                    class="btn-create"
                    href="{{ route("teams.create", $league->league_id) }}"
                >
                    Create
                </a>
            </div>
            </div>
        @endif
    @endauth
@endsection
