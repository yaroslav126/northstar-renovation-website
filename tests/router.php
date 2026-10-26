<?php
/**
 * Local Test Harness & Router for Northstar Renovation.
 *
 * Bootstraps standard WordPress runtime functions to execute and verify
 * theme templates, stylesheets, scripts, and server-side form handlers.
 */

define( 'ABSPATH', __DIR__ . '/../wordpress/' );

$theme_dir = realpath( __DIR__ . '/../wordpress/wp-content/themes/northstar-renovation' );
$plugin_dir = realpath( __DIR__ . '/../wordpress/wp-content/plugins/northstar-site-core' );

// Static Asset Serving
$uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
if ( '/favicon.ico' === $uri ) {
	header( 'Content-Type: image/x-icon' );
	http_response_code( 204 );
	exit;
}
if ( '/style.css' === $uri ) {
	header( 'Content-Type: text/css; charset=UTF-8' );
	readfile( $theme_dir . '/style.css' );
	exit;
}
if ( '/humans.txt' === $uri ) {
	header( 'Content-Type: text/plain; charset=UTF-8' );
	readfile( __DIR__ . '/../humans.txt' );
	exit;
}
if ( '/robots.txt' === $uri ) {
	header( 'Content-Type: text/plain; charset=UTF-8' );
	readfile( __DIR__ . '/../robots.txt' );
	exit;
}
if ( '/ai.txt' === $uri ) {
	header( 'Content-Type: text/plain; charset=UTF-8' );
	readfile( __DIR__ . '/../ai.txt' );
	exit;
}
if ( '/tdm-reservation.json' === $uri ) {
	header( 'Content-Type: application/json; charset=UTF-8' );
	readfile( __DIR__ . '/../tdm-reservation.json' );
	exit;
}

if ( strpos( $uri, '/assets/' ) === 0 ) {
	$file = $theme_dir . $uri;
	if ( file_exists( $file ) ) {
		$ext = pathinfo( $file, PATHINFO_EXTENSION );
		$mimes = array(
			'css'  => 'text/css',
			'js'   => 'application/javascript',
			'svg'  => 'image/svg+xml',
			'png'  => 'image/png',
			'jpg'  => 'image/jpeg',
			'woff2'=> 'font/woff2',
		);
		header( 'Content-Type: ' . ( $mimes[ $ext ] ?? 'application/octet-stream' ) );
		readfile( $file );
		exit;
	}
}

// Global WordPress Simulation Functions
$GLOBALS['_ns_actions'] = array();
$GLOBALS['_ns_scripts'] = array();
$GLOBALS['_ns_styles']  = array();
$GLOBALS['_ns_localized']= array();

function add_action( $tag, $callback, $priority = 10, $accepted_args = 1 ) {
	$GLOBALS['_ns_actions'][ $tag ][] = $callback;
}

function do_action( $tag, ...$arg_to_pass ) {
	if ( ! empty( $GLOBALS['_ns_actions'][ $tag ] ) ) {
		foreach ( $GLOBALS['_ns_actions'][ $tag ] as $cb ) {
			if ( is_callable( $cb ) ) {
				call_user_func_array( $cb, $arg_to_pass );
			}
		}
	}
}

function apply_filters( $tag, $value, ...$arg_to_pass ) {
	return $value;
}

function esc_html( $text ) { return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $text ) { return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $url ) { return filter_var( $url, FILTER_SANITIZE_URL ); }
function esc_html_e( $text, $domain = 'default' ) { echo esc_html( $text ); }
function esc_attr_e( $text, $domain = 'default' ) { echo esc_attr( $text ); }
function esc_html__( $text, $domain = 'default' ) { return esc_html( __( $text, $domain ) ); }
function esc_attr__( $text, $domain = 'default' ) { return esc_attr( __( $text, $domain ) ); }
function __( $text, $domain = 'default' ) { return $text; }
function _x( $text, $context, $domain = 'default' ) { return $text; }
function sanitize_text_field( $str ) { return trim( strip_tags( (string) $str ) ); }
function sanitize_email( $email ) { return filter_var( trim( (string) $email ), FILTER_SANITIZE_EMAIL ); }
function sanitize_textarea_field( $str ) { return htmlspecialchars( trim( (string) $str ), ENT_QUOTES, 'UTF-8' ); }
function sanitize_title( $title ) { return strtolower( preg_replace( '/[^A-Za-z0-9-]+/', '-', $title ) ); }
function sanitize_key( $key ) { return strtolower( preg_replace( '/[^a-z0-9_-]/', '', $key ) ); }
function is_email( $email ) { return filter_var( $email, FILTER_VALIDATE_EMAIL ) !== false; }

function wp_create_nonce( $action ) { return substr( md5( 'ns_salt_' . $action ), 0, 10 ); }
function wp_verify_nonce( $nonce, $action ) { return $nonce === substr( md5( 'ns_salt_' . $action ), 0, 10 ); }
function wp_nonce_field( $action, $name ) {
	$nonce = wp_create_nonce( $action );
	echo '<input type="hidden" id="' . esc_attr( $name ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $nonce ) . '">';
}

