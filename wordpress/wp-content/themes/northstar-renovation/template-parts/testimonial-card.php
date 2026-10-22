<?php
/**
 * Testimonial card template part.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$testimonial = isset( $args['testimonial'] ) ? $args['testimonial'] : null;
if ( ! $testimonial ) {
	return;
}

$quote        = $testimonial['quote'] ?? '';
$client       = $testimonial['client'] ?? __( 'Homeowner', 'northstar-renovation' );
$neighborhood = $testimonial['neighborhood'] ?? '';
$service      = $testimonial['service'] ?? '';
$rating       = $testimonial['rating'] ?? 5;
?>
<div class="ns-testimonial-card">
	<div>
		<div style="color: var(--ns-color-terracotta); margin-bottom: var(--ns-space-3); font-size: 1.1rem;" aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %d out of 5 stars', 'northstar-renovation' ), $rating ) ); ?>">
			<?php echo esc_html( str_repeat( '★ ', $rating ) ); ?>
		</div>
		<blockquote class="ns-testimonial-quote">
			&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;
		</blockquote>
	</div>

	<div class="ns-testimonial-author">
		<span class="ns-testimonial-name"><?php echo esc_html( $client ); ?></span>
		<span class="ns-testimonial-meta"><?php echo esc_html( $neighborhood ); ?> &bull; <?php echo esc_html( $service ); ?></span>
		<div>
			<span class="ns-demo-pill"><?php esc_html_e( 'Demonstration Review', 'northstar-renovation' ); ?></span>
		</div>
	</div>
</div>
