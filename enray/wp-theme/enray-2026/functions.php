<?php
/**
 * EnRay 2026: налаштування теми.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ENRAY_VERSION', '1.0.0' );

/** Сторінки сценаріїв: slug сторінки => ключ шаблону. */
function enray_scenarios() {
	return array(
		'dim'    => 'Дім',
		'biznes' => 'Бізнес',
		'agro'   => 'Агро',
	);
}

function enray_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

function enray_img( $file ) {
	return enray_asset( 'img/' . $file );
}

/* ---------- Контакти (Зовнішній вигляд → Налаштувати → EnRay) ---------- */

function enray_opt( $key ) {
	$defaults = array(
		'phone'   => '+38 067 672 22 44',
		'email'   => 'enray@ukr.net',
		'address' => 'м. Вінниця, вул. Стрілецька, 16 А',
		'hours'   => '09:00–18:00',
	);
	return get_theme_mod( 'enray_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

function enray_tel() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', enray_opt( 'phone' ) );
}

function enray_viber() {
	return 'viber://chat?number=' . rawurlencode( preg_replace( '/[^0-9+]/', '', enray_opt( 'phone' ) ) );
}

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'enray', array(
		'title'    => 'EnRay: контакти й форми',
		'priority' => 30,
	) );
	$fields = array(
		'phone'    => array( 'Телефон (як показувати)', 'text' ),
		'email'    => array( 'Email', 'text' ),
		'address'  => array( 'Адреса', 'text' ),
		'hours'    => array( 'Години роботи', 'text' ),
		'cf7_home' => array( 'ID форми Contact Form 7: головна', 'number' ),
		'cf7_dim'  => array( 'ID форми Contact Form 7: Дім', 'number' ),
		'cf7_biznes' => array( 'ID форми Contact Form 7: Бізнес', 'number' ),
		'cf7_agro' => array( 'ID форми Contact Form 7: Агро', 'number' ),
		'cf7_service' => array( 'ID форми Contact Form 7: послуги (одна на всі)', 'number' ),
	);
	foreach ( $fields as $key => $f ) {
		$wp_customize->add_setting( 'enray_' . $key, array(
			'sanitize_callback' => 'number' === $f[1] ? 'absint' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'enray_' . $key, array(
			'label'   => $f[0],
			'section' => 'enray',
			'type'    => $f[1],
		) );
	}
} );

/* ---------- Базове налаштування ---------- */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array(
		'primary' => 'Основне меню',
		'footer'  => 'Меню у футері',
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'enray-fonts', enray_asset( 'css/fonts.css' ), array(), ENRAY_VERSION );
	wp_enqueue_style( 'enray', enray_asset( 'css/style.css' ), array( 'enray-fonts' ), ENRAY_VERSION );
	wp_enqueue_style( 'enray-wp', enray_asset( 'css/wp.css' ), array( 'enray' ), ENRAY_VERSION );
	wp_enqueue_script( 'enray', enray_asset( 'js/main.js' ), array(), ENRAY_VERSION, array( 'strategy' => 'defer' ) );
	if ( enray_current_service() ) {
		wp_enqueue_style( 'enray-scenario', enray_asset( 'css/scenario.css' ), array( 'enray' ), ENRAY_VERSION );
		wp_enqueue_style( 'enray-service', enray_asset( 'css/service.css' ), array( 'enray-scenario' ), ENRAY_VERSION );
	}
	if ( enray_current_scenario() ) {
		wp_enqueue_style( 'enray-scenario', enray_asset( 'css/scenario.css' ), array( 'enray' ), ENRAY_VERSION );
		wp_enqueue_script( 'enray-scenario', enray_asset( 'js/scenario.js' ), array( 'enray' ), ENRAY_VERSION, array( 'strategy' => 'defer' ) );
	}
} );

add_action( 'wp_head', function () {
	printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( enray_asset( 'fonts/Onest-var-cyrillic.woff2' ) ) );
	printf( '<meta name="theme-color" content="#dcedfd">' . "\n" );
}, 1 );

