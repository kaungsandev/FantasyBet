<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Fixture;

class FixtureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fixture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event' => $this->faker->title(),
            'finished' => false,
            'kickoff_time' => $this->faker->dateTimeBetween('+1 day', '+1 month', 'Asia/Yangon'),
            'started' => false,
            'home_team' => \rand(1, 20),
            'away_team' => \rand(1, 20),
            'home_team_score' => 0,
            'away_team_score' => 0,
            'home_team_point' => 0.96,
            'away_team_point' => 0.96,
            'draw_point' => 0.5,
        ];
    }
}
