<div class="results-table-section">
    <!-- Results Table For Beach Volley -->

    <div class="results-table-title card section-header">Results</div>

    <!-- MATCHES TABLE BY WEEK -->
    <div class="matches-results-container card">
        @if (isset($match_results))
            <div class="results-table">
                <div class="results-header-row results-row">
                    <div class="match-number">Nº</div>
                    <div class="match-teams">Team</div>
                    <div class="match-date responsive-hidden">Date</div>
                    <div class="matches-won">M. W.</div>
                    <div class="sets-won">S. W.</div>
                    <div class="point-won">P. W.</div>
                    <div class="results-actions"></div>
                </div>
                @foreach ($match_results as $result)
                    <div class="results-row">
                        <div class="match-number">
                            {{ $result->match_number ?? "" }}
                        </div>
                        <div class="match-teams">
                            <div class="host-team">
                                <img
                                    class="results-team-img"
                                    src="{{ asset("storage/public/" . $result->host_img) }}"
                                    alt="Host Team Image"
                                />
                                <div class="team-name-results">
                                    {{ $result->host_team_name ?? "" }}
                                </div>
                            </div>
                            <div class="guest-team">
                                <img
                                    class="results-team-img"
                                    src="{{ asset("storage/public/" . $result->guest_img) }}"
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
                        <div class="matches-won">
                            <div class="host-team">
                                {{ $result->matches_won ?? "" }}
                            </div>
                            <div class="guest-team">
                                {{ $result->matches_lost ?? "" }}
                            </div>
                        </div>
                        <div class="sets-won">
                            <div class="host-team">
                                {{ $result->sets_won ?? "" }}
                            </div>
                            <div class="guest-team">
                                {{ $result->sets_lost ?? "" }}
                            </div>
                        </div>
                        <div class="point-won">
                            <div class="host-team">
                                {{ $result->points_won ?? "" }}
                            </div>
                            <div class="guest-team">
                                {{ $result->points_lost ?? "" }}
                            </div>
                        </div>
                        <div class="results-actions">
                            <div>
                                <a
                                    href="{{ route("matches.show", ["league" => $result->league_id, "match" => $result->match_id]) }}"
                                >
                                    <i class="results-team-img-container">
                                        <span
                                            class="icon icon-league-link icon-info"
                                        ></span>
                                    </i>
                                </a>
                            </div>

                            <div>
                                <a
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
        @endif
    </div>
</div>
