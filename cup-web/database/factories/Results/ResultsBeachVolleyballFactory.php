<?php

namespace Database\Factories\Results;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Addresses;
use App\Models\League;
use App\Models\Matchy;
use App\Models\LeagueTypes;
use App\Enum\LeagueStatusEnum;
use App\Enum\MatchStatusEnum;
use App\Models\Results\ResultsBeachVolleyball;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Results\ResultsBeachVolleyball>
 */
class ResultsBeachVolleyballFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    //protected $model = ResultsBeachVolleyball::class;
    protected $model = \App\Models\Results\ResultsBeachVolleyball::class;
    //Database\Factories\Results\ResultsBeachVolleyballFactory
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'league_id' => fake()->uuid(),
            'match_id' => fake()->uuid(),
            'host_team_id' => fake()->uuid(),
            'guest_team_id' => fake()->uuid(),

            'matches_won' => fake()->numberBetween(0,21),
            'sets_won' => fake()->numberBetween(0,21),
            'points_won' => fake()->numberBetween(0,21) ,
            'matches_lost' =>  fake()->numberBetween(0,21),
            'sets_lost' => fake()->numberBetween(0,21),
            'points_lost' => fake()->numberBetween(0,21),

            'host_g3' => fake()->numberBetween(0,21),
            'host_g2' => fake()->numberBetween(0,21),
            'host_p1' => fake()->numberBetween(0,21) ,
            'host_p0' =>  fake()->numberBetween(0,21),
            'host_pg' => fake()->numberBetween(0,21),
            'host_sf' => fake()->numberBetween(0,21),
            'host_sc' => fake()->numberBetween(0,21),
            'host_pf' => fake()->numberBetween(0,21),
            'host_pc' => fake()->numberBetween(0,21) ,
            'host_sanc' =>  fake()->numberBetween(0,21),

            'guest_g3' => fake()->numberBetween(0,21),
            'guest_g2' => fake()->numberBetween(0,21),
            'guest_p1' => fake()->numberBetween(0,21) ,
            'guest_p0' =>  fake()->numberBetween(0,21),
            'guest_pg' => fake()->numberBetween(0,21),
            'guest_sf' => fake()->numberBetween(0,21),
            'guest_sc' => fake()->numberBetween(0,21),
            'guest_pf' => fake()->numberBetween(0,21),
            'guest_pc' => fake()->numberBetween(0,21) ,
            'guest_sanc' =>  fake()->numberBetween(0,21),
        ];
    }
}