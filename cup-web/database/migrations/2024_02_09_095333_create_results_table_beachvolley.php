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

        /*Persuatoy Fields for results_beachvolley
         *
         * SOURCE -> rfevb.com/lnvp-masculina-clasificacion
         *
         * 1. Result_id
         * 2. League_id
         * 3. Match_id
         * 4. Host_team_id
         * 5. Guest_team_id
         * RESULTS:
         * 6. matches_won
         * 7. matches_lost
         * 8. sets_won
         * 9. sets_lost
         * 10. points_won
         * 11. points_lost
         * RESULTS FOR CLASSIFICATION
         * 12. host_g3
         * 13. host_g2
         * 14. host_p1
         * 15. host_p0
         * 16. host_pg
         * 17. host_sf
         * 18. host_sc
         * 19. host_pf
         * 20. host_pc
         * 21. host_sanc
         *
         * 22. guest_g3
         * 23. guest_g2
         * 24. guest_p1
         * 25. guest_p0
         * 26. guest_pg
         * 27. guest_sf
         * 28. guest_sc
         * 29. guest_pf
         * 30. guest_pc

        */

        Schema::create('results_beachvolley', function (Blueprint $table) {
            $table->id('result_id');
            $table->timestamps();

            $table->bigInteger('league_id')->unsigned()->index();
            $table->bigInteger('match_id')->unsigned()->index();
            $table->bigInteger('host_team_id')->unsigned()->index();
            $table->bigInteger('guest_team_id')->unsigned()->index();

            $table->bigInteger('matches_won')->nullable();
            $table->bigInteger('matches_lost')->nullable();
            $table->bigInteger('sets_won')->nullable();
            $table->bigInteger('sets_lost')->nullable();
            $table->bigInteger('points_won')->nullable();
            $table->bigInteger('points_lost')->nullable();
            /* RESULTS FOR CLASSIFICATION */
            $table->bigInteger('host_g3')->nullable();
            $table->bigInteger('host_g2')->nullable();
            $table->bigInteger('host_p1')->nullable();
            $table->bigInteger('host_p0')->nullable();
            $table->bigInteger('host_pg')->nullable();
            $table->bigInteger('host_sf')->nullable();
            $table->bigInteger('host_sc')->nullable();
            $table->bigInteger('host_pf')->nullable();
            $table->bigInteger('host_pc')->nullable();
            $table->bigInteger('host_sanc')->nullable();

            $table->bigInteger('guest_g3')->nullable();
            $table->bigInteger('guest_g2')->nullable();
            $table->bigInteger('guest_p1')->nullable();
            $table->bigInteger('guest_p0')->nullable();
            $table->bigInteger('guest_pg')->nullable();
            $table->bigInteger('guest_sf')->nullable();
            $table->bigInteger('guest_sc')->nullable();
            $table->bigInteger('guest_pf')->nullable();
            $table->bigInteger('guest_pc')->nullable();
            $table->bigInteger('guest_sanc')->nullable();

            $table->foreign('league_id')->references('league_id')->on('leagues')->onDelete('cascade');
            $table->foreign('match_id')->references('match_id')->on('matches')->onDelete('cascade');
            $table->foreign('host_team_id')->references('team_id')->on('teams')->onDelete('cascade');
            $table->foreign('guest_team_id')->references('team_id')->on('teams')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('results_table_beachvolley');
    }
};
