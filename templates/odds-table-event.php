<?php

$data = $data ?? [];

?>
<div class="sot-event">
	<div class="sot-info">
		<strong><?php echo $data['teams'][0]; ?></strong>
		<?php if ( $data['teams'][0] === $data['home_team'] ) {
			echo ' home img';
		} ?>
		<span>vs</span>
		<strong><?php echo $data['teams'][1]; ?></strong>
		<?php if ( $data['teams'][1] === $data['home_team'] ) {
			echo ' home img';
		} ?>
		<div class="sot-date"><?php echo date( 'M dS H:i', $data['commence_time'] ); ?></div>
	</div>
	
	<div class="sot-sites">
		<?php if ( ! empty( $data['sites'] ) ) { ?>
			<ul class="sot-sites-list">
				<?php foreach ( $data['sites'] as $site ) { ?>
					<li>
						<strong class="sot-site-title"><?php echo $site['site_nice']; ?></strong>
						<?php if ( ! empty( $site['odds'] ) ) { ?>
							<div class="sot-odds">
								<?php foreach ( reset( $site['odds'] ) as $key => $odd ) { ?>
									<div class="sot-odd">
										<span><?php echo $key + 1; ?></span>
										<strong><?php echo $odd; ?></strong>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
</div>