<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Addresses;
use App\Models\Person;
use App\Models\Players;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class PlayersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Players::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $examplesImagePath = '';
        $inputFilesPath = '/storage/app/examples/player_imgs/';
        $outputPath = '/storage/app/public/imgs/';
        $infix = 'team_imgs/';
        $image = new ImageFaker($examplesImagePath, $inputFilesPath, $outputPath, $infix); 
        $imageName = $image->getImageName();

        $birth = fake()->dateTimeBetween('-100 years', '-5 years');
        return [
            'league_id' => fake()->uuid(),
            'team_id' => fake()->uuid(),
            'name' => fake()->firstName(),
            'surname_1' => fake()->lastName(),
            'surname_2' => fake()->lastName(),
            'sex' => fake()->randomElement(['male','female','other']),
            'height' => fake()->randomFloat(2, 0.5, 2.5),
            'weight' => fake()->randomFloat(2, 10, 150),
            'country' => fake()->country(),
            'age' => date_diff(date_create($birth->format('Y-m-d')), date_create('now'))->y,
            'birth_date' => $birth->format('Y-m-d'), 
            'player_number' => fake()->randomNumber(2, false),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumberWithExtension(),
            'address_id' => Addresses::factory()->create(),
            'player_img_name' => $imageName,
        ];

    }
}