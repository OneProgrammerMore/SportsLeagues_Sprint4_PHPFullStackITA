import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import glob from 'fast-glob';
import FastGlob from 'fast-glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [

                //...glob.sync('resources/js/**/*.js'),
                //...glob.sync('resources/css/**/*.css'),
                'resources/css/app.css',
                'resources/js/app.js',
                
                'resources/css/iconStyles.css',

                'resources/css/comp_formResults.css',
                'resources/css/comp_legends.css',
                'resources/css/legal.css', 
                //'resources/img/cupLogo.png',
                ...glob.sync('resources/img/**/*'),
            ],
            refresh: true,
        }),
    ],
    build: {
        assetsInlineLimit: 0, // Prevent fonts from being inlined
        assetsDir: 'assets',
        outDir: 'public/build',
    },
    server: {
		host: '192.168.1.38',  // This allows external access to the Vite server
		port: 5173,        // The default port Vite uses
		hmr: {
		  host: '192.168.1.38',  // This ensures that HMR works correctly in Docker/Vagrant
		},
		watch: {
            ignored: ['**/public/storage/public/**','**/storage/app/public/**'], // Ignore file changes in these paths
		},
		base: '/build/', // or adjust this path if necessary based on your setup
	},
});
