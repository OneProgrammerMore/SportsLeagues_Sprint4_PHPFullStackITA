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
    public $weekStart;
    public $weekEnd;
    public $match_results;

    /**
     * Create a new component instance.
     */
    //public function __construct($leagueId = null, $weekStart = null, $weekEnd = null)
    public function __construct($matches = null)
    {
        //$this->leagueId = $leagueId;
        //$this->weekStart =  $weekStart;
        //$this->weekEnd = $weekEnd;
        $this->matches = $matches;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        if ($this->matches != null) {

            $matchesIDs = $this->matches->pluck('match_id');
            $this->match_results = ResultsBeachVolleyball::whereIn('match_id', $matchesIDs)->get();

            foreach ($this->match_results as $result) {
                $match = Matchy::find($result->match_id);
                $result->match_number = $match->match_number;
                $result->week_number = $match->week_number;

                $hostTeam = Team::find(Matchy::find($result->match_id)->host_team_id);
                $guestTeam = Team::find(Matchy::find($result->match_id)->guest_team_id);

                $result->host_img = $hostTeam->team_img_name;
                $result->guest_img = $guestTeam->team_img_name;

                $result->host_team_name = $hostTeam->team_name;
                $result->guest_team_name = $guestTeam->team_name;

                $result->match_date = $match->match_date;

                // Append only date and only time to use it in the view:
                $result->only_date = date('d/m/Y', strtotime($result->match_date));
                $result->only_time = date('h:m', strtotime($result->match_date));
            }
            return view('components.results.beachVolleyballResults', ['match_results' => $this->match_results]);
        }

        return '';
    }
}
