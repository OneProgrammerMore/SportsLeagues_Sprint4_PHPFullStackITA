import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/css/comp_formResults.css',
                'resources/css/comp_legends.css',
                'resources/css/legal.css',  
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
		host: '192.168.1.37',  // This allows external access to the Vite server
		port: 5173,        // The default port Vite uses
		hmr: {
		  host: '192.168.1.37',  // This ensures that HMR works correctly in Docker/Vagrant
		},
		watch: {
            ignored: ['**/public/storage/public/**','**/storage/app/public/**'], // Ignore file changes in these paths
		},
		base: '/build/', // or adjust this path if necessary based on your setup
	},
});
