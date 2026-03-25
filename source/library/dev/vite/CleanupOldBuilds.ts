import { Plugin } from 'vite';
import { promises as fs } from 'fs';
import * as path from 'path';

interface ManifestEntry {
    file: string;
    src?: string;
    isEntry?: boolean;
    css?: string[];
    assets?: string[];
    imports?: string[];
}

interface Manifest {
    [key: string]: ManifestEntry;
}

/**
 * Plugin to clean up old build files while keeping current ones.
 * Only removes files with old hashes, preventing full rebuilds.
 */
export default function CleanupOldBuilds(): Plugin {
    let outDir = '';

    return {
        name: 'vite-plugin-cleanup-old-builds',

        configResolved(config) {
            outDir = config.build.outDir;
        },

        async writeBundle() {
            if (!outDir) return;

            try {
                const buildDir = path.resolve(process.cwd(), outDir);
                const manifestPath = path.join(buildDir, 'manifest.json');

                // Read the new manifest to know which files are current
                let currentFiles = new Set<string>();
                try {
                    const manifestContent = await fs.readFile(manifestPath, 'utf-8');
                    const manifest: Manifest = JSON.parse(manifestContent);

                    // Collect all current files from manifest
                    currentFiles.add('manifest.json');
                    for (const entry of Object.values(manifest)) {
                        if (entry.file) currentFiles.add(entry.file);
                        if (entry.css) entry.css.forEach(f => currentFiles.add(f));
                        if (entry.assets) entry.assets.forEach(f => currentFiles.add(f));
                    }
                } catch (err) {
                    // If manifest doesn't exist yet, skip cleanup
                    return;
                }

                // Read all files in build directory
                const allFiles = await fs.readdir(buildDir);

                // Remove files that are not in the current manifest
                for (const file of allFiles) {
                    if (!currentFiles.has(file)) {
                        const filePath = path.join(buildDir, file);
                        const stats = await fs.stat(filePath);

                        // Only remove files, not directories
                        if (stats.isFile()) {
                            await fs.unlink(filePath);
                            console.log(`🧹 Removed old build file: ${file}`);
                        }
                    }
                }
            } catch (err) {
                // Silently fail - cleanup is not critical
                console.warn('Could not clean up old builds:', err);
            }
        }
    };
}
