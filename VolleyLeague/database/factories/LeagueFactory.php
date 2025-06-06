<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Addresses;
use App\Models\League;
use App\Models\Person;
use App\Models\LeagueTypes;
use App\Enum\LeagueStatusEnum;
use Database\Factories\ImageFaker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class LeagueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = League::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $examplesImagePath = '';
        $inputFilesPath = '/storage/app/examples/league_imgs/';
        $outputPath = '/storage/app/public/imgs/';
        $infix = 'league_imgs/';

        $leagueName = fake()->randomLetter().'League';
        $leagueTypesIDs = LeagueTypes::pluck('league_type_id')->toArray();

        $image = new ImageFaker($examplesImagePath, $inputFilesPath, $outputPath, $infix); 
        $imageName = $image->getImageName();

        $publicPath = "/var/www/html/";
        return [
            'league_type_id' => 1,
            'league_name' => $leagueName,
            'league_status' => fake()->randomElement([LeagueStatusEnum::WAITING, LeagueStatusEnum::ONGOING, LeagueStatusEnum::FINISHED, LeagueStatusEnum::CANCELED]),
            'league_admin_id' => Person::factory()->create(),
            'league_admin_id_2' => Person::factory()->create(),
            'league_img_name' => $imageName,
            'league_starting_date' => fake()->dateTimeBetween('-1 month', '+1 week'),
            'league_finalization_date' => fake()->dateTimeBetween('+2 week', '+1 month'),
            'league_description' => "This is a fake description for a league. This is a fake description for a league.",
            'league_channel' => 'wwww.'.$leagueName.'.com',
            'league_official_web' => 'wwww.youtube.com?channel='.$leagueName,
        ];
    }
}