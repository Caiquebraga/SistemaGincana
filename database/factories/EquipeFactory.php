<?php

namespace Database\Factories;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipe>
 */
class EquipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Equipe::class;
    
    public function definition(): array
    {
        return [
            'equCPF' => $this->faker->word,
            'equDatCriacao' => $this->faker->date(),
            'equFot' => $this->faker->word,
        ];
    }
}
