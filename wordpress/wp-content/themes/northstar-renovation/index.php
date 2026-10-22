<?php
/**
 * Main blog listing and archives template.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$demo_posts = function_exists( 'northstar_get_demo_posts' ) ? northstar_get_demo_posts() : array();
?>

<!-- Blog Index Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Architectural Journal', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Renovation Insights & Material Curation', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Expert guides on architectural kitchen planning, structural considerations, natural stone selection, and living on-site during construction.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>

<!-- Blog Post Grid -->
<section class="ns-section" aria-label="<?php esc_attr_e( 'Articles and Insights', 'northstar-renovation' ); ?>">
	<div class="ns-container">
		<div class="ns-grid-2">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article class="ns-project-card" style="margin-bottom: var(--ns-space-4);">
						<div class="ns-project-card-media">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'ns-card' ); ?>
							<?php else : ?>
								<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/blog-1.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
							<?php endif; ?>
							<span class="ns-project-badge"><?php the_category( ', ' ); ?></span>
						</div>
						<div class="ns-project-card-body">
							<div style="font-size: 0.8125rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-2);">
								<?php echo esc_html( get_the_date() ); ?> &bull; <?php the_author(); ?>
							</div>
							<h2 style="font-size: 1.45rem; margin-bottom: var(--ns-space-3);">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p style="font-size: 0.9375rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-4); flex-grow: 1;">
								<?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
							</p>
							<a href="<?php the_permalink(); ?>" class="ns-btn ns-btn-secondary" style="align-self: flex-start; padding: 0.4rem 0.85rem; font-size: 0.8125rem;">
								<?php esc_html_e( 'Read Article', 'northstar-renovation' ); ?> &rarr;
							</a>
						</div>
					</article>
					<?php
				endwhile;

				the_posts_pagination(
					array(
						'prev_text' => '&larr; ' . __( 'Previous', 'northstar-renovation' ),
						'next_text' => __( 'Next', 'northstar-renovation' ) . ' &rarr;',
					)
				);
			else :
				// Fallback to high-quality demonstration articles
				foreach ( $demo_posts as $post_item ) :
					?>
					<article class="ns-project-card" style="margin-bottom: var(--ns-space-4);">
						<div class="ns-project-card-media">
							<img src="<?php echo esc_url( $post_item['image'] ); ?>" alt="<?php echo esc_attr( $post_item['title'] ); ?>" loading="lazy" width="800" height="500">
							<span class="ns-project-badge"><?php echo esc_html( $post_item['category'] ); ?></span>
						</div>
						<div class="ns-project-card-body">
							<div style="font-size: 0.8125rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-2);">
								<?php echo esc_html( $post_item['date'] ); ?> &bull; <?php echo esc_html( $post_item['author'] ); ?> &bull; <?php echo esc_html( $post_item['read_time'] ); ?>
							</div>
							<h2 style="font-size: 1.45rem; margin-bottom: var(--ns-space-3);">
								<a href="<?php echo esc_url( home_url( '/blog/#' . sanitize_title( $post_item['title'] ) ) ); ?>">
									<?php echo esc_html( $post_item['title'] ); ?>
								</a>
							</h2>
							<p style="font-size: 0.9375rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-4); flex-grow: 1;">
								<?php echo esc_html( $post_item['excerpt'] ); ?>
							</p>
							<a href="<?php echo esc_url( home_url( '/blog/#' . sanitize_title( $post_item['title'] ) ) ); ?>" class="ns-btn ns-btn-secondary" style="align-self: flex-start; padding: 0.4rem 0.85rem; font-size: 0.8125rem;">
								<?php esc_html_e( 'Read Article', 'northstar-renovation' ); ?> &rarr;
							</a>
						</div>
					</article>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php
get_footer();
