import { defineConfig } from 'vite'
import path from 'path'
import fullReload from 'vite-plugin-full-reload'

export default defineConfig({
  root: 'assets',

  server: {
    host: true,
    hmr: {
      host: '10.92.234.146', // 🔴 MUST match the IP you use in functions.php
      protocol: 'ws',
      port: 5173,
    },
  },

  plugins: [
    fullReload([
      './**/*.php',
    ])
  ],

  build: {
    outDir: path.resolve(__dirname, 'build'),
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'assets/js/main.js'),
        style: path.resolve(__dirname, 'assets/css/style.css'),
      },
      output: {
        entryFileNames: '[name].min.js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
})
