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
        $outputPath = '/storage/app/public/imgs/';
        $infix = 'team_imgs/';

        $teamName = fake()->randomLetter().'Team';
        $leagueTypesIDs = League::pluck('league_type_id')->toArray();
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

    }
}