<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kid_services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services_data');

            $table->foreignId('kid_id')
                ->constrained('kids')
                ->onDelete('cascade');

            $table->foreignId('location_id')
                ->nullable()
                ->constrained('locations');

            $table->foreignId('skill_id')
                ->constrained('skills');

            $table->foreignId('equip_id')
                ->nullable()
                ->constrained('equips');

            $table->foreignId('card_id')
                ->nullable()
                ->constrained('cards');

            $table->integer('service_type');

            $table->string("sum");
            $table->string("paid");
            $table->text("dates");
            $table->integer('approve');
            $table->string("lunch");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kid_services');
    }
};
