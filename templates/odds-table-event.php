<?php

$data = $data ?? [];

?>
<div class="sot-event">
	<div class="sot-inner">
		<div class="sot-info">
			<div class="sot-time">
				<span><?php echo date( 'M dS', $data['commence_time'] ); ?></span>
				<span><?php echo date( 'H:i', $data['commence_time'] ); ?></span>
			</div>
			<div class="sot-teams">
				
				
				<div>
					<?php echo $data['teams'][0];
					if ( $data['teams'][0] === $data['home_team'] ) {
						echo 'home';
					} ?>
				</div>
				<div>
					<span class="sot-vs"> vs </span>
					<?php echo $data['teams'][1];
					if ( $data['teams'][1] === $data['home_team'] ) {
						echo 'home';
					} ?>
				</div>
			</div>
		</div>
		
		<div class="sot-sites">
			<?php foreach ( $data['sites'] as $site ) { ?>
				<div class="sot-site">
					<div class="sot-site-title"><?php echo $site['site_nice']; ?></div>
					<div class="sot-odds">
						<?php foreach ( $site['odds'] as $odds ) { ?>
							<?php foreach ( $odds as $key => $odd ) { ?>
								<div class="sot-odd">
									<span><?php echo $key + 1; ?></span>
									<span><?php echo $odd; ?></span>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
