<div id="leagues-container" class="cards-container">
    @foreach ($leagues as $league)
        <div class="league-container">
            <div class="league-info">
                <div class="league-info-link">
                    <a
                        class="link-info"
                        href="{{ route("leagues.show", $league->league_id) }}"
                    >
                        <span class="icon icon-league-link icon-info"></span>
                    </a>
                </div>

                <div class="league-img-container">
                    <img
                        class="league-imgs-index"
                        src="{{ asset($league->league_img_name ? "storage/" . $league->league_img_name : Vite::asset("resources/img/league.png")) }}"
                        alt="Web Logo - The image of a Tournament Cup"
                    />
                </div>
                <div class="league-data">
                    <div class="league-main-data">
                        <h3 class="league-status">
                            @if( $league->league_status == null  )
                                <span class="league-status-circle league-status-unknown"></span>
                                {{ $league->league_status ?? "" }}
                            @elseif($league->league_status == "Waiting")
                                <span class="league-status-circle league-status-waiting"></span>
                                {{ $league->league_status ?? "" }}
                            @elseif($league->league_status == "Ongoing")
                                <span class="league-status-circle league-status-ongoing"></span>
                                {{ $league->league_status ?? "" }}
                            @elseif($league->league_status == "Finished")
                                <span class="league-status-circle league-status-finished"></span>
                                {{ $league->league_status ?? "" }}
                            @elseif($league->league_status == "Canceled")
                                <span class="league-status-circle league-status-canceled"></span>
                                {{ $league->league_status ?? "" }}
                            @endif
                        </h3>
                        <h3 class="league-name">
                            {{ $league->league_name ?? "" }}
                        </h3>
                        <h3 class="league-type">
                            {{ $league->league_type ?? "" }}
                        </h3>
                    </div>
                    <div class="league-dates">
                        <div class="league-date">
                            <div class="date-description">Starting on:</div>
                            <div class="date">
                                <h3 class="date-day">
                                    {{ $league->league_starting_date ? date("Y-m-d", strtotime($league->league_starting_date)) : "" }}
                                </h3>
                                <h3 class="date-time">
                                    {{ $league->league_starting_date ? date("H:i", strtotime($league->league_starting_date)) : "" }}
                                </h3>
                            </div>
                        </div>
                        <div class="league-date">
                            <div class="date-description">Finishig on:</div>
                            <div class="date">
                                <h3 class="date-day">
                                    {{ $league->league_finalization_date ? date("Y-m-d", strtotime($league->league_finalization_date)) : "" }}
                                </h3>
                                <h3 class="date-time">
                                    {{ $league->league_finalization_date ? date("H:i", strtotime($league->league_finalization_date)) : "" }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <h3 class="league-admin"></h3>
                </div>
            </div>

            <div class="league-interactions-all">
                <div class="league-links">
                    <div
                        class="league-matches-link league-link link-matches"
                    >
                        <a
                            class="link-info"
                            href="{{ route("matches.index", $league->league_id) }}"
                        >
                            Matches
                        </a>
                    </div>

                    <div class="league-teams-link league-link link-teams">
                        <a
                            class="link-info"
                            href="{{ route("teams.index", $league->league_id) }}"
                        >
                            Teams
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    @if ($hasMorePages)
        <div>
            <div
                x-data
                x-intersect="$wire.loadLeagues()"
            >   
                @foreach (range(1, 1) as $x)
                    @include("partials.skeleton")
                @endforeach
            </div>  
        </div>  
    @endif
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="//unpkg.com/alpinejs" defer></script> --}}
</div>
