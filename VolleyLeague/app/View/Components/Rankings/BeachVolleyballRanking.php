<?php

namespace App\View\Components\Rankings;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

//Models for results:
use App\Models\Team;
use App\Models\Matchy;
use App\Models\Results\ResultsBeachVolleyball;


function cmp_ranking($a, $b){
	return strcmp($a->ranking_points, $b->ranking_points);
}


class BeachVolleyballRanking extends Component
{
	
	public $leagueId = null;
	
    /**
     * Create a new component instance.
     */
    public function __construct( $leagueId = null)
    {
		$this->leagueId = $leagueId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
		
		if($this->leagueId != null){
			
			//Compute the league ranking
			//ToDo - In the future do it once each day or when a match result is modified and 
			// retrieve the information from a database...
			//Hard work ahead... to do in the future... thus tomorrow
			
			//Retrieve Beach Volleyball Results Sumatory
			
			//Retrieve all the teams that participate in the league:
			$teams = Team::where('league_id', $this->leagueId)->get();
			
			//For each team make the needed summatories in order to calculate at the end the ranking by points
			
			//Refactor - Too Many Sql Queries...
			/*
			foreach($teams as $team){
				
				
				//Games played
				$team->ranking_games_played_as_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->count();
				$team->ranking_games_played_as_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->count();
				$team->ranking_games_played = $team->ranking_games_played_as_host + $team->ranking_games_played_as_guest;
				
				//For when team is the host
				$team->ranking_g3_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_g3');
				$team->ranking_g2_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_g2');
				$team->ranking_p1_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_p1');
				$team->ranking_p0_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_p0');
				$team->ranking_pg_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_pg');
				$team->ranking_sf_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_sf');
				$team->ranking_sc_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_sc');
				$team->ranking_pf_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_pf');
				$team->ranking_pc_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_pc');
				$team->ranking_sanc_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('host_sanc');
				
			
				//For when team is the guest
				$team->ranking_g3_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_g3');
				$team->ranking_g2_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_g2');
				$team->ranking_p1_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_p1');
				$team->ranking_p0_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_p0');
				$team->ranking_pg_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_pg');
				$team->ranking_sf_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_sf');
				$team->ranking_sc_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_sc');
				$team->ranking_pf_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_pf');
				$team->ranking_pc_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_pc');
				$team->ranking_sanc_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->sum('guest_sanc');
				
				
				//Make the summatory of host plus guest:
				$team->ranking_g3 = $team->ranking_g3_host + $team->ranking_g3_guest;
				$team->ranking_g2 = $team->ranking_g2_host + $team->ranking_g2_guest;
				$team->ranking_p1 = $team->ranking_p1_host + $team->ranking_p1_guest;
				$team->ranking_p0 = $team->ranking_p0_host + $team->ranking_p0_guest;
				$team->ranking_pg = $team->ranking_pg_host + $team->ranking_pg_guest;
				$team->ranking_sf = $team->ranking_sf_host + $team->ranking_sf_guest;
				$team->ranking_sc = $team->ranking_sc_host + $team->ranking_sc_guest;
				$team->ranking_pf = $team->ranking_pf_host + $team->ranking_pf_guest;
				$team->ranking_pc = $team->ranking_pc_host + $team->ranking_pc_guest;
				$team->ranking_sanc = $team->ranking_sanc_host + $team->ranking_sanc_guest;
			}*/
			
			foreach($teams as $team){
				
				
				//Games played
				$team->ranking_games_played_as_host = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId)->count();
				$team->ranking_games_played_as_guest = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId)->count();
				$team->ranking_games_played = $team->ranking_games_played_as_host + $team->ranking_games_played_as_guest;
				
				//For when team is the host
				$hostTeam = ResultsBeachVolleyball::where('host_team_id', $team->team_id)->where('league_id', $this->leagueId);
				
				$team->ranking_g3_host = $hostTeam->sum('host_g3');
				$team->ranking_g2_host = $hostTeam->sum('host_g2');
				$team->ranking_p1_host = $hostTeam->sum('host_p1');
				$team->ranking_p0_host = $hostTeam->sum('host_p0');
				$team->ranking_pg_host = $hostTeam->sum('host_pg');
				$team->ranking_sf_host = $hostTeam->sum('host_sf');
				$team->ranking_sc_host = $hostTeam->sum('host_sc');
				$team->ranking_pf_host = $hostTeam->sum('host_pf');
				$team->ranking_pc_host = $hostTeam->sum('host_pc');
				$team->ranking_sanc_host = $hostTeam->sum('host_sanc');
				
			
				//For when team is the guest
				$guestTeam = ResultsBeachVolleyball::where('guest_team_id', $team->team_id)->where('league_id', $this->leagueId);
				$team->ranking_g3_guest = $guestTeam->sum('guest_g3');
				$team->ranking_g2_guest = $guestTeam->sum('guest_g2');
				$team->ranking_p1_guest = $guestTeam->sum('guest_p1');
				$team->ranking_p0_guest = $guestTeam->sum('guest_p0');
				$team->ranking_pg_guest = $guestTeam->sum('guest_pg');
				$team->ranking_sf_guest = $guestTeam->sum('guest_sf');
				$team->ranking_sc_guest = $guestTeam->sum('guest_sc');
				$team->ranking_pf_guest = $guestTeam->sum('guest_pf');
				$team->ranking_pc_guest = $guestTeam->sum('guest_pc');
				$team->ranking_sanc_guest = $guestTeam->sum('guest_sanc');
				
				
				//Make the summatory of host plus guest:
				$team->ranking_g3 = $team->ranking_g3_host + $team->ranking_g3_guest;
				$team->ranking_g2 = $team->ranking_g2_host + $team->ranking_g2_guest;
				$team->ranking_p1 = $team->ranking_p1_host + $team->ranking_p1_guest;
				$team->ranking_p0 = $team->ranking_p0_host + $team->ranking_p0_guest;
				$team->ranking_pg = $team->ranking_pg_host + $team->ranking_pg_guest;
				$team->ranking_sf = $team->ranking_sf_host + $team->ranking_sf_guest;
				$team->ranking_sc = $team->ranking_sc_host + $team->ranking_sc_guest;
				$team->ranking_pf = $team->ranking_pf_host + $team->ranking_pf_guest;
				$team->ranking_pc = $team->ranking_pc_host + $team->ranking_pc_guest;
				$team->ranking_sanc = $team->ranking_sanc_host + $team->ranking_sanc_guest;
			}
			//Compute the point depending of the different rules
			//BeachVolleyball rules applied (See legend for beach volleyball)
			foreach($teams as $team){
				$team->ranking_points = $team->ranking_g3 * 3 + $team->ranking_g2 * 2 + $team->ranking_p1 * 1;
			}
			
			//Sort elements depending on points:
			//usort($teams, "cmp_ranking");
			//$teams->sortBy('ranking_points')->values();
			$teams = $teams->sortByDesc('ranking_points');
			
			//Add position to the teams (number from 1 to teams count)
			$pos = 1;
			foreach($teams as $team){
				$team->ranking_position = $pos;
				$pos ++;
			}
			
			
			return view('components.rankings.beach-volleyball-ranking', ['teams' => $teams]);
			
			
		}else{
			//Log error somewhere over the rainbow....
			
			
			//After logging error return
			return "";
		}
		
		
		
        
    }
}


