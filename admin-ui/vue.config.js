const ManifestPlugin = require('webpack-manifest-plugin')

module.exports = {
	lintOnSave: true,
	configureWebpack: {
		plugins: [
			new ManifestPlugin()
		]
	},
	chainWebpack: config => {
		config
			.plugin('html')
			.tap(args => {
				args[0].inject = false
				return args
			})
	}
}
