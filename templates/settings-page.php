<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="wrap">
	
	<?php do_action( 'sports-odds-table/before_settings_page' ); ?>
	
	<h2><?php esc_html_e( 'Sports Odds Table settings', 'sports-odds-table' ); ?></h2>
	
	<form method="post" action="options.php" id="sot_plugin_settings_form">
		<?php
		do_action( 'sports-odds-table/settings_form_top' );
		
		settings_fields( 'sot_settings__main_group' );
		do_settings_sections( 'sot_settings' );
		submit_button();
		
		do_action( 'sports-odds-table/settings_form_bottom' );
		?>
	</form>
	
	<?php do_action( 'sports-odds-table/after_settings_page' ); ?>

</div>
