<?php

$data = $data ?? [];

?>

<div class="sot-filter-item">
	<div class="sot-filter-inner">
		<div class="sot-filter-label"><?php _e( 'Sport', 'sports-odds-table' ); ?></div>
		<div class="sot-filter-drop">
			<div class="sot-filter-drop-custom">
				<select name="sport" data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="upcoming"><?php _e( 'Upcoming', 'sports-odds-table' ); ?></option>
					<?php foreach ( $data as $sport ) { ?>
						<option value="<?php echo $sport['key'] ?>"><?php echo $sport['title'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="sot-filter-item">
	<div class="sot-filter-inner">
		<div class="sot-filter-label"><?php _e( 'Region', 'sports-odds-table' ); ?></div>
		<div class="sot-filter-drop">
			<div class="sot-filter-drop-custom">
				<select name="region" data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="uk"><?php _e( 'United Kingdom', 'sports-odds-table' ); ?></option>
					<option value="us"><?php _e( 'United States', 'sports-odds-table' ); ?></option>
					<option value="eu"><?php _e( 'Europe', 'sports-odds-table' ); ?></option>
					<option value="au"><?php _e( 'Australia', 'sports-odds-table' ); ?></option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="sot-filter-item">
	<div class="sot-filter-inner">
		<div class="sot-filter-label"><?php _e( 'Market', 'sports-odds-table' ); ?></div>
		<div class="sot-filter-drop">
			<div class="sot-filter-drop-custom">
				<select name="market" data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="h2h"><?php _e( 'Head to Head', 'sports-odds-table' ); ?></option>
					<option value="spreads"><?php _e( 'Spreads', 'sports-odds-table' ); ?></option>
					<option value="totals"><?php _e( 'Totals', 'sports-odds-table' ); ?></option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="sot-filter-item sot-filter-button">
	<button class="sot-filter-btn sot-btn-block sot-filter-btn__js"><?php _e( 'Filter', 'sports-odds-table' ); ?></button>
</div>

