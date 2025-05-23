import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament.css',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'app/Filament/**',
            ],
        }),
    ],
    css: {
        preprocessorOptions: {
            postcss: {
                plugins: (loader) => {
                    // Déterminer quelle configuration utiliser en fonction du fichier CSS traité
                    const isFilamentCSS = loader.resourcePath.includes('filament.css');
                    
                    if (isFilamentCSS) {
                        // Configuration spécifique pour Filament
                        return [
                            require('tailwindcss/nesting'),
                            require('tailwindcss')({ config: './tailwind.filament.config.js' }),
                            require('autoprefixer'),
                        ];
                    } else {
                        // Configuration pour le front-end
                        return [
                            require('tailwindcss/nesting'),
                            require('tailwindcss')({ config: './tailwind.config.js' }),
                            require('autoprefixer'),
                        ];
                    }
                },
            },
        },
    },
    optimizeDeps: {
        include: ['@tailwindcss/forms', '@tailwindcss/typography'],
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
