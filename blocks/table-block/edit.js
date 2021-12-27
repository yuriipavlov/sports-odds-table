/**
 * Import block editor and server side render component
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-server-side-render/
 */

import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * This represents what the editor will render when the block is used.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			<ServerSideRender
				block="sports-odds-table/table-block"
			/>
		</p>
	);
}
