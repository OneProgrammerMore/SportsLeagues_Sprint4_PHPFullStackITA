import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                
                'resources/css/comp_footer.css',
                'resources/css/forms_design.css',
                'resources/css/comp_formResults.css',
                'resources/css/comp_legends.css',
                'resources/css/comp_players.css',
                'resources/css/players.css',
                
                'resources/css/comp_ranking.css',
                'resources/css/comp_results_table.css',
                'resources/css/forms_design.css',
                'resources/css/legal.css',
                
               
            ],
            refresh: true,
        }),
    ],
});
