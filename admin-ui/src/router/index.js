import { createRouter, createWebHashHistory } from 'vue-router'

import Home from '../views/Home.vue'
import Orphans from '../views/Orphans.vue'
import ACF from '../views/ACF.vue'

const routes = [
	{
		path: '/',
		name: 'Home',
		component: Home
	},
	{
		path: '/acf',
		name: 'ACF',
		component: ACF
	},
	{
		path: '/orphans',
		name: 'Orphans Meta Data',
		component: Orphans
	},
	{
		path: '/about',
		name: 'About',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
	}
]

const router = createRouter({
	history: createWebHashHistory(),
	routes
})

export default router
