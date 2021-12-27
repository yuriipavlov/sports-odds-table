<?php
$data = $data ?? [];
?>

<div class="sot-filter-item">
	<div class="sot-filter-inner">
		<div class="sot-filter-label"><?php _e( 'Sport', 'sports-odds-table' ); ?></div>
		<div class="sot-filter-drop">
			<div class="sot-filter-drop-custom">
				<select data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="v3">American Football</option>
					<option value="v3">Soccer</option>
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
				<select data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="v3">United Kingdom</option>
					<option value="v3">United States</option>
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
				<select data-jcf='{"wrapNative": false,"fakeDropInBody":false, "wrapNativeOnMobile": false}'>
					<option value="v3">Head to Head</option>
					<option value="v3">Spreads</option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="sot-filter-item sot-filter-button">
	<button class="sot-filter-btn sot-btn-block"><?php _e( 'Filter', 'sports-odds-table' ); ?></button>
</div>

