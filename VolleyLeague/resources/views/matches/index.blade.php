@extends("layouts.app")

@section("content")
    <div class="tool-bar-complete">
        <div class="tool-bar">
            <form class="more-info-matches-form">
                <div id="moreInfoMatchesToggleSwitch" class="toolbar-switch">
                    <h3 class="toolbar-title">More Info</h3>
                    <label class="switch">
                        <input
                            type="checkbox"
                            onclick="showMoreInfoMatches()"
                            name="moreInfoMatchesToggleSwitch"
                        />
                        <span class="slider round"></span>
                    </label>
                </div>
            </form>

            <button onclick="openSelectWeeksForm()">
                <span class="icon icon-league-link icon-search" id="search-icon-tool"></span>
            </button>
        </div>

        <div id="search-tool-hidden-form">
            <div class="search-tool">
                <div id="search-week">
                    <form
                        class="search-tool-form"
                        href="{{ route("matches.index", $league->league_id) }}"
                        method="GET"
                    >
                        @csrf
                        @method("GET")
                        <div class="tool-group">
                            @if (isset($week_dates))
                                <div class="week-selector">
                                    <label for="starting_week_date">
                                        Starting Week:
                                    </label>
                                    @php    
                                        echo html()->select("startweek", $week_dates, $week_start);
                                    @endphp
                                </div>
                                <div class="week-selector">
                                    <label for="end_week_date">Ending Week:</label>
                                    @php
                                        echo html()->select("endweek", $week_dates, $week_end);
                                    @endphp
                                </div>
                                <div class="week-selector">
                                    <label for="teamID">Team</label>
                                    @php
                                        $defaultValue = "0";
                                        echo html()->select("teamID", $teams_list, $defaultValue);
                                    @endphp
                                </div>
                            @endif
                        </div>

                        <div class="btn-container-tool">
                            <button type="submit" class="btn-create">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cards-container">
        <div class="calendar-container">
            <div class="card section-header">Calendar</div>
            <div class="matches-calendar-container">
                @php
                    $isNewWeek = true;
                    $lastWeekNumber = 0;
                @endphp

                <!-- MATCHES TABLE BY WEEK -->
                @if (isset($matches) and count($matches) > 0)
                    <div class="matches-calendar">
                        <div class="calendar-header-row calendar-row">
                            <div class="match-number">Nº</div>
                            <div class="match-date">Date</div>
                            <div class="match-teams">Teams</div>
                            <div class="match-points">Points</div>
                            <div class="match-actions"></div>
                        </div>

                        @foreach ($matches as $match)
                            @if ($lastWeekNumber != $match->week_number)
                                @php
                                    $lastWeekNumber = $match->week_number;
                                @endphp

                                <div class="match-table-row-week calendar-row">
                                    Week {{ $match->week_number }}
                                </div>
                            @endif

                            <div class="calendar-row calendar-row-data">
                                <div class="match-number">
                                    {{ $match->match_number ?? "" }}
                                </div>
                                <div class="match-date">
                                    {{ $match->only_date ?? "" }}
                                    <br />
                                    {{ $match->only_time ?? "" }}
                                </div>
                                <div class="match-teams">
                                    <div class="host-team">
                                        <div class="img-team-container">
                                            <img
                                                class="team-img-matches"
                                                {{-- src="{{ asset("storage/" . $match->host_img) }}"--}}
                                                src="{{ asset( ! empty($match->host_img) ? "storage/" . $match->host_img : Vite::asset("resources/img/team.png")) }}"
                                                alt="Host Team Image"
                                            />
                                        </div>
                                        <div class="team-name-calendar">
                                            {{ $match->host_name ?? "" }}
                                        </div>
                                    </div>
                                    <div class="guest-team">
                                        <div class="img-team-container">
                                            <img
                                                class="team-img-matches"
                                                src="{{ asset( ! empty($match->guest_img) ? "storage/" . $match->guest_img : Vite::asset("resources/img/team.png")) }}"
                                                alt=">Guest Team Image"
                                            />
                                        </div>
                                        <div class="team-name-calendar">
                                            {{ $match->guest_name ?? "" }}
                                        </div>
                                    </div>
                                </div>
                                <div class="match-points">
                                    <div class="host-team">
                                        {{ $match->host_points ?? "0" }}
                                    </div>
                                    <div class="guest-team">
                                        {{ $match->guest_points ?? "0" }}
                                    </div>
                                </div>
                                <div class="match-actions">
                                    <div class="host-team">
                                        <a
                                            class="info-team-link"
                                            href="{{ route("matches.show", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                                        >
                                            <i class="infoIcon">
                                                <span
                                                    class="icon icon-league-link icon-info"
                                                ></span>
                                            </i>
                                        </a>
                                    </div>
                                    <div class="host-team">
                                        <a 
                                            class="modify-team-link"
                                            href="{{ route("matches.edit", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                                        >
                                            <i class="infoIcon">
                                                <span
                                                    class="icon icon-league-link icon-pencil"
                                                ></span>
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="match-table-row-address calendar-row">
                                <div colspan="11">
                                    {{ $match->address_street ?? "" }}
                                    {{ $match->address_number ?? "" }}
                                    <br />
                                    {{ $match->address_floor ? $match->address_floor . " Floor" : "" }}
                                    {{ $match->address_door ? $match->address_door . " Door" : "" }}
                                    <br />
                                    {{ $match->address_city ?? "" }}
                                    {{ $match->address_postalcode ?? "" }}
                                    <br />
                                    {{ $match->address_country ?? "" }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>


            @if (count($matches) == 0 && count($teams) < 2)
                <!-- No Enough Teams To create a match: -->
                <div class="creator-normal-card">
                    <h2>
                        There are not enough teams to create a propper match.
                        <br />
                        Please create a minimum of 2 teams.
                    </h2>
                    <a
                        class="btn-create"
                        href="{{ route("teams.create", ["league" => $league->league_id]) }}"
                    >
                        Create Team
                    </a>
                </div>
            @elseif (count($matches) == 0)
                <!-- Empty State League Creation: -->
                <div class="creator-normal-card">
                    <h2>
                        There are not matches to show.
                        <br />
                        Try creating a new Match.
                    </h2>
                    <a
                        class="btn-create"
                        href="{{ route("matches.create", ["league" => $league->league_id]) }}"
                    >
                        Create Match
                    </a>
                </div>
            @else
                <!-- Normal Creation Div -->

                <div class="creator-normal-card">
                    <a
                        class="btn-create"
                        href="{{ route("matches.create", ["league" => $league->league_id]) }}"
                    >
                        Create Match
                    </a>
                </div>
            @endif
        </div>

        @php
            $leagueId = $league->league_id;
            $weekStart = $week_start;
            $weekEnd = $week_end;
        @endphp

        @if (isset($league_type) and $league_type == "Beach Volleyball")
            <x-results.beachVolleyballResults :matches=$matches />
            <x-rankings.beachVolleyballRanking :leagueId="$leagueId" />
            <x-legends.beachVolleyballLegend />
        {{-- FOR OTHER LEAGUES TYPES --}}
        @else
            <x-results.commonResults :matches=$matches />
            <x-rankings.commonRanking :leagueId="$leagueId" />
        @endif
    </div>
@endsection
