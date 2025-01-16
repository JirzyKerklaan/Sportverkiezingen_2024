import laravel from 'laravel-vite-plugin'
import { defineConfig, loadEnv } from 'vite'

export default defineConfig(({ command, mode }) => {
    const env = loadEnv(mode, process.cwd(), '')
    return {
        plugins: [
            laravel({
                input: [
                    'resources/sass/styles.scss',
                    'resources/ts/app.ts',
                ],
                refresh: true,
            }),
        ],
        server: {
            open: env.APP_URL
        }
    }
});
