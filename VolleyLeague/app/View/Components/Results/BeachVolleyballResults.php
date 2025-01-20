<?php

namespace App\View\Components\Results;

use App\Models\League;
use App\Models\Matchy;
use App\Models\Results\ResultsBeachVolleyball;
// Dependencies for matches results
// ToDo - Check if all needed ?¿
use App\Models\Team;
use Closure;
use Illuminate\Contracts\View\View;
// Models for results:
use Illuminate\View\Component;

class BeachVolleyballResults extends Component
{
    public $leagueId;

    public $match_results;

    /**
     * Create a new component instance.
     */
    public function __construct($leagueId = null)
    {
        //
        $this->leagueId = $leagueId;
        // $this->league_id = 3;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        if ($this->leagueId != null) {

            // Get the matches results for the view
            $league = League::find($this->leagueId);
            // $match_results = ResultsBeachVolleyball::where('league_id', $league->league_id)->get();
            $this->match_results = ResultsBeachVolleyball::where('league_id', $league->league_id)->get();

            // ToDo - Add
            // match_number
            // host_team_img
            // guest_team_img
            // host_team_name
            // guest_team_name
            // Date and time atomic:
            // only_date
            // only_time
            // Refactor - Too Many SQL Requests:
            /*
            foreach($this->match_results as $result){
                $result->match_number = Matchy::find($result->match_id)->match_number;

                $result->host_img = Team::find(Matchy::find($result->match_id)->host_team_id)->team_img_name;
                $result->guest_img = Team::find(Matchy::find($result->match_id)->guest_team_id)->team_img_name;

                $result->host_team_name= Team::find(Matchy::find($result->match_id)->host_team_id)->team_name;
                $result->guest_team_name = Team::find(Matchy::find($result->match_id)->guest_team_id)->team_name;

                $result->match_date = Matchy::find($result->match_id)->match_date;

                //Append only date and only time to use it in the view:
                $result->only_date = date('d/m/Y', strtotime($result->match_date));
                $result->only_time = date('h:m', strtotime($result->match_date));
            }*/

            foreach ($this->match_results as $result) {
                $result->match_number = Matchy::find($result->match_id)->match_number;

                $hostTeam = Team::find(Matchy::find($result->match_id)->host_team_id);
                $guestTeam = Team::find(Matchy::find($result->match_id)->guest_team_id);

                $result->host_img = $hostTeam->team_img_name;
                $result->guest_img = $guestTeam->team_img_name;

                $result->host_team_name = $hostTeam->team_name;
                $result->guest_team_name = $guestTeam->team_name;

                $result->match_date = Matchy::find($result->match_id)->match_date;

                // Append only date and only time to use it in the view:
                $result->only_date = date('d/m/Y', strtotime($result->match_date));
                $result->only_time = date('h:m', strtotime($result->match_date));
            }

            // return view('components.results.beachVolleyballResults', compact('match_results'));
            return view('components.results.beachVolleyballResults', ['match_results' => $this->match_results]);

        }

        return '';
    }
}
