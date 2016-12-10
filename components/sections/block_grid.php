<?php
/**
 * Block Grid
 *
 * The block grid is a custom flexible page element that we use to
 * build and construct beautiful-looking pages.
 *
 * It relies on a number of ACF fields for the configurable settings,
 * which can be included on virtually any page templates via the ACF options.
 *
 * @package BernskioldMedia\ClientName\Theme
 */

// Create a new block grid instance.
$block_grid = new BernskioldMedia\ClientName\Theme\Block_Grid();

// Set up the block grid!
$block_grid->prepare();

// Check if the have the blocks.
if ( have_rows( 'blocks' ) ) : ?>

	<div class="<?php $block_grid->the_section_classes(); ?>" <?php $block_grid->the_section_id(); ?>>

	<div class="block-grid-inner">

			<?php while ( have_rows( 'blocks' ) ) :
			the_row(); ?>

			<<?php $block_grid->the_block_tag( 'opening' ); ?> class="<?php $block_grid->the_block_classes(); ?>" <?php $block_grid->the_block_image(); ?>>

			<?php if ( ! $block_grid->is_image_block() ) : ?>

				<?php
				$block_title    = get_sub_field( 'block_title' );
				$block_content  = get_sub_field( 'block_content' );
				$block_has_cta  = get_sub_field( 'block_has_cta' );
				$block_has_icon = get_sub_field( 'block_has_icon' );
				?>

				<?php if ( $block_has_icon ) : ?>

					<?php
					$icon = get_sub_field( 'block_icon' );
					?>

					<div class="block-icon">
						<img src="<?php echo esc_url( $icon['sizes']['large'] ); ?>" alt="">
					</div>

				<?php endif; ?>

				<?php if ( ! empty( $block_title ) ) : ?>

					<h2 class="block-title">
						<?php echo esc_html( $block_title ); ?>
					</h2>

				<?php endif; ?>

				<div class="block-content">
					<?php echo $block_content; ?>
				</div>

				<?php if ( $block_has_cta ) : ?>

					<?php
					$cta_title = get_sub_field( 'block_cta_title' );
					$cta_link  = get_sub_field( 'block_cta_link' );
					?>

					<div class="block-cta">
						<a href="<?php echo esc_url( $cta_link ); ?>" class="hollow button"><?php echo esc_html( $cta_title ); ?></a>
					</div>

				<?php endif; ?>

			<?php else : ?>

				<?php
				$block_has_title = get_sub_field( 'block_has_title' );

				if ( $block_has_title ) : ?>

					<?php $block_title = get_sub_field( 'block_title' ); ?>

					<div class="block-image-title">
						<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
					</div>

				<?php endif; ?>

			<?php endif; ?>

		</<?php $block_grid->the_block_tag( 'closing' ); ?>>

		<?php endwhile; ?>

	</div>

	</div>

<?php endif; ?>
