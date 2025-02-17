@extends("layouts.app")

@section("content")
    <!-- INFORMATION IN leagues/{league} -->
    <!-- League Info -->
    <!-- League Classification -->
    <!-- League Results -->
    <!-- League Next Matches -->
    <div class="league-container-show">
        <div class="league-info">
            <div class="league-img-container">
                <img
                    class="league-img"
                    src="{{ asset($league->league_img_name ? "storage/public/" . $league->league_img_name : Vite::asset("resources/img/league.png")) }}"
                    alt="Web Logo - The image of a Tournament Cup"
                />
            </div>
            <div class="league-data">
                <div class="league-main-data">
                    <h3 class="league-status">
                        <span class="league-status-circle"></span>
                        {{ $league->league_status ?? "" }}
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
            </div>
        </div>

        <div class="league-interactions-all">
            <div class="league-links">
                <div class="league-matches-link league-link link-matches">
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
        <div class="league-info-group">
            <div class="league-show-group">
                <h3 class="league-header">Description</h3>
                <h3 class="league-data-field">
                    {{ $league->league_description }}
                </h3>
            </div>

            <div class="league-show-group">
                <h3 class="league-header">Official website</h3>
                <h3 class="league-data-field">
                    <a href="{{ $league->league_official_web }}">
                        {{ $league->league_official_web }}
                    </a>
                </h3>
            </div>

            <div class="league-show-group">
                <h3 class="league-header">Channel</h3>
                <h3 class="league-data-field">
                    <a href="{{ $league->league_channel }}">
                        {{ $league->league_channel }}
                    </a>
                </h3>
            </div>
        </div>

        <div class="league-actions">
            <form
                class="league-link-action"
                action="{{ route("leagues.edit", $league->league_id) }}"
                method="post"
            >
                @csrf
                @method("GET")
                <button type="submit" class="btn-edit">Edit</button>
            </form>

            <form
                class="league-link-action"
                action="{{ route("leagues.destroy", $league->league_id) }}"
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
@endsection
