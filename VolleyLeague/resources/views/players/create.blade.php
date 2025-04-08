@extends("layouts.app")

@section("content")
    <div class="league-form-container">
        <div class="league-form-inner-container">
            <h3 class="league-form-title">Create a new player</h3>
            <form
                class="league-form"
                action="{{ route("players.store", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method("POST")
                <!--TEAM NUMBER -->
                <div class="section-form-group">
                    <div class="form-group-hidden">
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
                    <div class="form-group-hidden">
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
                        <label for="player_name">
                            Player Name:
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            name="player_name"
                            rows="1"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="player_surname_1">
                            Player 1st Surname:
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            name="player_surname_1"
                            rows="1"
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
                        />
                    </div>

                    <div class="form-group">
                        <label for="host_team_id">Player Sex:</label>
                        @php
                            echo html()->select("player_sex", $sexs_list, null);
                        @endphp
                    </div>

                    <div class="form-group">
                        <label for="player_number">Player Number:</label>
                        <input
                            type="number"
                            class="form-control"
                            name="player_number"
                            rows="1"
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
                        />
                    </div>

                    <div class="form-group">
                        <label for="player_height">Player Height:</label>
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            name="player_height"
                            rows="1"
                        />
                    </div>
                    <div class="form-group">
                        <label for="player_weight">Player Weight:</label>
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            name="player_weight"
                            rows="1"
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
                        />
                    </div>

                    <!--Player EMAIL -->
                    <div class="form-group">
                        <label for="player_email">
                            Player E-Mail:
                            <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            class="form-control"
                            name="player_email"
                            rows="1"
                            required
                        />
                    </div>
                </div>

                <div class="actions-row">
                    <div class="btn-container">
                        <button type="submit" class="btn-create">Create</button>
                    </div>

                    <a
                        href="{{ route("matches.index", ["league" => $league->league_id]) }}"
                        class="btn-cancel"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
