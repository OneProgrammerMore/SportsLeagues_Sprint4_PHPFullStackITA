<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CupApp</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/iconStyles.css') }}">
</head>

<body>

    @php
        $leagueId = $league->league_id;
    @endphp
    <x-web.header :leagueId="$leagueId" />

    <main>
        <div class="player-container">

            <div class="player-info">
                <div class="player-photo">
                    <img class="player-img"
                        src="{{ asset($player->player_img_name ? 'storage/public/' . $player->player_img_name : 'img/player.png') }}"
                        alt="Player Photo">
                </div>
                <div class="player-data-all-container">

                    <div class="player-team-info">
                        {{ $player->player_number ?? '' }} - {{ $team->team_name ?? '' }} -
                        {{ $league->league_name ?? '' }}
                    </div>

                    <div class="player-name">
                        {{ $player->name ?? '' }}, {{ $player->surname_1 ?? '' }} {{ $player->surname_2 ?? '' }}
                    </div>
                    <div class="player-origin-data">
                        {{ $player->sex ?? '' }} - {{ $player->birth_date ?? '' }} ({{ $player->age ?? '' }}) -
                        {{ $player->country ?? '' }}
                    </div>

                    <div class="player-data-container">
                        <div class="player-data">
                            <h3>Height:</h3>
                            <h2>{{ $player->height ?? '' }} m</h2>
                        </div>
                    </div>

                    <div class="player-data-container">
                        <div class="player-data">
                            <h3>Weight:</h3>
                            <h2>{{ $player->weight ?? '' }} bananas</h2>
                        </div>
                    </div>

                    <div class="player-data-container">
                        <div class="player-data">
                            <h3>E-Mail: </h3>
                            <h2>{{ $player->email ?? '' }} </h2>
                        </div>
                        <div class="player-data">
                            <h3>Phone: </h3>
                            <h2>{{ $player->phone ?? '' }}</h2>
                        </div>
                    </div>

                </div>

            </div>
            <div class="league-actions-show">

                <div class="player-action">
                    <form class="league-info-link league-link"
                        action="{{ route('players.edit', ['league' => $league->league_id, 'team' => $team->team_id, 'player' => $player->player_id]) }}"
                        method="post">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn-edit">
                            <span class="icon icon-league-link icon-pencil"></span>
                            Edit</button>
                    </form>
                </div>

                <div class="player-action">

                    <form class="league-info-link league-link"
                        action="{{ route('players.destroy', ['league' => $league->league_id, 'team' => $team->team_id, 'player' => $player->player_id]) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <span class="icon icon-league-link icon-trash"></span>
                            Delete</button>
                    </form>

                </div>
            </div>

        </div>
        </div>

    </main>

    <x-footer />

</body>

</html>
