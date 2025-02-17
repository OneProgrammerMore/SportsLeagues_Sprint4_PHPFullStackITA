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
                <span class="icon icon-league-link icon-search"></span>
            </button>
        </div>

        <div id="search-tool-hidden-form">
            <div class="search-tool">
                <div id="search-week">
                    <form
                        class="search-tool-form"
                        action="{{ route("matches.search", $league->league_id) }}"
                        method="post"
                    >
                        @csrf
                        @method("POST")
                        <div class="tool-group">
                            @if (isset($week_dates))
                                <div class="week-selector">
                                    <label for="starting_week_date">
                                        Starting Week:
                                    </label>
                                    @php    
                                        echo html()->select("starting_week_date", $week_dates, $week_start);
                                    @endphp
                                </div>
                                <div class="week-selector">
                                    <label for="end_week_date">Ending Week:</label>
                                    @php
                                        echo html()->select("end_week_date", $week_dates, $week_end);
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
        <div class="calender-container">
            <div class="card section-header">Calender</div>
            <div class="matches-calender-container">
                @php
                    $isNewWeek = true;
                    $lastWeekNumber = 0;
                @endphp

                <!-- MATCHES TABLE BY WEEK -->
                @if (isset($matches) and count($matches) > 0)
                    <div class="matches-calender">
                        <div class="calender-header-row calender-row">
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

                                <div class="match-table-row-week calender-row">
                                    Week {{ $match->week_number }}
                                </div>
                            @endif

                            <div class="calender-row calender-row">
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
                                                src="{{ asset("storage/public/" . $match->host_img) }}"
                                                alt="Host Team Image"
                                            />
                                        </div>
                                        <div class="team-name-calender">
                                            {{ $match->host_name ?? "" }}
                                        </div>
                                    </div>
                                    <div class="guest-team">
                                        <div class="img-team-container">
                                            <img
                                                class="team-img-matches"
                                                src="{{ asset("storage/public/" . $match->guest_img) }}"
                                                alt=">Guest Team Image"
                                            />
                                        </div>
                                        <div class="team-name-calender">
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

                            <div class="match-table-row-address calender-row">
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

            @if (count($matches) == 0)
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
        @endphp

        @if (isset($league_type) and $league_type == "Beach Volleyball")
            <x-results.beachVolleyballResults :leagueId="$leagueId" />
            <x-rankings.beachVolleyballRanking :leagueId="$leagueId" />
            <x-legends.beachVolleyballLegend />
        @elseif ($league_type == "Basketball 3vs3 Simple")
        @endif
    </div>
@endsection
