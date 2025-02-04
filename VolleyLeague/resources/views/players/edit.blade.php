<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>CupApp</title>
        <link rel="icon" href="{{ asset("img/cupLogo.png") }}">
        @vite("resources/css/app.css")
        <link rel="stylesheet" href="{{ asset("css/iconStyles.css") }}" />
    </head>

    <body>
        @php
            $leagueId = $league->league_id;
        @endphp

        <x-web.header :leagueId="$leagueId" />

        <main>
            <div class="edit-league-container">
                <div class="edit-league-inner-container">
                    <h3>Edit an existing player</h3>
                    <form
                        class="create-player-form"
                        action="{{ route("players.update", ["league" => $league->league_id, "team" => $team->team_id, "player" => $player->player_id]) }}"
                        method="post"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method("POST")
                        <!--TEAM NUMBER -->
                        <div class="form-group section-form-group">
                            <h3>Team Information</h3>
                            <div class="form-group">
                                <label for="league_id">League ID:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="league_id"
                                    rows="1"
                                    value="{{ $league->league_id }}"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="league_name">League Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="league_name"
                                    rows="1"
                                    value="{{ $league->league_name }}"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="team_id">Team ID:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="team_id"
                                    name="team_id"
                                    rows="1"
                                    value="{{ $team->team_id }}"
                                    required
                                    readonly
                                />
                            </div>

                            <div class="form-group">
                                <label for="team_name">Team Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="team_name"
                                    name="team_number"
                                    rows="1"
                                    value="{{ $team->team_name }}"
                                    required
                                    readonly
                                />
                            </div>
                            <!--PLAYER NAME -->
                            <div class="form-group">
                                <label for="player_name">Player Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="player_name"
                                    rows="1"
                                    value="{{ $player->name ?? "" }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="player_surname_1">
                                    Player 1st Surname:
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="player_surname_1"
                                    rows="1"
                                    value="{{ $player->surname_1 ?? "" }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="player_surname_2">
                                    Player 2nd Surname:
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="player_surname_2"
                                    rows="1"
                                    value="{{ $player->surname_2 ?? "" }}"
                                />
                            </div>

                            <div class="form-group">
                                <label for="host_team_id">Player Sex:</label>
                                @php
                                    echo html()->select("player_sex", $sexs_list, $player->sex ?? "");
                                @endphp
                            </div>

                            <div class="form-group">
                                <label for="player_number">
                                    Player Number:
                                </label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="player_number"
                                    rows="1"
                                    value="{{ $player->player_number ?? "" }}"
                                />
                            </div>

                            <div class="form-group">
                                <label for="player_birth_date">
                                    Player Birth Date:
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    name="player_birth_date"
                                    value="{{ $player->birth_date ?? "" }}"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="player_country">
                                    Player Origin Country:
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="player_country"
                                    rows="1"
                                    value="{{ $player->country ?? "" }}"
                                />
                            </div>

                            <div class="form-group">
                                <label for="player_height">
                                    Player Height:
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                    name="player_height"
                                    rows="1"
                                    value="{{ $player->height ?? "" }}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="player_weight">
                                    Player Weight:
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                    name="player_weight"
                                    rows="1"
                                    value="{{ $player->weight ?? "" }}"
                                />
                            </div>

                            <!--Player IMAGE -->
                            <div class="form-group">
                                <label for="player_img">Player Image:</label>
                                <input
                                    class="form-control"
                                    type="file"
                                    id="team_img"
                                    name="player_img"
                                    accept="image/png, image/jpeg, image/svg"
                                />
                            </div>

                            <!--Player PHONE -->
                            <div class="form-group">
                                <label for="player_phone">Player Phone:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="player_phone"
                                    rows="1"
                                    value="{{ $player->phone ?? "" }}"
                                />
                            </div>

                            <!--Player EMAIL -->
                            <div class="form-group">
                                <label for="player_email">Player E-Mail:</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="player_email"
                                    rows="1"
                                    value="{{ $player->email ?? "" }}"
                                    required
                                />
                            </div>
                        </div>

                        <div class="actions-row">
                            <div class="btn-container">
                                <button type="submit" class="btn-create">
                                    <span
                                        class="icon icon-league-link icon-pencil"
                                    ></span>
                                    Edit
                                </button>
                            </div>

                            <a
                                href="{{ route("players.index", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                                class="btn-cancel"
                            >
                                <span
                                    class="icon icon-league-link icon-cancel"
                                ></span>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <x-footer />
    </body>
</html>
