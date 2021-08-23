<?php

$opemia_sponsers	= get_theme_mod( 'opemia_sponsers' );
?>

<section class="partners-sec">
	<div class="container">
		<div class="pt-logos">
			<?php
			if ( ! empty( $opemia_sponsers ) ) {
				$opemia_sponsers = json_decode( $opemia_sponsers );
				foreach ( $opemia_sponsers as $sponser ) {
					$sponser_link = ! empty( $sponser->link ) ? $sponser->link : '';
					$image = ! empty( $sponser->image_url ) ? $sponser->image_url : '';
					?>
						<div class="pt-logo">
							<?php if ( ! empty( $image ) ) : ?>
								<a href="<?php echo esc_url($sponser_link); ?>">
									<img src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
								</a>
							<?php endif; ?>
						</div><!--pt-logo end-->
					<?php
				}
			}
			?>
		</div>
	</div>
</section>