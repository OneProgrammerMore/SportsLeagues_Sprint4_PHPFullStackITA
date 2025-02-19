@extends("layouts.app")

@section("content")
    <div class="tool-bar-complete">
        <div class="tool-bar">
            <form>
                <div
                    id="moreInfoMatchesToggleSwitch"
                    class="toolbar-switch"
                >
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
                <span
                    class="icon icon-league-link icon-search"
                ></span>
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
                                <label for="starting_week_date">
                                    Starting Week:
                                </label>

                                @php
                                    echo html()->select("starting_week_date", $week_dates, $week_start);
                                @endphp

                                <label for="end_week_date">
                                    Ending Week:
                                </label>
                                @php
                                    echo html()->select("end_week_date", $week_dates, $week_end);
                                @endphp
                            @endif
                        </div>

                        <div class="btn-container-tool">
                            <button type="submit" class="btn-create">
                                <span
                                    class="icon icon-league-link icon-search"
                                ></span>
                                Search!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cards-container">
        <div class="card section-header">Matches Calender</div>
        <div class="matches-calender">
            @php
                $isNewWeek = true;
                $lastWeekNumber = 0;
            @endphp

            <!-- MATCHES TABLE BY WEEK -->
            @if (isset($matches) and count($matches) > 0)
                <table class="match-main-info-table" border="1">
                    <tr class="hidden">
                        <th>Match Number</th>
                        <th>Match Date and Time</th>
                        <th>Host Team Name</th>
                        <th>Host Team Logo</th>
                        <th>Host Team Points</th>
                        <th>Dash</th>
                        <th>Guest Team Points</th>
                        <th>Guest Team Logo</th>
                        <th>Guest Team Name</th>
                        <th>See Logo</th>
                    </tr>
                    @foreach ($matches as $match)
                        @if ($lastWeekNumber != $match->week_number)
                            @php
                                $lastWeekNumber = $match->week_number;
                            @endphp

                            <tr class="match-table-row-week">
                                <td colspan="11">
                                    Week {{ $match->week_number }}
                                </td>
                            </tr>
                        @endif

                        <tr class="match-table-row">
                            <td>{{ $match->match_number ?? "" }}</td>
                            <td>
                                {{ $match->only_date ?? "" }}
                                <br />
                                {{ $match->only_time ?? "" }}
                            </td>
                            <td>{{ $match->host_name ?? "" }}</td>
                            <td>
                                <img
                                    class="team-img-matches"
                                    src="{{ asset("storage/public/" . $match->host_img) }}"
                                    alt="Host Team Image"
                                />
                            </td>
                            <td>{{ $match->host_points ?? "0" }}</td>
                            <td>-</td>
                            <td>{{ $match->guest_points ?? "0" }}</td>
                            <td>
                                <img
                                    class="team-img-matches"
                                    src="{{ asset("storage/public/" . $match->guest_img) }}"
                                    alt=">Guest Team Image"
                                />
                            </td>
                            <td>{{ $match->guest_name ?? "" }}</td>
                            <td>
                                <a
                                    href="{{ route("matches.show", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                                >
                                    <i class="infoIcon">
                                        <span
                                            class="icon icon-league-link icon-info"
                                        ></span>
                                    </i>
                                </a>
                            </td>

                            <td>
                                <a
                                    href="{{ route("matches.edit", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                                >
                                    <i class="infoIcon">
                                        <span
                                            class="icon icon-league-link icon-pencil"
                                        ></span>
                                    </i>
                                </a>
                            </td>
                        </tr>

                        <tr class="match-table-row-address">
                            <td colspan="11">
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
                            </td>
                        </tr>
                    @endforeach
                </table>
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

        @php
            $leagueId = $league->league_id;
        @endphp

        @if (isset($league_type) and $league_type == "Beach Volleyball")
            <x-results.beachVolleyballResults :leagueId="$leagueId" />
            <x-rankings.beachVolleyballRanking :leagueId="$leagueId" />
            <div class="card">
                <x-legends.beachVolleyballLegend />
            </div>
        @elseif ($league_type == "Basketball 3vs3 Simple")
        @endif
    </div>
@endsection
