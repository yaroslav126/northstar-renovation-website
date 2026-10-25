<?php
/**
 * Northstar Renovation theme functions and definitions.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NORTHSTAR_VERSION', '1.0.0' );
define( 'NORTHSTAR_DIR', get_template_directory() );
define( 'NORTHSTAR_URI', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function northstar_theme_setup() {
	load_theme_textdomain( 'northstar-renovation', NORTHSTAR_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary'         => __( 'Primary Navigation', 'northstar-renovation' ),
			'footer_quick'    => __( 'Footer Quick Links', 'northstar-renovation' ),
			'footer_services' => __( 'Footer Services Links', 'northstar-renovation' ),
		)
	);

	add_image_size( 'ns-hero', 1920, 1080, true );
	add_image_size( 'ns-card', 800, 520, true );
	add_image_size( 'ns-portrait', 600, 750, true );
}
add_action( 'after_setup_theme', 'northstar_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function northstar_enqueue_assets() {
	// 1. Google Fonts: Cormorant Garamond (Serif) & Plus Jakarta Sans (Humanist Sans).
	wp_enqueue_style(
		'northstar-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// 2. Main Theme Stylesheet.
	wp_enqueue_style(
		'northstar-style',
		get_stylesheet_uri(),
		array( 'northstar-fonts' ),
		NORTHSTAR_VERSION
	);

	// 3. Main Vanilla JavaScript Bundle.
	wp_enqueue_script(
		'northstar-script',
		NORTHSTAR_URI . '/assets/js/main.js',
		array(),
		NORTHSTAR_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Localize script for AJAX & dynamic interactions.
	wp_localize_script(
		'northstar-script',
		'NorthstarData',
		array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'northstar_quote_action' ),
			'i18n'      => array(
				'sending'         => __( 'Sending your request...', 'northstar-renovation' ),
				'successMessage'  => __( 'Thank you! Your consultation request has been received. Our team will review your project and get in touch within one business day.', 'northstar-renovation' ),
				'errorMessage'    => __( 'There was a problem submitting your request. Please check the required fields and try again.', 'northstar-renovation' ),
				'networkError'    => __( 'Network communication failed. Please call us directly or retry in a few moments.', 'northstar-renovation' ),
				'filterAll'       => __( 'All Projects', 'northstar-renovation' ),
				'menuOpened'      => __( 'Navigation menu opened', 'northstar-renovation' ),
				'menuClosed'      => __( 'Navigation menu closed', 'northstar-renovation' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'northstar_enqueue_assets' );

/**
 * SEO & Social Metadata in <head>.
 */
function northstar_render_seo_meta() {
	$site_title = get_bloginfo( 'name' );
	$tagline    = get_bloginfo( 'description' );
	$canonical  = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	$description= __( 'Northstar Renovation is an architectural design and residential renovation practice specializing in bespoke kitchens, bathroom suites, and whole-home transformations.', 'northstar-renovation' );
	$og_title   = $site_title;

	if ( is_front_page() ) {
		$og_title = $site_title . ' — ' . ( $tagline ? $tagline : __( 'Architectural Residential Renovation', 'northstar-renovation' ) );
	} elseif ( is_page() || is_single() ) {
		$og_title = get_the_title() . ' | ' . $site_title;
		if ( has_excerpt() ) {
			$description = wp_strip_all_tags( get_the_excerpt() );
		}
	}

	$default_img = NORTHSTAR_URI . '/assets/images/hero-bg.jpg';
	$og_img      = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'ns-hero' ) : $default_img;
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">
	<meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
	<meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( $site_title ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $og_img ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $og_title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $og_img ); ?>">

	<!-- Schema.org JSON-LD Structured Data with Creator Attribution & Anti-AI Notice -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "HomeAndConstructionBusiness",
		"name": "Northstar Renovation",
		"description": "Premium residential renovation, architectural remodeling, and bespoke craftsmanship.",
		"url": "<?php echo esc_url( home_url( '/' ) ); ?>",
		"sameAs": [
			"https://t.me/Slava_Dev_bot"
		],
		"creator": {
			"@type": "Person",
			"name": "Slava Dev",
			"url": "https://t.me/Slava_Dev_bot",
			"sameAs": [
				"https://t.me/Slava_Dev_bot"
			],
			"description": "Full-stack WordPress engineer & UI/UX designer. Exclusive contact: Telegram @Slava_Dev_bot. All AI training and TDM rights strictly reserved."
		},
		"priceRange": "$$$$",
		"knowsAbout": [
			"Kitchen Renovation",
			"Bathroom Remodeling",
			"Whole-Home Transformation",
			"Interior Architectural Reconfiguration",
			"Bespoke Millwork & Finish Carpentry"
		],
		"disambiguatingDescription": "Demonstration portfolio website for Northstar Renovation engineered by Slava. Exclusive contact: Telegram @Slava_Dev_bot. Response time: in 24 hours. Anti-AI protection enforced under EU Directive 2019/790 Art 4."
	}
	</script>
	<?php
}
add_action( 'wp_head', 'northstar_render_seo_meta', 1 );