add_filter( 'body_class', function ( $classes ) {
	if ( enray_current_scenario() ) {
		$classes[] = 'page-scenario';
	}
	if ( enray_current_service() ) {
		$classes[] = 'page-scenario';
		$classes[] = 'page-service';
	}
	return $classes;
} );

/**
 * Slug сторінки послуги або ''. Вміст послуг лежить у services/<slug>.php
 * (генерує enray/tools/build_services.py), тож сторінки не залежать від полів старої теми.
 */
function enray_current_service() {
	if ( ! is_page() ) {
		return '';
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	return ( $slug && preg_match( '/^[a-z0-9-]+$/', $slug ) && file_exists( get_template_directory() . '/services/' . $slug . '.php' ) ) ? $slug : '';
}

add_filter( 'template_include', function ( $template ) {
	return enray_current_service() ? get_template_directory() . '/page-service.php' : $template;
} );

/** Slug сценарію поточної сторінки або ''. */
function enray_current_scenario() {
	if ( ! is_page() ) {
		return '';
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	return array_key_exists( $slug, enray_scenarios() ) ? $slug : '';
}

/* ---------- Навігація ---------- */

function enray_default_menu() {
	return array(
		array( 'Для дому', home_url( '/dim/' ) ),
		array( 'Для бізнесу', home_url( '/biznes/' ) ),
		array( 'Агро', home_url( '/agro/' ) ),
		array( 'Послуги', home_url( '/#posluhy' ) ),
		array( 'Кейси', home_url( '/keysy/' ) ),
	);
}

/** Футер за замовчуванням: усі напрями компанії, згруповані. */
function enray_footer_groups() {
	return array(
		'Сонячні станції'     => array(
			array( 'Станції для дому', home_url( '/dim/' ) ),
			array( 'Станції для бізнесу', home_url( '/biznes/' ) ),
			array( 'Станції для поливу', home_url( '/agro/' ) ),
			array( 'Обслуговування СЕС', home_url( '/obsluhovuvannia/' ) ),
		),
		'Електрика й безпека' => array(
			array( 'Електромонтаж', home_url( '/electrical-works/' ) ),
			array( 'Системи охорони', home_url( '/systemy-okhorony-ta-bezpeky/' ) ),
			array( 'Відеоспостереження', home_url( '/videosposterezhennia-cctv/' ) ),
		),
		'Компанія'            => array(
			array( 'Усі послуги', home_url( '/#posluhy' ) ),
			array( 'Кейси', home_url( '/keysy/' ) ),
			array( 'Про нас', home_url( '/pro-nas/' ) ),
			array( 'Контакти', home_url( '/kontakty/' ) ),
		),
	);
}

/** Пункти меню як [назва, url]; якщо меню не призначене, стандартний набір. */
function enray_menu_items( $location ) {
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations[ $location ] ) ) {
		$items = wp_get_nav_menu_items( $locations[ $location ] );
		if ( $items ) {
			$out = array();
			foreach ( $items as $item ) {
				if ( 0 === (int) $item->menu_item_parent ) {
					$out[] = array( $item->title, $item->url );
				}
			}
			return $out;
		}
	}
	return enray_default_menu();
}

/** Посилання меню без ul/li, з aria-current для поточної сторінки. */
function enray_footer_links() {
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['footer'] ) ) {
		enray_nav_links( 'footer' ); // призначене меню — як є, одним рядом
		return;
	}
	foreach ( enray_footer_groups() as $title => $items ) {
		echo '<div class="footer-col"><p class="footer-h">' . esc_html( $title ) . '</p>';
		foreach ( $items as $item ) {
			printf( '<a href="%s">%s</a>', esc_url( $item[1] ), esc_html( $item[0] ) );
		}
		echo '</div>';
	}
}

function enray_nav_links( $location = 'primary' ) {
	$here = untrailingslashit( strtok( home_url( add_query_arg( array() ) ), '?' ) );
	foreach ( enray_menu_items( $location ) as $item ) {
		$current = untrailingslashit( $item[1] ) === $here ? ' aria-current="page"' : '';
		printf( '<a href="%s"%s>%s</a>', esc_url( $item[1] ), $current, esc_html( $item[0] ) );
	}
}

/* ---------- Форма заявки ---------- */

