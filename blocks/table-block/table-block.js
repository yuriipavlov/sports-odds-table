/**
 * Registers a new block to show sports odds data from a public API in a simple table,
 * with a few filters to allow easier odds preview.
 */
import { registerBlockType } from '@wordpress/blocks';

import './table-block.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
//import save from './save';

/**
 * Registers the block
 */
registerBlockType( 'sports-odds-table/table-block', {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	//save,
	save: () => { return null }
} );
