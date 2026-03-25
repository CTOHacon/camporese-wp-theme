import { defineConfig } from 'vite';
import sassGlobImports from 'vite-plugin-sass-glob-import';
import ViteRestart from './library/dev/vite/ViteRestart';
import viteScssGlobUsePlugin from './library/dev/vite/viteScssGlobUsePlugin';
import postCssSortMediaQueries from 'postcss-sort-media-queries';
import postcssCombineMediaQuery from 'postcss-combine-media-query';
import * as path from 'path';
import CleanupOldBuilds from './library/dev/vite/CleanupOldBuilds';
import GenerateSizesScss from './library/dev/vite/GenerateSizesScss';

export default defineConfig({
	resolve: {
		alias: {
			'~': path.resolve(__dirname, './'),
			'~theme': path.resolve(__dirname, '../')
		},
	},
	base: './',
	build: {
		outDir: 'build',
		assetsDir: './',
		manifest: true,
		emptyOutDir: false,
		rollupOptions: {
			input:
				[
					'scripts/asset.app.ts',
					'styles/asset.app.scss',
					'styles/asset.editor.scss',
				],
			output: {
				entryFileNames: `[name]-[hash].js`,
				chunkFileNames: `[name]-[hash].js`,
				assetFileNames: `[name]-[hash].[ext]`
			}
		},
		minify: 'terser'
	},
	plugins: [
		GenerateSizesScss(),
		CleanupOldBuilds(),
		sassGlobImports(),
		viteScssGlobUsePlugin(),
		ViteRestart({
			restart: ['./styles/**/*', './components/**/*', '../**/*.jsx']
		})
	],
	css: {
		preprocessorOptions: {
			scss: {
				additionalData: `@use '~/styles/library-provider' as *;`,
				// Ignore the warnings from deprecated SASS features
				silenceDeprecations: ['legacy-js-api', 'mixed-decls', 'import']
			},
			postcss: {
				plugins: [
					postCssSortMediaQueries({ sort: 'desktop-first' }),
					postcssCombineMediaQuery()
				]
			}
		}
	}
});
