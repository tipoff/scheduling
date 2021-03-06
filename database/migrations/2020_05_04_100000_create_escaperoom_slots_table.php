<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscaperoomSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('escaperoom_slots', function (Blueprint $table) {
            $table->id();
            $table->string('slot_number')->index(); // Generated by system. This is identifier used to coordinate with virtual slots.
            $table->foreignIdFor(app('room'))->index();
            $table->foreignIdFor(app('escaperoom_rate')); // Can override the default rate for the room.
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->string('schedule_type')->nullable();
            $table->date('date')->index();
            $table->dateTime('start_at');
            $table->dateTime('end_at'); // Computed from room->duration
            $table->dateTime('room_available_at'); // Time when the room is available for another slot. Automatically computed by adding room->occupied_time to slot->start_at
            $table->unsignedTinyInteger('participants_booked');
            $table->unsignedTinyInteger('participants_blocked');
            $table->unsignedTinyInteger('participants_available'); // Capacity - defaults to room capacity for public games
            $table->foreignIdFor(app('supervision'));
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();

            $table->index(['schedule_id', 'schedule_type']);
        });
    }
}
