@extends("layouts.app")

@section("content")
    <div class="league-form-container">
        <div class="league-form-inner-container">
            <h3 class="league-form-title">Modify a team</h3>
            <form
                class="league-form"
                action="{{ route("teams.update", ["league" => $league->league_id, "team" => $team->team_id]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method("PUT")
                <!--TEAM NUMBER -->
                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">Team Information</h3>
                    <div class="form-group-hidden">
                        <label for="league_id">League ID:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="league_id"
                            name="league_id"
                            rows="1"
                            value="{{ $league->league_id }}"
                            required
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
                        />
                    </div>
                    <div class="form-group-hidden">
                        <label for="team_number">Team Number:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_number"
                            name="team_number"
                            rows="1"
                            value="{{ $team->team_number }}"
                            required
                        />
                    </div>
                    <!--TEAM NAME -->
                    <div class="form-group">
                        <label for="team_name">Name:</label>
                        <textarea
                            class="form-control"
                            id="team_name"
                            name="team_name"
                            rows="1"
                            required
                        >{{ $team->team_name }}</textarea
                        >
                    </div>
                    <!--TEAM IMAGE -->
                    <div class="form-group">
                        <label for="team_img">Image:</label>
                        <input
                            class="form-control"
                            type="file"
                            id="team_img"
                            name="team_img"
                            accept="image/png, image/jpeg, image/svg"
                        />
                    </div>

                    <!--TEAM PHONE -->
                    <div class="form-group">
                        <label for="team_phone">Phone:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_phone"
                            name="team_phone"
                            rows="1"
                            value="{{ $team->team_phone }}"
                            required
                        />
                    </div>

                    <!--TEAM EMAIL -->
                    <div class="form-group">
                        <label for="team_email">E-Mail:</label>
                        <input
                            type="email"
                            class="form-control"
                            id="team_email"
                            name="team_email"
                            rows="1"
                            value="{{ $team->team_email }}"
                            required
                        />
                    </div>
                </div>

                <!--TEAM ADDRESS -->
                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">Team Address</h3>

                    <div class="form-group">
                        <label for="team_address_country">Country:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_country"
                            name="team_address_country"
                            rows="1"
                            value="{{ $team_address->country }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_postalcode">
                            Postal Code:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_postalcode"
                            name="team_address_postalcode"
                            rows="1"
                            value="{{ $team_address->postalcode }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_city">City:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_city"
                            name="team_address_city"
                            rows="1"
                            value="{{ $team_address->city }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_street">Street:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_street"
                            name="team_address_street"
                            rows="1"
                            value="{{ $team_address->street }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_number">Stret Number:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_number"
                            name="team_address_number"
                            rows="1"
                            value="{{ $team_address->number }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_floor">Building Floor:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_floor"
                            name="team_address_floor"
                            rows="1"
                            value="{{ $team_address->floor }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_address_door">Building Door:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_address_door"
                            name="team_address_door"
                            rows="1"
                            value="{{ $team_address->door }}"
                        />
                    </div>
                </div>

                <!--TEAM RESPONSIBLE -->
                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">Team Responsible</h3>
                    <div class="form-group">
                        <label for="team_responsible_name">
                            Name:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_name"
                            name="team_responsible_name"
                            rows="1"
                            value="{{ $team_responsible->person_name }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_surname_1">
                            1st Surname:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_surname_1"
                            name="team_responsible_surname_1"
                            rows="1"
                            value="{{ $team_responsible->person_surname_1 }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_surname_2">
                            2nd Surname:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_surname_2"
                            name="team_responsible_surname_2"
                            rows="1"
                            value="{{ $team_responsible->person_surname_2 }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_email">
                            E-Mail:
                        </label>
                        <input
                            type="email"
                            class="form-control"
                            id="team_responsible_email"
                            name="team_responsible_email"
                            rows="1"
                            value="{{ $team_responsible->person_email }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_phone">
                            Phone:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_phone"
                            name="team_responsible_phone"
                            rows="1"
                            value="{{ $team_responsible->person_phone }}"
                        />
                    </div>
                </div>

                <!--TEAM RESPONSIBLE ADDRESS-->
                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">
                        Team Responsible Address:
                    </h3>

                    <div class="form-group">
                        <label for="team_responsible_address_country">
                            Country:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_country"
                            name="team_responsible_address_country"
                            rows="1"
                            value="{{ $team_responsible_address->country ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_postalcode">
                           Postal Code:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_postalcode"
                            name="team_responsible_address_postalcode"
                            rows="1"
                            value="{{ $team_responsible_address->postalcode ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_city">
                            City:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_city"
                            name="team_responsible_address_city"
                            rows="1"
                            value="{{ $team_responsible_address->city ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_street">
                            Street:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_street"
                            name="team_responsible_address_street"
                            rows="1"
                            value="{{ $team_responsible_address->street ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_number">
                            Number:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_number"
                            name="team_responsible_address_number"
                            rows="1"
                            value="{{ $team_responsible_address->number ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_floor">
                            Floor:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_floor"
                            name="team_responsible_address_floor"
                            rows="1"
                            value="{{ $team_responsible_address->floor ?? "" }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="team_responsible_address_door">
                           Door:
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="team_responsible_address_door"
                            name="team_responsible_address_door"
                            rows="1"
                            value="{{ $team_responsible_address->door ?? "" }}"
                        />
                    </div>
                </div>

                <div class="actions-row">
                    <div class="btn-container">
                        <button type="submit" class="btn-create">Modify</button>
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
