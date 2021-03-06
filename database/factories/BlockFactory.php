<?php

declare(strict_types=1);

namespace Tipoff\Scheduler\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Scheduler\Models\Block;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition()
    {
        return [
            'escaperoom_slot_id' => randomOrCreate(app('escaperoom_slot')),
            'booking_slot_id'    => randomOrCreate(app('booking_slot')),
            'participants'       => $this->faker->numberBetween(1, 10),
            'type'               => $this->faker->word,
            'creator_id'         => randomOrCreate(app('user')),
        ];
    }
}