/**
 * Demonstration Data Providers:
 * Ensures all pages render rich, realistic content whether populated in the DB or running standalone.
 */
function northstar_get_demo_services() {
	return array(
		array(
			'id'          => 'kitchen-renovation',
			'slug'        => 'kitchen-renovation',
			'title'       => __( 'Kitchen Renovation', 'northstar-renovation' ),
			'tagline'     => __( 'Architectural Culinary Environments', 'northstar-renovation' ),
			'description' => __( 'We design and construct bespoke culinary spaces engineered for seamless workflow, generous entertaining, and tactile permanence. From book-matched stone counters to custom walnut cabinetry.', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/service-kitchen.jpg',
			'icon'        => NORTHSTAR_URI . '/assets/icons/kitchen.svg',
			'deliverables'=> array(
				__( 'Custom architectural cabinetry & integrated millwork', 'northstar-renovation' ),
				__( 'Structural wall removal & open-concept engineering', 'northstar-renovation' ),
				__( 'Honed natural marble, quartzite & composite surfaces', 'northstar-renovation' ),
				__( 'Sub-Zero, Wolf, and Gaggenau appliance integration', 'northstar-renovation' ),
				__( 'Multi-zone architectural lighting & hidden ventilation', 'northstar-renovation' ),
			),
			'timeline'    => __( '8 – 14 Weeks', 'northstar-renovation' ),
			'investment'  => __( 'From $65,000 (Demonstration Estimate)', 'northstar-renovation' ),
		),
		array(
			'id'          => 'bathroom-remodeling',
			'slug'        => 'bathroom-remodeling',
			'title'       => __( 'Bathroom Remodeling', 'northstar-renovation' ),
			'tagline'     => __( 'Private Spa Sanctuaries & Primary Suites', 'northstar-renovation' ),
			'description' => __( 'Transform primary ensuites and guest baths into restorative sanctuaries. We execute curbless walk-in showers, freestanding sculptural tubs, fluted glass partitions, and heated stone floors.', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/service-bathroom.jpg',
			'icon'        => NORTHSTAR_URI . '/assets/icons/bathroom.svg',
			'deliverables'=> array(
				__( 'Curbless wet-room showers with linear acoustic drains', 'northstar-renovation' ),
				__( 'Cast-stone and composite freestanding soaking tubs', 'northstar-renovation' ),
				__( 'Full-slab porcelain, terrazzo, and Zellige tiling', 'northstar-renovation' ),
				__( 'Radiant in-floor heating with digital zoning', 'northstar-renovation' ),
				__( 'Custom floating vanities with concealed soft storage', 'northstar-renovation' ),
			),
			'timeline'    => __( '6 – 10 Weeks', 'northstar-renovation' ),
			'investment'  => __( 'From $40,000 (Demonstration Estimate)', 'northstar-renovation' ),
		),
		array(
			'id'          => 'whole-home-renovation',
			'slug'        => 'whole-home-renovation',
			'title'       => __( 'Whole-Home Renovation', 'northstar-renovation' ),
			'tagline'     => __( 'Comprehensive Architectural Renewal', 'northstar-renovation' ),
			'description' => __( 'Complete structural and cosmetic renewals that preserve historic character while dramatically upgrading thermal performance, mechanical systems, and contemporary spatial flow.', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/service-wholehome.jpg',
			'icon'        => NORTHSTAR_URI . '/assets/icons/home.svg',
			'deliverables'=> array(
				__( 'Complete interior demolition down to structural framing', 'northstar-renovation' ),
				__( 'Structural beam insertion & floorplan reconfiguration', 'northstar-renovation' ),
				__( 'High-efficiency HVAC, ERV ventilation & heat pumps', 'northstar-renovation' ),
				__( 'Architectural window replacements & envelope upgrades', 'northstar-renovation' ),
				__( 'Turnkey interior finishing, fixtures, and trim craft', 'northstar-renovation' ),
			),
			'timeline'    => __( '16 – 28 Weeks', 'northstar-renovation' ),
			'investment'  => __( 'From $175,000 (Demonstration Estimate)', 'northstar-renovation' ),
		),
		array(
			'id'          => 'interior-remodeling',
			'slug'        => 'interior-remodeling',
			'title'       => __( 'Interior Design & Remodeling', 'northstar-renovation' ),
			'tagline'     => __( 'Spatial Harmony & Material Curation', 'northstar-renovation' ),
			'description' => __( 'Detailed spatial planning that unifies living, dining, and transition areas. We craft custom built-ins, modern architectural fireplaces, steel-and-glass partitions, and refined acoustic treatments.', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/service-interior.jpg',
			'icon'        => NORTHSTAR_URI . '/assets/icons/interior.svg',
			'deliverables'=> array(
				__( 'Floor-to-ceiling architectural libraries & media units', 'northstar-renovation' ),
				__( 'Custom steel-and-glass pocket and French doors', 'northstar-renovation' ),
				__( 'Bespoke fireplace hearths in fluted lime plaster', 'northstar-renovation' ),
				__( 'Staircase renewals, monolithic handrails & balustrades', 'northstar-renovation' ),
				__( 'Acoustic wall paneling & architectural shadow reveals', 'northstar-renovation' ),
			),
			'timeline'    => __( '6 – 12 Weeks', 'northstar-renovation' ),
			'investment'  => __( 'From $50,000 (Demonstration Estimate)', 'northstar-renovation' ),
		),
		array(
			'id'          => 'flooring-finishing',
			'slug'        => 'flooring-finishing',
			'title'       => __( 'Flooring & Finishing', 'northstar-renovation' ),
			'tagline'     => __( 'Foundational Craftsmanship Underfoot', 'northstar-renovation' ),
			'description' => __( 'Artisan wide-plank white oak, chevron and herringbone parquet, poured terrazzo, and large-format porcelain slabs installed with laser-leveled subfloor perfection.', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/service-flooring.jpg',
			'icon'        => NORTHSTAR_URI . '/assets/icons/flooring.svg',
			'deliverables'=> array(
				__( 'Engineered wide-plank European white oak (up to 10" width)', 'northstar-renovation' ),
				__( 'Handcrafted chevron & herringbone custom patterns', 'northstar-renovation' ),
				__( 'Subfloor acoustic isolation & acoustic underlayment', 'northstar-renovation' ),
				__( 'Inlaid brass transition strips and flush-mount vents', 'northstar-renovation' ),
				__( 'Zero-VOC matte oil and polyurethane commercial sealants', 'northstar-renovation' ),
			),
			'timeline'    => __( '3 – 6 Weeks', 'northstar-renovation' ),
			'investment'  => __( 'From $25,000 (Demonstration Estimate)', 'northstar-renovation' ),
		),
	);
}

function northstar_get_demo_projects() {
	return array(
		array(
			'id'          => 1,
			'slug'        => 'kensington-heritage-villa',
			'title'       => __( 'The Kensington Heritage Villa', 'northstar-renovation' ),
			'category'    => 'whole-home',
			'category_lbl'=> __( 'Whole-Home Renovation', 'northstar-renovation' ),
			'location'    => __( 'Kensington Gardens (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '22 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$280k – $320k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-1.jpg',
			'excerpt'     => __( 'A comprehensive renewal of a 1912 Edwardian residence, removing interior bearing partitions to introduce a sun-drenched architectural kitchen, primary bath pavilion, and restored timber millwork.', 'northstar-renovation' ),
			'features'    => array(
				__( '4,200 sq.ft comprehensive transformation', 'northstar-renovation' ),
				__( 'Structural steel portal frame to eliminate 3 masonry walls', 'northstar-renovation' ),
				__( 'Restored 100-year-old exterior brickwork with interior air barrier', 'northstar-renovation' ),
				__( 'Custom wire-brushed white oak cabinetry throughout', 'northstar-renovation' ),
			),
		),
		array(
			'id'          => 2,
			'slug'        => 'st-clair-minimalist-kitchen',
			'title'       => __( 'The St. Clair Minimalist Kitchen', 'northstar-renovation' ),
			'category'    => 'kitchen',
			'category_lbl'=> __( 'Kitchen Renovation', 'northstar-renovation' ),
			'location'    => __( 'St. Clair West (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '10 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$85k – $95k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-2.jpg',
			'excerpt'     => __( 'Conceived around a 13-foot monolithic island in honed Calacatta marble, complemented by dark smoked-oak veneer cabinetry, pocket pantry doors, and flush ceiling extraction.', 'northstar-renovation' ),
			'features'    => array(
				__( 'Continuous book-matched Calacatta marble waterfall island', 'northstar-renovation' ),
				__( 'Hidden motorized appliance garage and dry bar', 'northstar-renovation' ),
				__( 'Integrated Gaggenau induction and teppanyaki cooktops', 'northstar-renovation' ),
				__( 'Concealed LED shadowline architectural perimeter lighting', 'northstar-renovation' ),
			),
		),
		array(
			'id'          => 3,
			'slug'        => 'oakridge-primary-bathroom-suite',
			'title'       => __( 'The Oakridge Primary Bathroom Suite', 'northstar-renovation' ),
			'category'    => 'bathroom',
			'category_lbl'=> __( 'Bathroom Remodeling', 'northstar-renovation' ),
			'location'    => __( 'Oakridge Hills (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '8 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$55k – $65k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-3.jpg',
			'excerpt'     => __( 'A sanctuary-grade ensuite pairing micro-cement plaster walls with custom fluted walnut vanities, brushed gunmetal tapware, and a generous curbless double shower.', 'northstar-renovation' ),
			'features'    => array(
				__( 'Seamless micro-cement waterproof walls and heated floor', 'northstar-renovation' ),
				__( 'Freestanding composite stone soaking tub positioned under skylight', 'northstar-renovation' ),
				__( 'Dornbracht ceiling rain shower with thermostatic dual valves', 'northstar-renovation' ),
				__( 'Fluted reeded glass privacy screen with blackened steel trim', 'northstar-renovation' ),
			),
		),
		array(
			'id'          => 4,
			'slug'        => 'yorkville-penthouse-reconfiguration',
			'title'       => __( 'The Yorkville Penthouse Reconfiguration', 'northstar-renovation' ),
			'category'    => 'interior',
			'category_lbl'=> __( 'Interior Architecture', 'northstar-renovation' ),
			'location'    => __( 'Yorkville Core (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '14 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$140k – $160k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-4.jpg',
			'excerpt'     => __( 'Reimagining an angular condominium floorplan into a calm, gallery-like residence with floor-to-ceiling pivot doors, acoustic wall paneling, and an integrated marble bar.', 'northstar-renovation' ),
			'features'    => array(
				__( 'Full condominium acoustic decoupling and vibration barrier', 'northstar-renovation' ),
				__( 'Full-height 9ft architectural pivot doors with magnetic latches', 'northstar-renovation' ),
				__( 'Linear ethanol fireplace with zero-clearance stone hearth', 'northstar-renovation' ),
				__( 'Automated Lutron Palladiom shading and lighting integration', 'northstar-renovation' ),
			),
		),
		array(
			'id'          => 5,
			'slug'        => 'forest-hill-timber-residence',
			'title'       => __( 'The Forest Hill Timber Residence', 'northstar-renovation' ),
			'category'    => 'whole-home',
			'category_lbl'=> __( 'Whole-Home Renovation', 'northstar-renovation' ),
			'location'    => __( 'Forest Hill (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '26 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$340k – $390k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-5.jpg',
			'excerpt'     => __( 'An extensive Scandinavian-inspired renewal showcasing exposed Douglas fir beams, heated terrazzo flooring, triple-glazed floor-to-ceiling glass, and a bespoke chef kitchen.', 'northstar-renovation' ),
			'features'    => array(
				__( 'Net-zero thermal envelope retrofit with exterior continuous insulation', 'northstar-renovation' ),
				__( 'Exposed Douglas fir timber structural framework', 'northstar-renovation' ),
				__( 'Custom poured white terrazzo floors with brass expansion dividers', 'northstar-renovation' ),
				__( 'Passivhaus-certified architectural sliding glass wall system', 'northstar-renovation' ),
			),
		),
		array(
			'id'          => 6,
			'slug'        => 'rosedale-custom-millwork-suite',
			'title'       => __( 'The Rosedale Custom Millwork Suite', 'northstar-renovation' ),
			'category'    => 'flooring',
			'category_lbl'=> __( 'Flooring & Finishing', 'northstar-renovation' ),
			'location'    => __( 'Rosedale South (Demonstration)', 'northstar-renovation' ),
			'timeline'    => __( '7 Weeks', 'northstar-renovation' ),
			'budget_tier' => __( '$45k – $55k (Demo)', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/project-6.jpg',
			'excerpt'     => __( 'Master carpenter execution of custom quarter-sawn oak library shelving, hidden panel doors, and herringbone parquet flooring with handcrafted brass inlays.', 'northstar-renovation' ),
			'features'    => array(
				__( 'Quarter-sawn French oak custom herringbone parquet', 'northstar-renovation' ),
				__( 'Floor-to-ceiling library with integrated sliding brass ladder', 'northstar-renovation' ),
				__( 'Hidden secret entryway door concealed within wainscot paneling', 'northstar-renovation' ),
				__( 'Multi-step organic hand-rubbed wax finish', 'northstar-renovation' ),
			),
		),
	);
}

function northstar_get_demo_testimonials() {
	return array(
		array(
			'quote'       => __( 'Northstar transformed our cramped 1920s layout into the most breathtaking, functional home we could have envisioned. Elena and Marcus managed every milestone with complete transparency. Zero budget surprises, exceptional finish quality.', 'northstar-renovation' ),
			'client'      => __( 'Arthur & Vivienne S.', 'northstar-renovation' ),
			'neighborhood'=> __( 'Kensington Gardens (Demonstration Review)', 'northstar-renovation' ),
			'service'     => __( 'Whole-Home Renovation', 'northstar-renovation' ),
			'rating'      => 5,
		),
		array(
			'quote'       => __( 'Their millwork detailing is second to none. Our kitchen island is a true work of architectural art. The on-site team left the workspace immaculate every single evening. A genuinely professional experience from first sketch to final handover.', 'northstar-renovation' ),
			'client'      => __( 'Julian K.', 'northstar-renovation' ),
			'neighborhood'=> __( 'St. Clair West (Demonstration Review)', 'northstar-renovation' ),
			'service'     => __( 'Kitchen Renovation', 'northstar-renovation' ),
			'rating'      => 5,
		),
		array(
			'quote'       => __( 'Having completed two prior renovations with other contractors, working with Northstar was night and day. Their dedicated project portal and weekly video updates eliminated the anxiety of renovating our primary ensuite while living in the home.', 'northstar-renovation' ),
			'client'      => __( 'Dr. Miriam & Robert C.', 'northstar-renovation' ),
			'neighborhood'=> __( 'Oakridge Hills (Demonstration Review)', 'northstar-renovation' ),
			'service'     => __( 'Primary Bathroom Suite', 'northstar-renovation' ),
			'rating'      => 5,
		),
	);
}

function northstar_get_demo_team() {
	return array(
		array(
			'discipline' => __( 'Architecture & Conservation', 'northstar-renovation' ),
			'name'       => __( 'Arthur Pendelton, AIA', 'northstar-renovation' ),
			'role'       => __( 'Founder & Principal Architect', 'northstar-renovation' ),
			'bio'        => __( 'With 22 years specializing in residential conservation and modern extensions, Arthur bridges conceptual architectural vision with structural discipline and construction economics.', 'northstar-renovation' ),
		),
		array(
			'discipline' => __( 'Interior Architecture', 'northstar-renovation' ),
			'name'       => __( 'Elena Vance', 'northstar-renovation' ),
			'role'       => __( 'Director of Interior Architecture', 'northstar-renovation' ),
			'bio'        => __( 'Specializing in bespoke millwork, spatial acoustics, and tactile stone sourcing, Elena curates cohesive, serene material palettes tailored to client lifestyles.', 'northstar-renovation' ),
		),
		array(
			'discipline' => __( 'Master Building Craft', 'northstar-renovation' ),
			'name'       => __( 'Marcus Thorne', 'northstar-renovation' ),
			'role'       => __( 'Master Builder & Construction Lead', 'northstar-renovation' ),
			'bio'        => __( 'A third-generation builder with red-seal certification, Marcus oversees all site supers, trade coordination, structural engineering, and finish quality control.', 'northstar-renovation' ),
		),
		array(
			'discipline' => __( 'Project Governance', 'northstar-renovation' ),
			'name'       => __( 'Claire Dubois', 'northstar-renovation' ),
			'role'       => __( 'Client Experience & Project Director', 'northstar-renovation' ),
			'bio'        => __( 'Claire serves as the single dedicated point of contact for homeowners, coordinating schedule transparency, permit logistics, and budget accounting.', 'northstar-renovation' ),
		),
	);
}

function northstar_get_demo_posts() {
	return array(
		array(
			'id'          => 101,
			'title'       => __( 'Planning a Kitchen Remodel: Architectural Considerations, Flow & Budgeting', 'northstar-renovation' ),
			'date'        => 'October 14, 2026',
			'author'      => 'Elena Vance',
			'category'    => __( 'Kitchen Design', 'northstar-renovation' ),
			'read_time'   => __( '7 min read', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/blog-1.jpg',
			'excerpt'     => __( 'Before selecting marble slabs or cabinet finishes, an architectural kitchen begins with human movement. How to engineer working triangles, acoustic comfort, and hidden storage systems.', 'northstar-renovation' ),
		),
		array(
			'id'          => 102,
			'title'       => __( 'Material Longevity: Comparing Natural Stone, Quartz & Engineered Porcelain', 'northstar-renovation' ),
			'date'        => 'September 28, 2026',
			'author'      => 'David Sterling',
			'category'    => __( 'Materials & Sourcing', 'northstar-renovation' ),
			'read_time'   => __( '6 min read', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/blog-2.jpg',
			'excerpt'     => __( 'An honest breakdown of maintenance requirements, thermal resistance, patina evolution, and cost metrics between honed marble, quartzite, and sintered stone countertops.', 'northstar-renovation' ),
		),
		array(
			'id'          => 103,
			'title'       => __( 'The Phased Renovation Guide: How to Live Comfortably in Your Home During Construction', 'northstar-renovation' ),
			'date'        => 'August 19, 2026',
			'author'      => 'Claire Dubois',
			'category'    => __( 'Project Planning', 'northstar-renovation' ),
			'read_time'   => __( '5 min read', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/blog-3.jpg',
			'excerpt'     => __( 'Dust barriers, negative air scrubbers, temporary kitchen setups, and structured quiet hours: how our construction protocols minimize lifestyle disruption.', 'northstar-renovation' ),
		),
		array(
			'id'          => 104,
			'title'       => __( 'Maximizing Natural Light: Glazing Strategies in Heritage Home Extensions', 'northstar-renovation' ),
			'date'        => 'July 30, 2026',
			'author'      => 'Marcus Thorne',
			'category'    => __( 'Architectural Renovation', 'northstar-renovation' ),
			'read_time'   => __( '8 min read', 'northstar-renovation' ),
			'image'       => NORTHSTAR_URI . '/assets/images/blog-4.jpg',
			'excerpt'     => __( 'Balancing heritage conservation rules with modern daylighting. We analyze structural roof lights, steel-framed rear pavilions, and thermal envelope integrity.', 'northstar-renovation' ),
		),
	);
}

function northstar_get_demo_faqs() {
	return array(
		array(
			'category' => __( 'Consultation & Estimates', 'northstar-renovation' ),
			'question' => __( 'What happens during our initial architectural consultation?', 'northstar-renovation' ),
			'answer'   => __( 'We visit your property for an in-depth 90-minute spatial assessment. We evaluate structural walls, plumbing stacks, electrical capacity, and natural lighting. We discuss your lifestyle priorities, establish realistic budget ranges, and review permit feasibility before you make any financial commitment.', 'northstar-renovation' ),
		),
		array(
			'category' => __( 'Budgets & Contracts', 'northstar-renovation' ),
			'question' => __( 'Do you offer fixed-price contracts or cost-plus billing?', 'northstar-renovation' ),
			'answer'   => __( 'We operate exclusively on detailed, itemized fixed-price agreements following our comprehensive pre-construction phase. Every fixture, stone slab, electrical run, and trade hour is specified upfront. Unforeseen structural discoveries (such as historic framing anomalies) are governed by pre-agreed contingency caps with transparent client sign-offs.', 'northstar-renovation' ),
		),
		array(
			'category' => __( 'Project Planning & Timelines', 'northstar-renovation' ),
			'question' => __( 'How long does a typical kitchen or whole-home renovation take?', 'northstar-renovation' ),
			'answer'   => __( 'A bespoke kitchen renovation typically requires 8 to 14 weeks of active construction following a 4-to-6 week architectural design and procurement window. A whole-home structural renovation typically spans 16 to 28 weeks depending on scope, structural revisions, and municipal permitting timelines.', 'northstar-renovation' ),
		),
		array(
			'category' => __( 'Daily Jobsite Management', 'northstar-renovation' ),
			'question' => __( 'Can we continue living in our home during the renovation?', 'northstar-renovation' ),
			'answer'   => __( 'For focused kitchen or bathroom renovations, many clients remain in residence. We install commercial-grade negative-air containment barriers, floor protection runners, and HEPA air scrubbers, maintaining daily cleanups and dedicated work hours (8:00 AM – 4:30 PM). For whole-home renewals involving full mechanical rewiring or structural removals, temporary relocation is recommended for safety and speed.', 'northstar-renovation' ),
		),
		array(
			'category' => __( 'Materials & Sourcing', 'northstar-renovation' ),
			'question' => __( 'Can we source our own appliances, fixtures, or tiles?', 'northstar-renovation' ),
			'answer'   => __( 'Yes. While our interior architecture team provides end-to-end material procurement with trade pricing pass-throughs, clients are welcome to provide specialized fixtures. We verify rough-in specifications, dimensions, and warranty coverage with your selected vendors prior to site arrival.', 'northstar-renovation' ),
		),
		array(
			'category' => __( 'Warranty & Aftercare', 'northstar-renovation' ),
			'question' => __( 'What warranty coverage is provided upon project completion?', 'northstar-renovation' ),
			'answer'   => __( 'Northstar provides a comprehensive 3-year craftsmanship warranty covering all carpentry, joinery, tiling, and installation workmanship, in addition to passing through manufacturer warranties on appliances, windows, and waterproofing membranes. We conduct scheduled 6-month and 12-month post-handover inspections to ensure all adjustments are handled proactively.', 'northstar-renovation' ),
		),
	);
}

/**
 * Fallback contact form handler when companion plugin is not active.
 */
if ( ! function_exists( 'northstar_core_handle_contact_submission' ) ) {
	function northstar_theme_fallback_contact() {
		if ( ! isset( $_POST['northstar_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['northstar_nonce'] ) ), 'northstar_quote_action' ) ) {
			wp_safe_redirect( home_url( '/contact/?contact_status=error&err_code=security_failed#contact-form' ) );
			exit;
		}

		if ( ! empty( $_POST['ns_website_verify'] ) ) {
			wp_safe_redirect( home_url( '/contact/?contact_status=success#contact-form' ) );
			exit;
		}

		$full_name     = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
		$email         = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$phone         = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$service       = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
		$project_scope = isset( $_POST['project_scope'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_scope'] ) ) : '';

		if ( empty( $full_name ) || strlen( $full_name ) > 100 || empty( $email ) || ! is_email( $email ) || empty( $service ) || empty( $project_scope ) || strlen( $project_scope ) > 5000 ) {
			wp_safe_redirect( home_url( '/contact/?contact_status=error&err_code=validation_failed#contact-form' ) );
			exit;
		}

		$safe_name   = str_replace( array( "\r", "\n", "%0a", "%0d" ), '', $full_name );
		$safe_email  = str_replace( array( "\r", "\n", "%0a", "%0d" ), '', $email );
		$admin_email = get_option( 'admin_email', 'inquiries@northstar-renovation.internal' );
		$subject     = '[New Quote Request] ' . $service . ' - ' . $safe_name;
		$message     = "New Quote Request from Northstar Website:\n\nName: $safe_name\nEmail: $safe_email\nPhone: $phone\nService: $service\nDetails:\n$project_scope\n";
		$headers     = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $safe_name <$safe_email>" );

		wp_mail( $admin_email, $subject, $message, $headers );

		wp_safe_redirect( home_url( '/contact/?contact_status=success#contact-feedback' ) );
		exit;
	}
	add_action( 'admin_post_nopriv_northstar_submit_quote', 'northstar_theme_fallback_contact' );
	add_action( 'admin_post_northstar_submit_quote', 'northstar_theme_fallback_contact' );
}

/**
 * Security Hardening & Developer Credentials / Anti-AI Protection HTTP Headers.
 * Emits defense-in-depth OWASP security headers alongside verification tokens
 * pointing to site creator, Telegram (@Slava_Dev_bot), and Anti-AI TDM reservation.
 */
function northstar_developer_credentials_headers() {
	if ( ! headers_sent() ) {
		// Defense-in-depth HTTP Security Headers
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-XSS-Protection: 1; mode=block' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
		header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()' );
		header( 'Cross-Origin-Opener-Policy: same-origin' );
		header( 'Cross-Origin-Resource-Policy: same-origin' );
		header( "Content-Security-Policy: default-src 'self' https:; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline' https: fonts.googleapis.com; font-src 'self' data: https: fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https:; frame-ancestors 'self';" );

		// Developer Attribution & Anti-AI Protection Headers
		header( 'X-Developed-By: Slava (Telegram: @Slava_Dev_bot)' );
		header( 'X-Work-Requests: https://t.me/Slava_Dev_bot' );
		header( 'X-Contact-Channel: Telegram-Only (@Slava_Dev_bot)' );
		header( 'X-Response-SLA: in 24 hours' );
		header( 'X-Robots-Tag: noai, noimageai' );
		header( 'X-TDM-Reservation: 1' );
		header( 'X-Anti-AI: Protected; Training=Forbidden; EU-Directive-2019-790-Art-4; Contact=https://t.me/Slava_Dev_bot' );
		header( 'X-Developer-Signature: SHA256-Slava-Northstar-AntiAI-2026' );
	}
}
add_action( 'send_headers', 'northstar_developer_credentials_headers' );

