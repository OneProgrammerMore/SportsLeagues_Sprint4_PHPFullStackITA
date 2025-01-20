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

        <div class="create-league-container">
            <div class="create-league-inner-container">
                <h3>Create a new match:</h3>
                <form class="create-match-form" action="{{ route('matches.store', $league->league_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!--TEAM NUMBER -->
                    <div class="form-group-main section-form-group">
                        <h3>Team Information</h3>
                        <div class="form-group-hidden">
                            <label for="league_id">League ID:</label>
                            <input type="text" class="form-control" id="league_id" name="league_id" rows="1"
                                value={{ $league->league_id }} required>
                        </div>
                        <div class="form-group">
                            <label for="match_number">Match Number:</label>
                            <input type="text" class="form-control" id="match_number" name="match_number"
                                rows="1" value={{ $next_match_number }} required readonly>
                        </div>

                    </div>

                    <!-- MATCH DATA -->
                    <div class="form-group section-form-group">
                        <h3>Match Information</h3>
                        <div class="form-group">
                            <label for="match_date">Match Date:
                                <span class="required">*</span>
                            </label>
                            <input type="datetime-local" class="form-control" id="match_date" name="match_date"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="week_number">Week number:
                                <span class="required">*</span>
                            </label>
                            <input type="number" class="form-control" id="week_number" name="week_number" required>
                        </div>

                        <div class="form-group">
                            <label for="host_team_id">Host Team:
                                <span class="required">*</span>
                            </label>
                            @php
                                echo html()->select('host_team_id', $teams_list, null);
                            @endphp
                        </div>

                        <div class="form-group">
                            <label for="host_points">Host Points: (Optional)</label>
                            <input type="number" class="form-control" id="host_points" name="host_points">
                        </div>

                        <div class="form-group">
                            <label for="guest_team_id">Guest Team:
                                <span class="required">*</span>
                            </label>
                            @php
                                echo html()->select('guest_team_id', $teams_list, null);
                            @endphp
                        </div>

                        <div class="form-group">
                            <label for="match_status">Match Status:</label>
                            @php
                                echo html()->select('match_status', $match_status_list, null);
                            @endphp
                        </div>

                        <div class="form-group">
                            <label for="guest_points">Guest Points: (Optional)</label>
                            <input type="number" class="form-control" id="guest_points" name="guest_points">
                        </div>

                    </div>

                    <!--MATCH  ADDRESS-->
                    <div class="form-group section-form-group">
                        <h3>Match Address:</h3>
                        <div class="form-group">
                            <label for="match_address_country">Country:</label>
                            <input type="text" class="form-control" id="match_address_country"
                                name="match_address_country" rows="1">

                            <label for="match_address_postalcode">Postal Code:</label>
                            <input type="text" class="form-control" id="match_address_postalcode"
                                name="match_address_postalcode" rows="1">

                            <label for="match_address_city">City:</label>
                            <input type="text" class="form-control" id="match_address_city" name="match_address_city"
                                rows="1">

                            <label for="match_address_street">Street:</label>
                            <input type="text" class="form-control" id="match_address_street"
                                name="match_address_street" rows="1">

                            <label for="match_address_number">Street Number:</label>
                            <input type="text" class="form-control" id="match_address_number"
                                name="match_address_number" rows="1">

                            <label for="match_address_floor">Floor:</label>
                            <input type="text" class="form-control" id="match_address_floor"
                                name="match_address_floor" rows="1">

                            <label for="match_address_door">Door:</label>
                            <input type="text" class="form-control" id="match_address_door"
                                name="match_address_door" rows="1">
                        </div>
                    </div>

                    @if (isset($league_type) and $league_type == 'Beach Volleyball')
                        <x-formsResults.beachVolleyball />
                        <x-legends.beachVolleyballLegend />
                    @endif

                    <div class="actions-row">
                        <div class="btn-container">
                            <button type="submit" class="btn-create">
                                <span class="icon icon-league-link icon-create"></span>
                                Create</button>
                        </div>

                        <a href="{{ route('matches.index', ['league' => $league->league_id]) }}" class="btn-cancel">
                            <span class="icon icon-league-link icon-cancel"></span>
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
