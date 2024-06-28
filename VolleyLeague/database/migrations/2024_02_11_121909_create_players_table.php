<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id('player_id');
            $table->bigInteger('team_id')->unsigned()->index();
            $table->bigInteger('league_id')->unsigned()->index();
            
            $table->timestamps();
            $table->string('name')->nullable();
			$table->string('surname_1')->nullable();
			$table->string('surname_2')->nullable();
			$table->bigInteger('player_number')->nullable();
            $table->string('sex')->nullable();
            
            $table->string('player_img_name')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('country')->nullable();
            $table->bigInteger('age')->nullable();
            $table->date('birth_date')->nullable();
            
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('address_id')->unsigned()->index();
			
            $table->foreign('league_id')->references('league_id')->on('leagues')->onDelete('cascade');
            $table->foreign('team_id')->references('team_id')->on('teams')->onDelete('cascade');
            $table->foreign('address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('players');
    }
};
