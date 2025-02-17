@extends("layouts.app")

@section("content")
    <div class="league-form-container">
        <div class="league-form-inner-container">
            <h3 class="league-form-title">Modify Match</h3>
            <form
                class="league-form"
                action="{{ route("matches.update", ["league" => $league->league_id, "match" => $match->match_id]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method("PUT")

                <div class="form-group-main section-form-group">
                    <h3 class="league-form-subtitle">Team Information</h3>

                    <div class="form-group-hidden">
                        <label for="league_id">League ID</label>
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
                        <label for="match_id">Match ID</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_id"
                            name="match_id"
                            rows="1"
                            value="{{ $match->match_id }}"
                            required
                        />
                    </div>
                </div>

                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">Match Information</h3>

                    <div class="match-number-container">
                        <label for="match_number">Match Number</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_number"
                            name="match_number"
                            rows="1"
                            value="{{ $match->match_number }}"
                            readonly
                            required
                        />
                    </div>

                    <div class="match-number-container">
                        <label for="week_number">Week number</label>
                        <input
                            type="number"
                            class="form-control"
                            id="week_number"
                            name="week_number"
                            value="{{ $match->week_number }}"
                            required
                        />
                    </div>

                    <div class="match-teams-names">
                        <div class="match-team-name">
                            <label for="host_team_id">Host Team</label>

                            @php
                                echo html()->select("host_team_id", $teams_list, $select_host_value);
                            @endphp
                        </div>
                        <div class="match-team-name">
                            <label for="guest_team_id">Guest Team</label>

                            @php
                                echo html()->select("guest_team_id", $teams_list, $select_guest_value);
                            @endphp
                        </div>
                    </div>

                    <div class="container-match-date">
                        <label class="match_date" for="match_date">
                            Match Date
                        </label>
                        <input
                            type="datetime-local"
                            class="form-control"
                            id="match_date"
                            name="match_date"
                            value="{{ $match->match_date }}"
                            required
                        />
                    </div>

                    <div class="container-match-info">
                        <div class="container-match-results">
                            <div class="container-match-points">
                                <div class="container-team-points">
                                    <label for="host_points">Host Points</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="host_points"
                                        name="host_points"
                                        value="{{ $match->host_points }}"
                                    />
                                </div>
                                <div class="container-team-points">
                                    <label for="guest_points">
                                        Guest Points
                                    </label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="guest_points"
                                        name="guest_points"
                                        value="{{ $match->guest_points }}"
                                    />
                                </div>
                            </div>

                            <div class="contaier-match-status">
                                <h3>
                                    <label for="match_status">
                                        Match Status
                                    </label>

                                    @php
                                        echo html()->select("match_status", $match_status_list, null);
                                    @endphp
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!--MATCH  ADDRESS-->
                <div class="form-group section-form-group">
                    <h3 class="league-form-subtitle">Match Address</h3>
                    <div class="form-group">
                        <label for="match_address_country">Country</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_country"
                            name="match_address_country"
                            rows="1"
                            value="{{ $match_address->country ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_postalcode">
                            Postal Code
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_postalcode"
                            name="match_address_postalcode"
                            rows="1"
                            value="{{ $match_address->postalcode ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_city">City</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_city"
                            name="match_address_city"
                            rows="1"
                            value="{{ $match_address->city ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_street">Street</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_street"
                            name="match_address_street"
                            rows="1"
                            value="{{ $match_address->street ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_number">Street Number</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_number"
                            name="match_address_number"
                            rows="1"
                            value="{{ $match_address->number ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_floor">Floor</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_floor"
                            name="match_address_floor"
                            rows="1"
                            value="{{ $match_address->floor ?? "" }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="match_address_door">Door</label>
                        <input
                            type="text"
                            class="form-control"
                            id="match_address_door"
                            name="match_address_door"
                            rows="1"
                            value="{{ $match_address->door ?? "" }}"
                        />
                    </div>
                </div>

                @php
                    $matchId = $match->match_id;
                @endphp

                @if (isset($league_type) and $league_type == "Beach Volleyball")
                    <x-formsResults.beachVolleyball :matchId="$matchId" />
                    <x-legends.beachVolleyballLegend />
                @endif

                <div class="actions-row">
                    <div class="btn-container">
                        <button type="submit" class="btn-create">Modify</button>
                    </div>

                    <div class="btn-container">
                        <a
                            href="{{ route("matches.index", ["league" => $league->league_id]) }}"
                            class="btn-cancel"
                        >
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
