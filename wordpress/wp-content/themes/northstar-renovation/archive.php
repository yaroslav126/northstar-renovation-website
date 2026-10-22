<?php
/**
 * Archive template for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Archive Category', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-2);">
			<?php the_archive_title(); ?>
		</h1>
		<?php the_archive_description( '<div style="color: var(--ns-color-stone); font-size: 1.1rem;">', '</div>' ); ?>
	</div>
</section>

<section class="ns-section">
	<div class="ns-container">
		<?php if ( have_posts() ) : ?>
			<div class="ns-grid-2">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article class="ns-project-card">
						<div class="ns-project-card-media">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'ns-card' ); ?>
							<?php else : ?>
								<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/blog-1.svg' ); ?>" alt="<?php the_title_attribute(); ?>">
							<?php endif; ?>
						</div>
						<div class="ns-project-card-body">
							<span style="font-size: 0.8125rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-2); display: block;">
								<?php echo esc_html( get_the_date() ); ?>
							</span>
							<h2 style="font-size: 1.4rem; margin-bottom: var(--ns-space-3);">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p style="font-size: 0.9375rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-4); flex-grow: 1;">
								<?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
							</p>
							<a href="<?php the_permalink(); ?>" class="ns-btn ns-btn-secondary" style="align-self: flex-start; padding: 0.4rem 0.85rem; font-size: 0.8125rem;">
								<?php esc_html_e( 'View Details', 'northstar-renovation' ); ?> &rarr;
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div style="margin-top: var(--ns-space-8);">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<div class="ns-container-narrow text-center" style="padding: var(--ns-space-12) 0;">
				<h2><?php esc_html_e( 'No Items Found', 'northstar-renovation' ); ?></h2>
				<p style="color: var(--ns-color-muted);"><?php esc_html_e( 'There are currently no published entries in this archive section.', 'northstar-renovation' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-btn ns-btn-primary" style="margin-top: var(--ns-space-4);">
					<?php esc_html_e( 'Return to Homepage', 'northstar-renovation' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
