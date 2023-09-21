import { sveltekit } from '@sveltejs/kit/vite';
import { defineConfig } from 'vitest/config';

export default defineConfig({
	plugins: [sveltekit()],
	test: {
		include: ['src/**/*.{test,spec}.{js,ts}']
	},
    server: {
        watch: {
            usePolling: true,
        },
        hmr: {
            port: 24012,
        }
    },
    resolve: {
        alias: {
            '$': '/src',
            '$components': '/src/lib/components',
            '$styles': '/static/styles',
        }
    }
});
