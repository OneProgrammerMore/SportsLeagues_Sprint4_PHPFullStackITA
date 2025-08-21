<?php

namespace App\View\Components\Rankings;

use App\Models\Results\ResultsBeachVolleyball;
use App\Models\Team;
use App\Models\Matchy;
use Closure;
// Models for results:
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Enum\MatchStatusEnum;


class CommonRanking extends Component
{
    public $leagueId = null;

    /**
     * Create a new component instance.
     */
    public function __construct($leagueId = null)
    {
        $this->leagueId = $leagueId;
    }
    function cmp_ranking($a, $b)
    {
        return strcmp($a->ranking_points, $b->ranking_points);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        if ($this->leagueId != null) {
            
            $teams = Team::where('league_id', $this->leagueId)->get();

            foreach ($teams as $team) {
                // Games played
                $team->ranking_games_played_as_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('host_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)->count();
                $team->ranking_games_played_as_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('guest_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)->count();

                $team->ranking_games_played = $team->ranking_games_played_as_host + $team->ranking_games_played_as_guest;

                //Compute Victories and Draws:
                $team->wins_as_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('host_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->whereColumn('host_points','>','guest_points');
                $team->wins_as_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('guest_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->whereColumn('guest_points','>','host_points');
                $team->wins = $team->wins_as_host->count() + $team->wins_as_guest->count();

                $team->draws_as_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->whereColumn('guest_points','=','host_points')
                ->where('host_team_id', '=', $team->team_id)
                ->count();
                $team->draws_as_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->whereColumn('guest_points','=','host_points')
                ->where('guest_team_id', '=', $team->team_id)
                ->count();
                $team->draws = $team->draws_as_host + $team->draws_as_guest; 

                $team->loses_as_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('host_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->where('host_points','<','guest_points');
                $team->loses_as_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('guest_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->whereColumn('guest_points','<','host_points');
                $team->loses = $team->loses_as_host->count() + $team->loses_as_guest->count();
                
                $team->points_favour_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('host_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->sum('host_points');
                $team->points_favour_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('guest_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->sum('guest_points');
                $team->points_favour = $team->points_favour_host + $team->points_favour_guest;

                $team->points_against_host = Matchy::where('league_id','=',$this->leagueId)
                ->where('host_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->sum('guest_points');
                $team->points_against_guest = Matchy::where('league_id','=',$this->leagueId)
                ->where('guest_team_id', '=', $team->team_id)
                ->where('match_status', '=', MatchStatusEnum::FINISHED)
                ->sum('host_points');
                $team->points_against = $team->points_against_host + $team->points_against_guest;

                
                //For this example a victory is 2 points and a draw 1, loses do not add in the ranking
                $team->ranking_points = 2*$team->wins_as_host->count() + 2*$team->wins_as_guest->count() + 1*$team->draws;
            }
            
            // Sort elements depending on points:
            // usort($teams, "cmp_ranking");
            // $teams->sortBy('ranking_points')->values();
            $teams = $teams->sortByDesc('ranking_points');

            // Add position to the teams (number from 1 to teams count)
            $pos = 1;
            foreach ($teams as $team) {
                $team->ranking_position = $pos;
                $pos++;
            }

            return view('components.rankings.common-ranking', ['teams' => $teams]);

        } else {
            // Log error somewhere over the rainbow....

            // After logging error return
            return '';
        }

    }
}
