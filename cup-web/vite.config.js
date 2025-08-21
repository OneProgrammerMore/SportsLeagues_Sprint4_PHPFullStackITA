import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import glob from 'fast-glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //...glob.sync('resources/js/**/*.js'),
                //...glob.sync('resources/css/**/*.css'),
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/iconStyles.css',
                'resources/js/menu-responsive.js',
                'resources/js/index_matches.js',
                ...glob.sync('resources/img/**/*'),
            ],
            refresh: true,
        }),
    ],
    build: {
        clean: true,
        assetsInlineLimit: 0, // Prevent fonts from being inlined
        assetsDir: 'assets',
        outDir: 'public/build',
    },
    server: {
		host: '192.168.1.130',  // This allows external access to the Vite server
		port: 5173,        // The default port Vite uses
        //host: 'localhost',
        //port: 81,        // The default port Vite uses
		hmr: {
            host: '192.168.1.130',  // This ensures that HMR works correctly in Docker/Vagrant
            port: 5173,
            //host: 'localhost',  // This ensures that HMR works correctly in Docker/Vagrant
            //port: 81,
		},
		watch: {
            ignored: ['**/public/storage/public/**','**/storage/app/public/**'], // Ignore file changes in these paths
            usePolling: true,
		},
		base: '/build/', // or adjust this path if necessary based on your setup
        cors: true,
	},
});
