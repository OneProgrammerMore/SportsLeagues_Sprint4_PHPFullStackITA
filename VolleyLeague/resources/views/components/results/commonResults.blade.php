<div class="results-table-section">
    <!-- Results Table For Beach Volley -->

    <div class="results-table-title card section-header">Results</div>
    
    @if (isset($match_results) && count($match_results) > 0)
    <!-- MATCHES TABLE BY WEEK -->
    <div class="matches-results-container">
       
            <div class="results-table">
                <div class="results-header-row results-row">
                    <div class="match-number">Nº</div>
                    <div class="match-teams">Team</div>
                    <div class="match-date responsive-hidden">Date</div>
                    <div class="host-points">Host Points</div>
                    <div class="guest-points">Guest Points</div>
                    <div class="results-actions"></div>
                </div>

                @php
                    $isNewWeek = true;
                    $lastWeekNumber = 0;
                @endphp

                @foreach ($match_results as $result)

                    @if ($lastWeekNumber != $result->week_number)
                        @php
                            $lastWeekNumber = $result->week_number;
                        @endphp

                        <div class="match-table-row-week calendar-row">
                            Week {{ $result->week_number }}
                        </div>
                    @endif


                    <div class="results-row calendar-row-data">
                        <div class="match-number">
                            {{ $result->match_number ?? "" }}
                        </div>
                        <div class="match-teams">
                            <div class="host-team">
                                <img
                                    class="results-team-img"
                                    src="{{ asset( ! empty($result->host_img) ? "storage/" . $result->host_img : Vite::asset("resources/img/team.png")) }}"
                                    alt="Host Team Image"
                                />
                                <div class="team-name-results">
                                    {{ $result->host_team_name ?? "" }}
                                </div>
                            </div>
                            <div class="guest-team">
                                <img
                                    class="results-team-img"
                                    src="{{ asset( ! empty($result->guest_img) ? "storage/" . $result->guest_img : Vite::asset("resources/img/team.png")) }}"
                                    alt="Guest Team Image"
                                />
                                <div class="team-name-results">
                                    {{ $result->guest_team_name ?? "" }}
                                </div>
                            </div>
                        </div>
                        <div class="match-date responsive-hidden">
                            {{ $result->only_date ?? "" }}
                            <br />
                            {{ $result->only_time ?? "" }}
                        </div>
                        <div class="host-points">
                            {{ $result->host_points ?? "" }}
                        </div>
                        <div class="guest-points">
                            {{ $result->guest_points ?? "" }}
                        </div>
                        <div class="results-actions">
                            <div class="host-team">
                                <a
                                    class="info-team-link"
                                    href="{{ route("matches.show", ["league" => $result->league_id, "match" => $result->match_id]) }}"
                                >
                                    <i class="results-team-img-container">
                                        <span
                                            class="icon icon-league-link icon-info"
                                        ></span>
                                    </i>
                                </a>
                            </div>

                            <div class="host-team">
                                <a
                                    class="modify-team-link"
                                    href="{{ route("matches.edit", ["league" => $result->league_id, "match" => $result->match_id]) }}"
                                >
                                    <i class="results-team-img-container">
                                        <span
                                            class="icon icon-league-link icon-pencil"
                                        ></span>
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    @else
    <div class="creator-normal-card">
        No results to show... try creating some matches.
    </div>
    @endif
</div>
