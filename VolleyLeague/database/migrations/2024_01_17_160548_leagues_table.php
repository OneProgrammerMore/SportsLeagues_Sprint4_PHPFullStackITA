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

        Schema::create('addresses', function (Blueprint $table) {
            $table->id('address_id');  // same as integer('address_id')->unique()->autoIncrement()
            $table->string('country')->nullable(); // or state...
            $table->string('postalcode')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('floor')->nullable();
            $table->string('door')->nullable();
            $table->timestamps();

        });

        // Leagues types table:
        // It defines which league type is the league associated with:
        // As example
        // Beachvolley for id 1
        // 3vs3 Basketball simple for id 2

        // It is done in order to scale the application in the future and being able to add other sports:
        Schema::create('league_types', function (Blueprint $table) {
            $table->id('league_type_id');
            $table->string('league_type');
            $table->string('description');
        });

        Schema::create('person', function (Blueprint $table) {
            $table->id('person_id');
            $table->string('person_name')->nullable();
            $table->string('person_surname_1')->nullable();
            $table->string('person_surname_2')->nullable();
            $table->string('person_email')->nullable();
            $table->string('person_phone')->nullable();
            $table->bigInteger('person_address_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('person_address_id')->references('address_id')->on('addresses');

        });

        // Create the tables for VolleyLeague
        // All in this file
        // Starting as test by Leagues table:
        Schema::create('leagues', function (Blueprint $table) {
            $table->id('league_id');
            // $table->integer('league_type_id');
            $table->bigInteger('league_type_id')->unsigned()->index()->nullable();
            $table->string('league_type');
            $table->string('league_name');
            $table->string('league_status');
            $table->bigInteger('league_admin_id')->unsigned()->index()->nullable();
            $table->bigInteger('league_admin_id_2')->unsigned()->index()->nullable();
            $table->string('league_img_name');

            $table->timestamp('league_starting_date')->nullable();
            $table->timestamp('league_finalization_date')->nullable();
            $table->string('league_description')->nullable();
            $table->string('league_official_web')->nullable();
            $table->string('league_channel')->nullable();

            $table->timestamps();

            // Foreing Keys:
            $table->foreign('league_type_id')->references('league_type_id')->on('league_types');
            $table->foreign('league_admin_id')->references('person_id')->on('person');
            $table->foreign('league_admin_id_2')->references('person_id')->on('person');
            // $table->foreign('league_type')->references('league_type')->on('league_types');

        });

        /*
         * - Teams Table:
            Team_ID -> INT UNIQUE AUTOINCREMENT
            League_ID -> The League Which belongs To
            Team_Name -> Team's name
            Team_address -> The address of the team
            Team_Responsible -> Man/Women responsible of the team
            Team_ContactPhone -> Phone number to contact the team
         * */
        /*address_id -> string
            country -> string
            postalcode -> string
            city -> String
            street -> string
            number -> string
            floor -> string
            door -> string*/

        // SOURCE: https://laravel.com/docs/7.x/migrations

        Schema::create('teams', function (Blueprint $table) {
            $table->id('team_id');
            // $table->bigInteger('league_id')->references('league_id')->on('leagues');
            $table->bigInteger('league_id')->unsigned()->index();
            $table->bigInteger('team_number')->unsigned(); // It is the number that the team has in the league
            // $table->integer('league_id')->references('league_id')->on('leagues')->onDelete('cascade');
            // $table->integer('league_id')->references('league_id')->on('leagues')->onDelete('set null');
            $table->string('team_name');
            // $table->bigInteger('team_address_id')->references('address_id')->on('addresses');
            $table->bigInteger('team_address_id')->unsigned()->index()->nullable();
            $table->bigInteger('team_responsible_id')->unsigned()->index()->nullable();
            $table->string('team_phone');
            $table->string('team_email');
            $table->string('team_img_name');

            $table->timestamps();
            // Foreign keys:
            $table->foreign('league_id')->references('league_id')->on('leagues');
            $table->foreign('team_address_id')->references('address_id')->on('addresses');
            $table->foreign('team_responsible_id')->references('person_id')->on('person');
        });

        // Matches Table:
        /*
            - Matches Table:
            Match_ID -> INT UNIQUE AUTOINCREMENT
            Match_Date -> DateStamp
            Match_Host_Team_ID ->
            Match_Guest_Team_ID ->
            Match_Address ->
            League_Type -> INT
            Match_Results_ID -> Results For The match
            * */
        Schema::create('matches', function (Blueprint $table) {
            $table->id('match_id');
            $table->timestamp('match_date');
            // $table->bigInteger('host_team_id')->references('team_id')->on('teams');
            // $table->bigInteger('guest_team_id')->references('team_id')->on('teams');
            // $table->bigInteger('match_address_id')->references('address_id')->on('addresses');
            // $table->bigInteger('league_type')->references('league_type_id')->on('league_type');

            $table->bigInteger('host_team_id')->unsigned()->index()->nullable();
            $table->bigInteger('guest_team_id')->unsigned()->index()->nullable();
            $table->bigInteger('match_address_id')->unsigned()->index()->nullable();

            $table->bigInteger('league_id')->unsigned()->index()->nullable();
            $table->bigInteger('match_number')->unsigned();
            $table->bigInteger('week_number')->unsigned()->nullable();

            $table->string('match_status')->nullable();

            $table->bigInteger('host_points')->unsigned()->nullable();
            $table->bigInteger('guest_points')->unsigned()->nullable();

            $table->bigInteger('league_type')->unsigned()->index()->nullable();
            $table->bigInteger('results_id')->unsigned()->index()->nullable();

            $table->timestamps();
            // Foreign Keys
            $table->foreign('host_team_id')->references('team_id')->on('teams')->onDelete('cascade');
            $table->foreign('guest_team_id')->references('team_id')->on('teams')->onDelete('cascade');
            $table->foreign('match_address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->foreign('league_type')->references('league_type_id')->on('league_types')->onDelete('cascade');
            $table->foreign('league_id')->references('league_id')->on('leagues')->onDelete('cascade');

        });

        /***************************************************************/
        //	INSERT DATA IN LEAGUES TYPES:
        /***************************************************************/

        /*
        //Beach volleyball
        $client = new Client($post['league_type']);
        $client->league_type = "Beach Volleyball";
        $client->description = "Beach Volleyball League";
        $client->save();

        //Simple 3vs3 Basketball
        $client = new Client($post['league_type']);
        $client->league_type = "Simple 3vs3 Basketball";
        $client->description = "Simple 3vs3 Basketball";
        $client->save();
        */
        DB::table('league_types')->insert(
            [
                'league_type' => 'Beach Volleyball',
                'description' => 'Beach Volleyball League',
            ]
        );

        DB::table('league_types')->insert(
            [
                'league_type' => 'Basketball 3vs3 Simple',
                'description' => 'Basketball 3vs3 Simple',
            ]
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
