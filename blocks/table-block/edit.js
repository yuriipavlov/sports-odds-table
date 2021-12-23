/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';


import { useBlockProps } from '@wordpress/block-editor';


/**
 * This represents what the editor will render when the block is used.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			{ __( 'Sports Odds Table', 'sports-odds-table' ) }
		</p>
	);
}
