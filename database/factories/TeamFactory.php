<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
     * @return array
     */
    public function definition()
    {
        // Obtener un ID de país válido
        $countryId = DB::table('countries')->inRandomOrder()->first()->id;

        return [
            'name' => $this->faker->country,
            'uuid' => $this->faker->uuid,
            'logo' => $this->faker->word . '.' . $this->faker->fileExtension,
            'country_id' => $countryId,
            'active' => $this->faker->boolean
        ];
    }
}
