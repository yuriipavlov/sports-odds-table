<?php

use SportsOddsTable\Helper\View;

$data = $data ?? [];

//var_dump($data);
?>

<div class="sports-odds-table">
	<div class="sot-title">
	
	</div>
	
	<?php
		// Show filter template
		View::load('/templates/odds-table-filter', ['data'] );
	?>

	<div class="sot-events">
		
		
		<?php
		// Show event template
		View::load('/templates/odds-table-event', ['data'] );
		?>
		
	</div>
</div>