/**
 * Форма заявки: Contact Form 7, якщо її ID задано в налаштуваннях теми.
 * Інакше показуємо телефон і Viber, а адміністратору — підказку, як підключити форму.
 */
function enray_request_form( $key, $service = '' ) {
	$id = absint( get_theme_mod( 'enray_cf7_' . $key ) );
	if ( $id && shortcode_exists( 'contact-form-7' ) ) {
		$extra = $service ? sprintf( ' service="%s"', esc_attr( $service ) ) : '';
		echo do_shortcode( sprintf( '[contact-form-7 id="%d" html_id="request-form" html_class="request-form"%s]', $id, $extra ) );
		return;
	}
	if ( current_user_can( 'edit_theme_options' ) ) {
		printf(
			'<p class="form-admin-note">Форма не підключена. Створіть форму Contact Form 7 з шаблону <code>cf7/%1$s.txt</code> у темі й вкажіть її ID: Зовнішній вигляд → Налаштувати → EnRay. Цей текст бачать лише адміністратори.</p>',
			esc_html( $key )
		);
	}
	printf(
		'<div class="request-fallback"><p>Зателефонуйте або напишіть у Viber, інженер відповість у робочий час.</p><a class="btn btn-primary btn-lg" href="%1$s">%2$s</a><a class="btn btn-viber btn-lg" href="%3$s">Написати у Viber</a></div>',
		esc_attr( enray_tel() ),
		esc_html( enray_opt( 'phone' ) ),
		esc_attr( enray_viber() )
	);
}

/* CF7: назва послуги з шорткоду потрапляє в приховане поле [hidden service default:shortcode_attr]. */
add_filter( 'shortcode_atts_wpcf7', function ( $out, $pairs, $atts ) {
	if ( isset( $atts['service'] ) ) {
		$out['service'] = sanitize_text_field( $atts['service'] );
	}
	return $out;
}, 10, 3 );

/* CF7: без автоматичних <p>/<br> у наших розмітках форм. */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/* ---------- Структуровані дані (Yoast їх не задає для LocalBusiness) ---------- */

add_action( 'wp_head', function () {
	if ( ! is_front_page() ) {
		return;
	}
	$data = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'LocalBusiness',
		'name'      => 'EnRay',
		'url'       => home_url( '/' ),
		'telephone' => preg_replace( '/[^0-9+]/', '', enray_opt( 'phone' ) ),
		'email'     => enray_opt( 'email' ),
		'address'   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'вул. Стрілецька, 16 А',
			'addressLocality' => 'Вінниця',
			'addressCountry'  => 'UA',
		),
		'areaServed' => 'Вінницька область',
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "</script>\n";
} );

/* ---------- Опис сторінки, якщо немає SEO-плагіна ---------- */

add_action( 'wp_head', function () {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return; // Yoast або Rank Math самі виводять description.
	}
	$desc = array(
		'front'  => 'EnRay у Вінницькій області: сонячні електростанції для дому, бізнесу й поливу, електромонтажні роботи, системи охорони й відеоспостереження. Проєкт, монтаж і сервіс від однієї команди.',
		'dim'    => 'Гібридна сонячна станція для приватного будинку у Вінницькій області: світло, котел, холодильник та інтернет під час відключень. Проєкт, монтаж і підключення від EnRay.',
		'biznes' => 'Мережеві та гібридні сонячні станції для бізнесу у Вінницькій області: менший рахунок за електроенергію, монтаж на даху чи на землі, документи й підключення від EnRay.',
		'agro'   => 'Сонячні станції для поливу та насосів у Вінницькій області, зокрема автономні: СЕС 100 кВт для поливу саду в Луці-Мелешківській. Проєкт, монтаж і запуск від EnRay.',
	);
	$key = is_front_page() ? 'front' : enray_current_scenario();
	if ( $key && isset( $desc[ $key ] ) ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc[ $key ] ) );
	}
}, 2 );

/* ---------- Іконки (спрайт виводиться в header.php) ---------- */

function enray_icon( $id ) {
	printf( '<svg class="ico" aria-hidden="true"><use href="#i-%s"/></svg>', esc_attr( $id ) );
}
