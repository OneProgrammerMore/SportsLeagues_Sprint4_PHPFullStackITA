<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Addresses;
use App\Models\Person;
use App\Models\League;
use Database\Factories\ImageFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $examplesImagePath = '';
        $inputFilesPath = '/storage/app/examples/team_imgs/';
        $outputPath = '/storage/app/public/';
        $infix = 'team_imgs/';

        $teamName = fake()->randomLetter().'Team';
        $leagueTypesIDs = League::pluck('league_type_id')->toArray();
        //$image = fake()->image($publicPath.'storage/app/public/league_imgs', 640, 480, null, false);
        $image = new ImageFaker($examplesImagePath, $inputFilesPath, $outputPath, $infix); 
        $imageName = $image->getImageName();

        return [
            'league_id' => fake()->uuid(),
            'team_number' => fake()->randomDigit(),
            'team_name' => $teamName,
            'team_address_id' => Addresses::factory(),
            'team_responsible_id' => Person::factory(),
            'team_phone' => fake()->phoneNumberWithExtension(),
            'team_img_name' => $imageName,
            'team_email' => fake()->email(),
        ];
        /*
        'league_id',
        'team_number',
        'team_name',
        'team_address_id',
        'team_responsible_id',
        'team_phone',
        'team_img_name',
        'team_email',
        */

    }
}