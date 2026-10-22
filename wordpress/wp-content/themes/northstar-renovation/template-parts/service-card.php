<?php
/**
 * Service card template part.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$service = isset( $args['service'] ) ? $args['service'] : null;
if ( ! $service ) {
	return;
}

$title        = $service['title'] ?? get_the_title();
$description  = $service['description'] ?? get_the_excerpt();
$image        = $service['image'] ?? ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'ns-card' ) : NORTHSTAR_URI . '/assets/images/service-kitchen.svg' );
$icon         = $service['icon'] ?? NORTHSTAR_URI . '/assets/icons/home.svg';
$deliverables = $service['deliverables'] ?? array();
$timeline     = $service['timeline'] ?? '';
$investment   = $service['investment'] ?? '';
$link         = home_url( '/services/#' . ( $service['slug'] ?? 'service' ) );
?>
<article class="ns-service-card" aria-labelledby="service-title-<?php echo esc_attr( sanitize_title( $title ) ); ?>">
	<div class="ns-service-card-media">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" width="800" height="500">
	</div>

	<div class="ns-service-card-body">
		<div class="ns-service-card-header">
			<img src="<?php echo esc_url( $icon ); ?>" alt="" class="ns-service-icon" width="28" height="28" aria-hidden="true">
			<h3 id="service-title-<?php echo esc_attr( sanitize_title( $title ) ); ?>" class="ns-service-card-title">
				<?php echo esc_html( $title ); ?>
			</h3>
		</div>

		<p class="ns-service-card-desc">
			<?php echo esc_html( $description ); ?>
		</p>

		<?php if ( ! empty( $deliverables ) ) : ?>
			<ul class="ns-service-deliverables" aria-label="<?php echo esc_attr( sprintf( __( 'Key deliverables for %s', 'northstar-renovation' ), $title ) ); ?>">
				<?php foreach ( array_slice( $deliverables, 0, 4 ) as $item ) : ?>
					<li class="ns-deliverable-item"><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<div class="ns-service-meta">
			<?php if ( $timeline ) : ?>
				<span><strong><?php esc_html_e( 'Timeline:', 'northstar-renovation' ); ?></strong> <?php echo esc_html( $timeline ); ?></span>
			<?php endif; ?>
			<a href="<?php echo esc_url( home_url( '/contact/?service=' . ( $service['slug'] ?? '' ) ) ); ?>" class="ns-btn ns-btn-secondary" style="padding: 0.4rem 0.85rem; font-size: 0.8125rem;">
				<?php esc_html_e( 'Inquire', 'northstar-renovation' ); ?> &rarr;
			</a>
		</div>
	</div>
</article>