function _ns_base_url() {
	$host   = $_SERVER['HTTP_HOST'] ?? '127.0.0.1:8081';
	$scheme = ( ! empty( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'] ) ? 'https' : 'http';
	return $scheme . '://' . $host;
}
function home_url( $path = '' ) { return _ns_base_url() . $path; }
function admin_url( $path = '' ) { return _ns_base_url() . '/' . ltrim( $path, '/' ); }
function get_template_directory() { return $GLOBALS['theme_dir']; }
function get_template_directory_uri() { return _ns_base_url(); }
function get_stylesheet_uri() { return _ns_base_url() . '/style.css'; }
function get_bloginfo( $show = 'name' ) {
	if ( 'name' === $show ) return 'Northstar Renovation';
	if ( 'description' === $show ) return 'Architectural Renovation';
	if ( 'charset' === $show ) return 'UTF-8';
	return '';
}
function bloginfo( $show = 'name' ) { echo esc_html( get_bloginfo( $show ) ); }
function language_attributes() { echo 'lang="en-US"'; }
function body_class( $class = '' ) { echo 'class="northstar-theme ' . esc_attr( $class ) . '"'; }
function wp_body_open() { do_action( 'wp_body_open' ); }
function has_nav_menu( $location ) { return false; }
function is_front_page() { return '/' === parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ); }
function is_page() { return false; }
function is_single() { return false; }
function has_post_thumbnail() { return false; }
function selected( $val1, $val2, $echo = true ) {
	$res = ( (string) $val1 === (string) $val2 ) ? ' selected="selected"' : '';
	if ( $echo ) echo $res;
	return $res;
}

function load_theme_textdomain() {}
function add_theme_support() {}
function register_nav_menus() {}
function add_image_size() {}
function add_editor_style() {}
function register_post_type() {}
function register_taxonomy() {}
function register_post_meta() {}
function register_activation_hook() {}
function register_deactivation_hook() {}
function flush_rewrite_rules() {}
function plugin_dir_path() { return $GLOBALS['plugin_dir'] . '/'; }
function plugin_dir_url() { return _ns_base_url() . '/plugins/'; }
function wp_unslash( $val ) { return $val; }
function wp_parse_url( $url, $component = -1 ) { return parse_url( $url, $component ); }
function current_time( $type ) { return date( 'Y-m-d H:i:s' ); }
function get_option( $name, $default = '' ) { return $default; }
function wp_get_referer() { return $_SERVER['HTTP_REFERER'] ?? home_url( '/contact/' ); }
function add_query_arg( $key, $value = false, $url = '' ) {
	if ( is_array( $key ) ) {
		$parsed = parse_url( $value ? $value : $_SERVER['REQUEST_URI'] );
		parse_str( $parsed['query'] ?? '', $q );
		$q = array_merge( $q, $key );
		return ( $parsed['path'] ?? '' ) . '?' . http_build_query( $q );
	}
	return $url . ( strpos( $url, '?' ) !== false ? '&' : '?' ) . $key . '=' . urlencode( $value );
}
function remove_query_arg( $keys, $url = '' ) { return $url; }

if ( ! defined( 'MINUTE_IN_SECONDS' ) ) {
	define( 'MINUTE_IN_SECONDS', 60 );
}
if ( ! defined( 'HOUR_IN_SECONDS' ) ) {
	define( 'HOUR_IN_SECONDS', 3600 );
}
if ( ! defined( 'DAY_IN_SECONDS' ) ) {
	define( 'DAY_IN_SECONDS', 86400 );
}

function _ns_load_transients() {
	$file = __DIR__ . '/.ns_transients.json';
	if ( file_exists( $file ) ) {
		$data = json_decode( file_get_contents( $file ), true );
		if ( is_array( $data ) ) {
			return $data;
		}
	}
	return array();
}

function _ns_save_transients( $transients ) {
	$file = __DIR__ . '/.ns_transients.json';
	file_put_contents( $file, json_encode( $transients ) );
}

function get_transient( $transient ) {
	$transients = _ns_load_transients();
	if ( isset( $transients[ $transient ] ) ) {
		$item = $transients[ $transient ];
		if ( 0 === $item['expires'] || $item['expires'] >= time() ) {
			return $item['value'];
		}
		unset( $transients[ $transient ] );
		_ns_save_transients( $transients );
	}
	return false;
}

function set_transient( $transient, $value, $expiration = 0 ) {
	$transients = _ns_load_transients();
	$transients[ $transient ] = array(
		'value'   => $value,
		'expires' => $expiration > 0 ? time() + $expiration : 0,
	);
	_ns_save_transients( $transients );
	return true;
}

function delete_transient( $transient ) {
	$transients = _ns_load_transients();
	unset( $transients[ $transient ] );
	_ns_save_transients( $transients );
	return true;
}

function get_locale() { return 'en_US'; }
function has_excerpt() { return false; }
function get_the_excerpt() { return 'Architectural renovation case study and residential spatial transformation.'; }
function get_the_title() { return 'Northstar Architectural Showcase'; }
function the_title_attribute() { echo esc_attr( get_the_title() ); }
function the_permalink() { echo esc_url( home_url( '/blog/' ) ); }
function get_the_date() { return 'October 21, 2026'; }
function the_author() { echo 'Elena Vance'; }
function get_the_author() { return 'Elena Vance'; }
function the_category( $sep = ', ' ) { echo '<a href="/category/architecture/">Architecture</a>'; }
function the_content() { echo '<p>Comprehensive architectural residential case study details and structural engineering narrative.</p>'; }
function have_posts() { return false; }
function the_post() {}
function the_posts_pagination() { echo '<nav aria-label="Pagination" class="pagination"></nav>'; }
function the_ID() { echo '1'; }
function post_class( $class = '' ) { echo 'class="' . esc_attr( $class ) . '"'; }
function previous_post_link() {}
function next_post_link() {}
function the_archive_title() { echo 'Architectural Case Studies'; }
function the_archive_description() { echo '<p>Archive of architectural transformations.</p>'; }
function get_search_query() { return 'kitchen'; }
function get_search_form() { echo '<form action="/"><input type="search" name="s" placeholder="Search..."></form>'; }
function wp_trim_words( $text, $num_words = 55, $more = null ) { return implode( ' ', array_slice( explode( ' ', (string) $text ), 0, $num_words ) ) . '...'; }
function wp_strip_all_tags( $string ) { return strip_tags( (string) $string ); }
function wp_link_pages() {}

function wp_enqueue_style( $handle, $src = '', $deps = array(), $ver = false ) {
	$GLOBALS['_ns_styles'][ $handle ] = $src;
}
function wp_enqueue_script( $handle, $src = '', $deps = array(), $ver = false, $args = array() ) {
	$GLOBALS['_ns_scripts'][ $handle ] = $src;
}
function wp_localize_script( $handle, $name, $data ) {
	$GLOBALS['_ns_localized'][ $name ] = $data;
}

function wp_head() {
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">' . "\n";
	echo '<link rel="stylesheet" href="/style.css">' . "\n";
	do_action( 'wp_head' );
}

function wp_footer() {
	if ( ! empty( $GLOBALS['_ns_localized'] ) ) {
		echo '<script>';
		foreach ( $GLOBALS['_ns_localized'] as $var => $data ) {
			echo 'var ' . esc_attr( $var ) . ' = ' . json_encode( $data ) . ";\n";
		}
		echo '</script>';
	}
	echo '<script src="/assets/js/main.js" defer></script>' . "\n";
	do_action( 'wp_footer' );
}

function get_header( $name = null ) {
	include $GLOBALS['theme_dir'] . '/header.php';
}

function get_footer( $name = null ) {
	include $GLOBALS['theme_dir'] . '/footer.php';
}

function get_template_part( $slug, $name = null, $args = array() ) {
	$file = $GLOBALS['theme_dir'] . '/' . $slug . ( $name ? "-$name" : '' ) . '.php';
	if ( file_exists( $file ) ) {
		include $file;
	}
}

function wp_doing_ajax() {
	return ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && 'xmlhttprequest' === strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] );
}

