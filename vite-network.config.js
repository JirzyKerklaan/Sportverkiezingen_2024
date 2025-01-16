import laravel from 'laravel-vite-plugin'
import VitePluginBrowserSync from 'vite-plugin-browser-sync'
import {defineConfig, loadEnv} from 'vite'

/*
|--------------------------------------------------------------------------
| vite-network config
|--------------------------------------------------------------------------
*/
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
            VitePluginBrowserSync({
                bs: {
                  proxy: env.APP_URL,
                  notify: false,
                  ws: true,
                }
              }),
        ],
        server: {
            hmr: {
                host: env.APP_IP,
            },
        }
    }
});


