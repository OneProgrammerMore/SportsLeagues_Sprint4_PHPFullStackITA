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
            <!-- INFORMATION IN leagues/{league} -->
            <!-- League Info -->
            <!-- League Classification -->
            <!-- League Results -->
            <!-- League Next Matches -->

            <div class="league-info-container-show">
                <div class="league-container-show">
                    <div class="league-info-show">
                        <div class="league-img-show">
                            <img
                                src="{{ asset($league->league_img_name ? "storage/public/" . $league->league_img_name : "img/league.png") }}"
                                alt="Web Logo - The image of a Tournament Cup"
                            />
                        </div>
                        <div class="league-data">
                            <div class="league-show-group">
                                <h3 class="league-header">League Name</h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_name }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">League Status</h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_status }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">League Type:</h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_type }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">
                                    League Starting Date:
                                </h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_starting_date }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">
                                    League Finalization Date:
                                </h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_finalization_date }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">
                                    League Description
                                </h3>
                                <h3 class="league-data-field">
                                    {{ $league->league_description }}
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">
                                    League Official Web:
                                </h3>
                                <h3 class="league-data-field">
                                    <a
                                        href="{{ $league->league_official_web }}"
                                    >
                                        {{ $league->league_official_web }}
                                    </a>
                                </h3>
                            </div>

                            <div class="league-show-group">
                                <h3 class="league-header">League Channel:</h3>
                                <h3 class="league-data-field">
                                    <a href="{{ $league->league_channel }}">
                                        {{ $league->league_channel }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="league-actions-show">
                        <form
                            class="league-info-link league-link"
                            action="{{ route("leagues.edit", $league->league_id) }}"
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
                            action="{{ route("leagues.destroy", $league->league_id) }}"
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
            </div>

            <!-- League Classification -->
            <!-- League Results -->
            <!-- League Next Matches -->
        </main>

        <x-footer />
    </body>
</html>
