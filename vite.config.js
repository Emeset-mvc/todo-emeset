import { defineConfig } from 'vite';
import { resolve } from 'node:path';

export default defineConfig({
  publicDir: false,
  build: {
    outDir: 'public',
    emptyOutDir: false,
    cssCodeSplit: false,
    rollupOptions: {
      input: resolve(process.cwd(), 'App/js/index.js'),
      output: {
        entryFileNames: 'js/bundle.js',
        assetFileNames: (asset) => asset.name?.endsWith('.css')
          ? 'main.css'
          : 'assets/[name]-[hash][extname]',
      },
    },
  },
});