function wp_send_json_success( $data ) {
	header( 'Content-Type: application/json; charset=UTF-8' );
	echo json_encode( array( 'success' => true, 'data' => $data ) );
	exit;
}

function wp_send_json_error( $data ) {
	header( 'Content-Type: application/json; charset=UTF-8' );
	echo json_encode( array( 'success' => false, 'data' => $data ) );
	exit;
}

function wp_safe_redirect( $location ) {
	header( 'Location: ' . $location );
	exit;
}

function wp_mail( $to, $subject, $message, $headers = '' ) {
	// Log email dispatch for verification
	error_log( "[MOCK WP_MAIL] To: $to | Subject: $subject" );
	return true;
}

// Load Theme and Plugin Logic
require_once $theme_dir . '/functions.php';
require_once $plugin_dir . '/northstar-site-core.php';

// Route Admin Post / AJAX endpoints
if ( '/admin-post.php' === $uri || '/admin-ajax.php' === $uri ) {
	if ( isset( $_REQUEST['action'] ) && 'northstar_submit_quote' === $_REQUEST['action'] ) {
		northstar_core_handle_contact_submission();
		exit;
	}
}

// Route Pages
do_action( 'send_headers' );
$clean_path = rtrim( $uri, '/' );
if ( '' === $clean_path ) {
	include $theme_dir . '/front-page.php';
} elseif ( '/services' === $clean_path ) {
	include $theme_dir . '/page-templates/page-services.php';
} elseif ( '/portfolio' === $clean_path ) {
	include $theme_dir . '/page-templates/page-portfolio.php';
} elseif ( '/about' === $clean_path ) {
	include $theme_dir . '/page-templates/page-about.php';
} elseif ( '/contact' === $clean_path ) {
	include $theme_dir . '/page-templates/page-contact.php';
} elseif ( '/blog' === $clean_path ) {
	include $theme_dir . '/index.php';
} elseif ( '/faq' === $clean_path ) {
	include $theme_dir . '/page-templates/page-faq.php';
} else {
	http_response_code( 404 );
	include $theme_dir . '/404.php';
}
