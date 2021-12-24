/**
 * External Dependencies
 */
const path = require( 'path' );

/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
	...defaultConfig,
	...{
		entry: {
			'table-block': path.resolve(
				process.cwd(),
				'blocks/table-block',
				'table-block.js'
			),
		},
		output: {
			filename: '[name].js',
			path: path.resolve( process.cwd(), 'assets/build' ),
		},
	},
};
