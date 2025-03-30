<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Addresses;
use App\Models\League;
use App\Models\Matchy;
use App\Models\LeagueTypes;
use App\Enum\LeagueStatusEnum;
use App\Enum\MatchStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class MatchyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Matchy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leagueName = fake()->randomLetter().'League';
        $leagueTypesIDs = LeagueTypes::pluck('league_type_id')->toArray();


        return [
            'host_team_id' => fake()->uuid(),
            'guest_team_id' => fake()->uuid(),
            'guest_team_id' => fake()->uuid(),
            'match_address_id' => Addresses::factory()->create(),
            'league_type' => fake()->randomElement($leagueTypesIDs),
            'match_date' => fake()->dateTimeBetween('+2 week', '+1 month'),
            'league_id' => fake()->uuid() ,
            'match_number' =>  fake()->numberBetween(0,500),
            'week_number' => fake()->numberBetween(0,36),
            'host_points' => fake()->numberBetween(0,21),
            'guest_points' => fake()->numberBetween(0,21),
            'match_status' => fake()->randomElement([MatchStatusEnum::PENDING, MatchStatusEnum::ONGOING, MatchStatusEnum::FINISHED, MatchStatusEnum::CANCELED]),
        ];
        /*
        'host_team_id',
        'guest_team_id',
        'match_address_id',
        'league_type',
        'match_date',
        'league_id',
        'match_number',
        'week_number',
        'host_points',
        'guest_points',
        'match_status',
        */
    }
}