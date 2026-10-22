<?php
/**
 * Project card template part for portfolio and homepage.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$project = isset( $args['project'] ) ? $args['project'] : null;
if ( ! $project ) {
	return;
}

$title        = $project['title'] ?? get_the_title();
$category     = $project['category'] ?? 'whole-home';
$category_lbl = $project['category_lbl'] ?? __( 'Renovation', 'northstar-renovation' );
$location     = $project['location'] ?? __( 'Metropolitan Area', 'northstar-renovation' );
$timeline     = $project['timeline'] ?? '';
$budget_tier  = $project['budget_tier'] ?? '';
$image        = $project['image'] ?? ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'ns-card' ) : NORTHSTAR_URI . '/assets/images/project-1.svg' );
$excerpt      = $project['excerpt'] ?? get_the_excerpt();
$slug         = $project['slug'] ?? 'project';
?>
<article class="ns-project-card ns-project-item" data-category="<?php echo esc_attr( $category ); ?>" aria-labelledby="proj-title-<?php echo esc_attr( $slug ); ?>">
	<div class="ns-project-card-media">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" width="800" height="520">
		<span class="ns-project-badge"><?php echo esc_html( $category_lbl ); ?></span>
	</div>

	<div class="ns-project-card-body">
		<div class="ns-project-location">
			<?php echo esc_html( $location ); ?>
		</div>

		<h3 id="proj-title-<?php echo esc_attr( $slug ); ?>" class="ns-project-title">
			<a href="<?php echo esc_url( home_url( '/portfolio/#' . $slug ) ); ?>">
				<?php echo esc_html( $title ); ?>
			</a>
		</h3>

		<p class="ns-project-excerpt">
			<?php echo esc_html( $excerpt ); ?>
		</p>

		<div class="ns-project-meta-row">
			<?php if ( $timeline ) : ?>
				<span><strong><?php esc_html_e( 'Duration:', 'northstar-renovation' ); ?></strong> <?php echo esc_html( $timeline ); ?></span>
			<?php endif; ?>
			<?php if ( $budget_tier ) : ?>
				<span><strong><?php esc_html_e( 'Tier:', 'northstar-renovation' ); ?></strong> <?php echo esc_html( $budget_tier ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</article>
