import { Plugin } from 'vite';
import { readFileSync, writeFileSync, existsSync } from 'fs';
import * as path from 'path';

interface SizeEntry {
	label: string;
	values: string[];
}

interface UtilityEntry {
	property: string;
	default?: string[];
	[breakpoint: string]: string | string[] | Record<string, string> | undefined;
}

interface SizesConfig {
	breakpoints: string[];
	sizes: Record<string, SizeEntry>;
	utilities: Record<string, UtilityEntry>;
}

const OUTPUT_DIR = 'source/styles/library';

function generateSizeVariables(config: SizesConfig): string {
	const entries = Object.entries(config.sizes)
		.map(([key, { values }]) => `\t\t'${key}': (${values.join(', ')})`)
		.join(',\n');

	return `// Auto-generated from config/sizes.json — do not edit manually\n@include add-size-variables((\n${entries}\n));\n`;
}

function generateUtilityBlock(key: string, util: UtilityEntry): string {
	const sizeMaps: string[] = [];

	// Default sizes — reference --size-X variables
	if (util.default?.length) {
		const defaultEntries = util.default
			.map(sizeKey => `\t\t\t'${sizeKey}': var(--size-${sizeKey})`)
			.join(',\n');
		sizeMaps.push(`\t\t'default': (\n${defaultEntries}\n\t\t)`);
	}

	// Named breakpoint overrides (mobile, tablet, etc.) — raw values
	for (const [bp, entries] of Object.entries(util)) {
		if (bp === 'property' || bp === 'default') continue;
		if (typeof entries !== 'object' || Array.isArray(entries)) continue;

		const bpEntries = Object.entries(entries)
			.map(([k, v]) => `\t\t\t'${k}': ${v}`)
			.join(',\n');
		sizeMaps.push(`\t\t'${bp}': (\n${bpEntries}\n\t\t)`);
	}

	return `@include add-utility-classes(\n\t'${key}',\n\t'${util.property}',\n\t(\n${sizeMaps.join(',\n')}\n\t)\n);`;
}

function generateUtilityFile(config: SizesConfig, utilityKeys: string[]): string {
	const blocks = utilityKeys
		.filter(key => config.utilities[key])
		.map(key => generateUtilityBlock(key, config.utilities[key]));

	return `// Auto-generated from config/sizes.json — do not edit manually\n${blocks.join('\n\n')}\n`;
}

function generate(themeRoot: string): void {
	const configPath = path.resolve(themeRoot, 'config/sizes.json');
	const outDir = path.resolve(themeRoot, OUTPUT_DIR);
	const config: SizesConfig = JSON.parse(readFileSync(configPath, 'utf-8'));

	const files: [string, string][] = [
		['_size-variables.generated.scss', generateSizeVariables(config)],
		['_margins.generated.scss', generateUtilityFile(config, ['mb', 'mt'])],
		['_paddings.generated.scss', generateUtilityFile(config, ['pl', 'pr'])],
	];

	for (const [filename, content] of files) {
		const filePath = path.resolve(outDir, filename);
		const existing = existsSync(filePath) ? readFileSync(filePath, 'utf-8') : '';

		if (existing !== content) {
			writeFileSync(filePath, content, 'utf-8');
			console.log(`  ✓ Generated ${filename}`);
		}
	}
}

export default function GenerateSizesScss(): Plugin {
	let themeRoot = '';

	return {
		name: 'vite-plugin-generate-sizes-scss',

		configResolved(config) {
			// source/ is the Vite root, theme root is one level up
			themeRoot = path.resolve(config.root, '..');
		},

		buildStart() {
			// Watch sizes.json so `vite build --watch` triggers rebuild on change
			const configPath = path.resolve(themeRoot, 'config/sizes.json');
			this.addWatchFile(configPath);

			generate(themeRoot);
		},
	};
}
