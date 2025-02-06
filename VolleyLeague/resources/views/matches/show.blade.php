@extends('layouts.app')

@section('content')

        <main>
            <div class="match-main-container">
                <div class="match-teams-names">
                    <div class="match-team-name">
                        {{ $host_team->team_name }}
                    </div>
                    <div class="match-team-name-vs">VS</div>
                    <div class="match-team-name">
                        {{ $guest_team->team_name }}
                    </div>
                </div>

                <div class="container-match-date">
                    {{ $match->only_date }}
                    <br />
                    {{ $match->only_time }}
                </div>

                <div class="container-match-info">
                    <div class="container-team-logo">
                        <img
                            class="team-img-match"
                            src="{{ asset("storage/public/" . $host_team->team_img_name) }}"
                            alt="Host Team Image"
                        />
                    </div>

                    <div class="container-match-results">
                        <div class="container-match-points">
                            <h3>
                                {{ $match->host_points ?? "0" }}
                            </h3>
                            <h3>:</h3>
                            <h3>
                                {{ $match->guest_points ?? "0" }}
                            </h3>
                        </div>

                        <div class="contaier-match-status">
                            <h3>
                                {{ $match->match_status ?? "Status Unknown" }}
                            </h3>
                        </div>
                    </div>

                    <div class="container-team-logo">
                        <img
                            class="team-img-match"
                            src="{{ asset("storage/public/" . $guest_team->team_img_name) }}"
                            alt="Host Team Image"
                        />
                    </div>
                </div>
                <div class="match-actions">
                    <form
                        class="league-info-link league-link"
                        action="{{ route("matches.edit", ["league" => $league->league_id, "match" => $match->match_id]) }}"
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
                        action="{{ route("matches.destroy", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                        method="post"
                    >
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete">
                            <span
                                class="icon icon-league-link icon-trash"
                            ></span>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </main>
@endsection