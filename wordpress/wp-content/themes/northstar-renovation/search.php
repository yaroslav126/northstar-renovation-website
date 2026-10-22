<?php
/**
 * Search results template for Northstar Renovation.
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
			<?php esc_html_e( 'Search Results', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-2);">
			<?php printf( esc_html__( 'Search Query: &ldquo;%s&rdquo;', 'northstar-renovation' ), get_search_query() ); ?>
		</h1>
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
						<div class="ns-project-card-body">
							<span style="font-size: 0.8125rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-2); display: block;">
								<?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ?? 'Entry' ); ?>
							</span>
							<h2 style="font-size: 1.4rem; margin-bottom: var(--ns-space-3);">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<p style="font-size: 0.9375rem; color: var(--ns-color-muted); margin-bottom: var(--ns-space-4); flex-grow: 1;">
								<?php the_excerpt(); ?>
							</p>
							<a href="<?php the_permalink(); ?>" class="ns-btn ns-btn-secondary" style="align-self: flex-start; padding: 0.4rem 0.85rem; font-size: 0.8125rem;">
								<?php esc_html_e( 'Read More', 'northstar-renovation' ); ?> &rarr;
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
				<h2><?php esc_html_e( 'No Matches Found', 'northstar-renovation' ); ?></h2>
				<p style="color: var(--ns-color-muted);"><?php esc_html_e( 'We could not find matching articles or case studies for your search query. Try searching with different keywords.', 'northstar-renovation' ); ?></p>
				<div style="max-width: 480px; margin: var(--ns-space-6) auto 0;">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
