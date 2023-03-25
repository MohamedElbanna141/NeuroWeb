<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('image');
            $table->string('size');
            $table->string('effect_material');
            $table->string('price'); 
            $table->longText('side_effects'); 
            $table->string('section'); 
            $table->longText('description');
            $table->longText('how_to_use');
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
        //
    }
}
