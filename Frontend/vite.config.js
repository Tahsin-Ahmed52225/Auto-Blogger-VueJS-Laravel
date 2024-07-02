import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  server: {    // <-- this object is added
    watch: {
      usePolling: true,
    },
  },
  plugins: [
    vue(),
  ],
  resolve: {
    alias: {
       '@': require('path').resolve(__dirname, 'src')
    }
  }
})
