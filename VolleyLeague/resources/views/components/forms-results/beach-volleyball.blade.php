@vite("resources/css/comp_formResults.css")
<div class="form-results-container">
    <!-- This is a part of the form that MUST be inside a form (for starting and ending clauses) -->

    <div class="form-results">
        <div class="results-form-section section-form-group">
            <div class="form-group-results">
                <h3>Host</h3>
                <label for="matches_won">Matches won by host:</label>
                <input
                    type="number"
                    class="form-control"
                    name="matches_won"
                    rows="1"
                    value="{{ $match_results->matches_won ?? "" }}"
                />

                <label for="sets_won">Sets won by host:</label>
                <input
                    type="number"
                    class="form-control"
                    name="sets_won"
                    rows="1"
                    value="{{ $match_results->sets_won ?? "" }}"
                />

                <label for="points_won">Points won by host:</label>
                <input
                    type="number"
                    class="form-control"
                    name="points_won"
                    rows="1"
                    value="{{ $match_results->points_won ?? "" }}"
                />
            </div>

            <div class="form-group-results">
                <h3>Guest</h3>
                <label for="matches_lost">Matches won by guest:</label>
                <input
                    type="number"
                    class="form-control"
                    name="matches_lost"
                    rows="1"
                    value="{{ $match_results->matches_lost ?? "" }}"
                />

                <label for="sets_lost">Sets won by guest:</label>
                <input
                    type="number"
                    class="form-control"
                    name="sets_lost"
                    rows="1"
                    value="{{ $match_results->sets_lost ?? "" }}"
                />

                <label for="points_lost">Points won by guest:</label>
                <input
                    type="number"
                    class="form-control"
                    name="points_lost"
                    rows="1"
                    value="{{ $match_results->points_lost ?? "" }}"
                />
            </div>
        </div>

        <div class="results-form-section section-form-group">
            <div class="form-group-results">
                <h3>Host Other Results:</h3>
                <label for="host_g3">Host G3:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_g3"
                    rows="1"
                    value="{{ $match_results->host_g3 ?? "" }}"
                />

                <label for="host_g2">Host G2:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_g2"
                    rows="1"
                    value="{{ $match_results->host_g2 ?? "" }}"
                />

                <label for="host_p1">Host P1:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_p1"
                    rows="1"
                    value="{{ $match_results->host_p1 ?? "" }}"
                />

                <label for="host_p0">Host P0:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_p0"
                    rows="1"
                    value="{{ $match_results->host_p0 ?? "" }}"
                />

                <label for="host_pg">Host PG:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_pg"
                    rows="1"
                    value="{{ $match_results->host_pg ?? "" }}"
                />

                <label for="host_sf">Host SF:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_sf"
                    rows="1"
                    value="{{ $match_results->host_sf ?? "" }}"
                />

                <label for="host_sc">Host SC:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_sc"
                    rows="1"
                    value="{{ $match_results->host_sc ?? "" }}"
                />

                <label for="host_pf">Host PF:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_pf"
                    rows="1"
                    value="{{ $match_results->host_pf ?? "" }}"
                />

                <label for="host_pf">Host PC:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_pc"
                    rows="1"
                    value="{{ $match_results->host_pc ?? "" }}"
                />

                <label for="host_sanc">Host Sanctions:</label>
                <input
                    type="number"
                    class="form-control"
                    name="host_sanc"
                    rows="1"
                    value="{{ $match_results->host_sanc ?? "" }}"
                />
            </div>

            <div class="form-group-results">
                <h3>Guest Other Results:</h3>
                <label for="guest_g3">Guest G3:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_g3"
                    rows="1"
                    value="{{ $match_results->guest_g3 ?? "" }}"
                />

                <label for="guest_g2">Guest G2:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_g2"
                    rows="1"
                    value="{{ $match_results->guest_g2 ?? "" }}"
                />

                <label for="guest_p1">Guest P1:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_p1"
                    rows="1"
                    value="{{ $match_results->guest_p1 ?? "" }}"
                />

                <label for="guest_p0">Guest P0:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_p0"
                    rows="1"
                    value="{{ $match_results->guest_p0 ?? "" }}"
                />

                <label for="guest_pg">Guest PG:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_pg"
                    rows="1"
                    value="{{ $match_results->guest_pg ?? "" }}"
                />

                <label for="guest_sf">Guest PF:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_sf"
                    rows="1"
                    value="{{ $match_results->guest_sf ?? "" }}"
                />

                <label for="guest_sc">Guest SC:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_sc"
                    rows="1"
                    value="{{ $match_results->guest_sc ?? "" }}"
                />

                <label for="guest_pf">Guest PF:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_pf"
                    rows="1"
                    value="{{ $match_results->guest_pf ?? "" }}"
                />

                <label for="guest_pf">Guest PC:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_pc"
                    rows="1"
                    value="{{ $match_results->guest_pc ?? "" }}"
                />

                <label for="guest_sanc">Guest Sanctions:</label>
                <input
                    type="number"
                    class="form-control"
                    name="guest_sanc"
                    rows="1"
                    value="{{ $match_results->guest_sanc ?? "" }}"
                />
            </div>
        </div>
    </div>
</div>
