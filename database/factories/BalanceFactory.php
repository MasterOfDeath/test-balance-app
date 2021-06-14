<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

    /** @var array */
    private $last = null;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $value = [
            $this->faker->randomFloat(2, -100, -1000),
            $this->faker->randomFloat(2, 100, 1000)
        ];

        $value = $value[rand(0, 1)];
        $user_id = rand(1, 2);

        if ($this->last && array_key_exists($user_id, $this->last)) {
            $balance = $this->last[$user_id]['balance'] + $value;
            $created_at = (clone $this->last[$user_id]['created_at'])->addMinutes(rand(100, 1000));
        } else {
            $balance = $value;
            $created_at = (Carbon::now())->subWeeks(rand(3, 10));
        }

        $this->last[$user_id] = [
            'value' => $value,
            'balance' => $balance,
            'user_id' => $user_id,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];

        return $this->last[$user_id];
    }
}
