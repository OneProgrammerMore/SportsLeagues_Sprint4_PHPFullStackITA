<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\League;
use App\Models\Team;
use App\Models\Players;
use App\Models\Matchy;
use App\Models\LeagueTypes;


class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //Create one league
        $league = League::factory()->create();
        $league_id = $league;
        // Create 8 teams for these league
        $teams = [];
        for( $num = 0; $num < 8; $num += 1 ) { 
            array_push($teams, Team::factory()->state(['league_id'=> $league_id, 'team_number'=>$num])->create());
        }
        
        

        // For each team create 8 Players
        foreach($teams as $team){
            for( $num = 0; $num < 8; $num += 1 ) { 
                echo "LeaugeID = ". $league_id;
                echo "team_id= ". $team;
                Players::factory()->state(['league_id'=>$league_id, 'team_id'=>$team])->create();
            }  
        }

        //Create Matches:
        //$leagueID, $hostTeamID, $guestTeamID, $weekNumber
        $amountTeams = 8;
        $amountMatches = 8*(8-1);
        $matches = [];
        for( $host = 0; $host < 8; $host += 1 ) {
            for( $guest = $host+1; $guest < 8; $guest += 1){
                
                
                
                $match = Matchy::where('league_id',$league_id)->orderBy('match_number', 'DESC')->first();
                if(! $match){
                    $matchNumber = 1;
                }else{
                    $matchNumber = $match->match_number++;
                }


                Matchy::factory()->state(
                    ['league_id'=>$league_id,
                    'host_team_id' => $teams[$host],
                    'guest_team_id'=> $teams[$guest],
                    'week_number'=>$host,
                    'match_number'=>$matchNumber]
                    )->create();
            }
            
        }
        


    }
}
