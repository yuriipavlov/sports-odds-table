<?php

use SportsOddsTable\Helper\View;

$data = $data ?? [];

?>

<div class="sports-odds-table">
	
	<div class="sot-filter">
		<?php
		// Show filter template
		View::load( '/templates/odds-table-filter', $data['sports_list'] );
		?>
	</div>
	
	<?php if ( ! empty( $data ) ) { ?>
		<div class="sot-events">
			
			<?php foreach ( $data['odds_list'] as $event ) {
				// Show event template
				View::load( '/templates/odds-table-event', $event );
			} ?>
		
		</div>
	<?php } else { ?>
		<div class="sot-events sot-empty">
			<p><?php _e( 'There is no Odds data', 'sports-odds-table' ); ?></p>
		</div>
	<?php } ?>
</div>
