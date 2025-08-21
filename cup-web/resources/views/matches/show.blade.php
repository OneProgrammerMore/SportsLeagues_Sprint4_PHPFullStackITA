@extends("layouts.app")

@section("content")
    <div class="cards-container">
    <div class="card">
        <div class="match-show-container">
            <div class="match-team-container">
                <div class="container-team-logo">
                    <img
                        class="team-img-match"
                        src="{{ asset("storage/" . $host_team->team_img_name) }}"
                        alt="Host Team Image"
                    />
                </div>
                <div class="match-team-name">
                    {{ $host_team->team_name }}
                </div>
                <div class="match-score">
                    {{ $match->host_points ?? "0" }}
                </div>
            </div>

            <div class="match-middle-container">
                <div class="vs-container">VS</div>
                <div class="container-match-status">
                    <h3>
                        {{ $match->match_status ?? "Status Unknown" }}
                    </h3>
                </div>
                <div class="container-match-date">
                    {{ $match->only_date }}
                    <br />
                    {{ $match->only_time }}
                </div>
            </div>

            <div class="match-team-container">
                <div class="container-team-logo">
                    <img
                        class="team-img-match"
                        src="{{ asset("storage/" . $guest_team->team_img_name) }}"
                        alt="Host Team Image"
                    />
                </div>
                <div class="match-team-name">
                    {{ $guest_team->team_name }}
                </div>
                <div class="match-score">
                    {{ $match->guest_points ?? "0" }}
                </div>
            </div>
        </div>
        
        
        <div class="match-show-container-center">
                
            <div class="container-match-date">
                    <div colspan="11">
                        {{ $match_address->street ?? "" }}
                        {{ $match_address->number ?? "" }}
                        <br />
                        {{$match_address->floor ? $match_address->floor . " Floor" : "" }}
                        {{ $match_address->door ? $match_address->door . " Door" : "" }}
                        <br />
                        {{ $match_address->city ?? "" }}
                        {{ $match_address->postalcode ?? "" }}
                        <br />
                        {{ $match_address->country ?? "" }}
                    </div>
            </div>
        </div>
        @auth
        <div class="league-actions">
            <form
                class="league-link-action"
                action="{{ route("matches.edit", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                method="post"
            >
                @csrf
                @method("GET")
                <button type="submit" class="btn-edit">Edit</button>
            </form>

            <form
                class="league-link-action"
                action="{{ route("matches.destroy", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                method="post"
            >
                @csrf
                @method("DELETE")
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>
        @endauth
    </div>
</div>

@endsection
