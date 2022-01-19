import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { resolve } from 'path'


// https://vitejs.dev/config/
export default defineConfig({
	build: {
		manifest: true,
		rollupOptions: {
			input: "./src/main.js",
		},
	},
	resolve: {
		alias: {
			'@': resolve(__dirname, 'src'),
		},
	},
	plugins: [vue()],
});
