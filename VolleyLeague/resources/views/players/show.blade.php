@extends("layouts.app")

@section("content")
    <div class="cards-container">
    @if($player)
    <div class="league-container-show card">
        
        <div class="player-info">
            <div class="player-img-container">
                <img
                    class="player-img"
                    src="{{ asset( $player?->player_img_name ? 'storage/' . $player->player_img_name : 'img/player.png') }}"
                    alt="Player Photo"
                />
            </div>
            <div class="player-data player-name-container">
                <div class="player-name">
                    {{ $player->name ?? "" }},
                    {{ $player->surname_1 ?? "" }}
                    {{ $player->surname_2 ?? "" }}
                </div>
            </div>
            <div class="player-data player-team-container">
                <div class="player-team">
                    {{ $team->team_name ?? "" }}
                </div>
            </div>
            <div class="player-data player-league-container">
                <div class="player-league">
                    {{ $league->league_name ?? "" }}
                </div>
            </div>
            <div class="player-data player-number-container">
                <div class="player-number">
                    {{ $player->player_number ?? "" }}
                </div>
            </div>
            <div class="player-data player-sex-container">
                <div class="player-sex">
                    {{ $player->sex ?? "" }}
                </div>
            </div>
            <div class="player-data player-birth-container">
                <div class="player-birth">
                    {{ $player->birth_date ?? "" }}
                    ({{ $player->age ?? "" }}) [{{ $player->country ?? "" }}]
                </div>
            </div>
            <div class="player-data player-mesuraments-container">
                <div class="player-mesuraments">
                    <h2>{{ $player->height }} m</h2>
                    <h2>{{ $player->weight }} kg</h2>
                </div>
            </div>
            <div class="player-data">
                <h2>{{ $player->email ?? "" }}</h2>
            </div>
            <div class="player-data">
                <h2>{{ $player->phone ?? "" }}</h2>
            </div>
        </div>
        
        @auth
            <div class="league-actions">
                <form
                    class="league-link-action"
                    action="{{ route("players.edit", ["league" => $league->league_id, "team" => $team->team_id, "player" => $player->player_id]) }}"
                    method="post"
                >
                    @csrf
                    @method("GET")
                    <button type="submit" class="btn-edit">Edit</button>
                </form>

                <form
                    class="league-link-action"
                    action="{{ route("players.destroy", ["league" => $league->league_id, "team" => $team->team_id, "player" => $player->player_id]) }}"
                    method="post"
                >
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </div>  
        @endauth
        
    </div>
    @endif
    </div>
@endsection
