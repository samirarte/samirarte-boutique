<?php
/**
 * Menu helpers extracted from functions.php
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_boutique_primary_links' ) ) {
	function samirarte_boutique_primary_links() {
		return array(
			array( esc_html__( 'Inicio', 'samirarte-boutique' ), home_url( '/' ) ),
			array( esc_html__( 'Tienda', 'samirarte-boutique' ), samirarte_boutique_shop_url(), 'sam-menu-item-shop' ),
			array( esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ), samirarte_boutique_boxes_url() ),
			array( esc_html__( 'Experiencias', 'samirarte-boutique' ), home_url( '/experiencias/' ) ),
			array( esc_html__( 'Galería', 'samirarte-boutique' ), home_url( '/galeria/' ) ),
			array( esc_html__( 'Cuentos', 'samirarte-boutique' ), home_url( '/cuentos/' ) ),
			array( esc_html__( 'Diario', 'samirarte-boutique' ), samirarte_boutique_diary_url() ),
		);
	}
}

if ( ! function_exists( 'samirarte_boutique_primary_menu' ) ) {
	function samirarte_boutique_primary_menu( $menu_class = 'sam-site-menu' ) {
		echo '<ul class="' . esc_attr( $menu_class ) . '">';
		foreach ( samirarte_boutique_primary_links() as $item ) {
			printf(
				'<li%3$s><a href="%1$s">%2$s</a></li>',
				esc_url( $item[1] ),
				esc_html( $item[0] ),
				! empty( $item[2] ) ? ' class="' . esc_attr( $item[2] ) . '"' : ''
			);
		}
		echo '</ul>';
	}
}

if ( ! function_exists( 'samirarte_boutique_fallback_menu' ) ) {
	function samirarte_boutique_fallback_menu( $args = array() ) {
		$menu_class = 'sam-site-menu';

		if ( is_object( $args ) && ! empty( $args->menu_class ) ) {
			$menu_class = $args->menu_class;
		} elseif ( is_array( $args ) && ! empty( $args['menu_class'] ) ) {
			$menu_class = $args['menu_class'];
		}

		samirarte_boutique_primary_menu( $menu_class );
	}
}

if ( ! function_exists( 'samirarte_remove_phone_whatsapp_menu_items' ) ) {
	function samirarte_remove_phone_whatsapp_menu_items( $items, $args ) {
		foreach ( $items as $key => $item ) {
			$title = isset( $item->title ) ? trim( $item->title ) : '';
			$url   = isset( $item->url ) ? $item->url : '';

			if ( strpos( $title, '+34676679064' ) !== false
				|| strpos( $url, 'tel:+34676679064' ) !== false
				|| strpos( $url, 'wa.me/34676679064' ) !== false
				|| stripos( $title, 'whatsapp' ) !== false
			) {
				unset( $items[ $key ] );
			}
		}

		return array_values( $items );
	}
}
add_filter( 'wp_nav_menu_objects', 'samirarte_remove_phone_whatsapp_menu_items', 10, 2 );

if ( ! function_exists( 'samirarte_boutique_add_shop_menu_item' ) ) {
	function samirarte_boutique_add_shop_menu_item( $items, $args ) {
		$theme_location = isset( $args->theme_location ) ? (string) $args->theme_location : '';

		if ( ! in_array( $theme_location, array( 'primary', 'primary_menu' ), true ) ) {
			return $items;
		}

		$items           = array_values( $items );
		$shop_url        = untrailingslashit( samirarte_boutique_shop_url() );
		$home_url        = untrailingslashit( home_url( '/' ) );
		$home_position   = null;
		$shop_position   = null;

		foreach ( $items as $index => $item ) {
			$item_url   = isset( $item->url ) ? untrailingslashit( (string) $item->url ) : '';
			$item_title = isset( $item->title ) ? trim( wp_strip_all_tags( (string) $item->title ) ) : '';

			if ( $home_url === $item_url || 0 === strcasecmp( 'Inicio', $item_title ) ) {
				$home_position = $index;
			}

			if ( $shop_url === $item_url || 0 === strcasecmp( 'Tienda', $item_title ) ) {
				$shop_position = $index;
			}
		}

		$insert_position = null !== $home_position ? $home_position + 1 : 0;

		if ( null !== $shop_position ) {
			$shop_item = $items[ $shop_position ];
			array_splice( $items, $shop_position, 1 );

			if ( $shop_position < $insert_position ) {
				$insert_position--;
			}
		} else {
			$shop_item                   = new stdClass();
			$shop_item->ID               = 0;
			$shop_item->db_id            = 0;
			$shop_item->menu_item_parent = 0;
			$shop_item->object_id        = 0;
			$shop_item->object           = 'custom';
			$shop_item->type             = 'custom';
			$shop_item->type_label       = esc_html__( 'Enlace personalizado', 'samirarte-boutique' );
			$shop_item->title            = esc_html__( 'Tienda', 'samirarte-boutique' );
			$shop_item->url              = samirarte_boutique_shop_url();
			$shop_item->target           = '';
			$shop_item->attr_title       = '';
			$shop_item->description      = '';
			$shop_item->classes          = array( 'menu-item', 'menu-item-type-custom' );
			$shop_item->xfn              = '';
		}

		$shop_item->classes = isset( $shop_item->classes ) && is_array( $shop_item->classes ) ? $shop_item->classes : array();
		$shop_item->classes = array_values( array_unique( array_merge( $shop_item->classes, array( 'sam-menu-item-shop' ) ) ) );
		$shop_item->current = function_exists( 'is_shop' ) && is_shop();
		$shop_item->current_item_parent   = false;
		$shop_item->current_item_ancestor = false;

		array_splice( $items, $insert_position, 0, array( $shop_item ) );

		return $items;
	}
}
add_filter( 'wp_nav_menu_objects', 'samirarte_boutique_add_shop_menu_item', 20, 2 );

// New helper: render a dynamic nav using the 'primary' theme location when available
if ( ! function_exists( 'samirarte_boutique_nav' ) ) {
	function samirarte_boutique_nav( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => '',
			'menu_class'      => isset( $args['menu_class'] ) ? $args['menu_class'] : 'sam-site-menu',
			'fallback_cb'     => 'samirarte_boutique_fallback_menu',
		);

		$nav_args = wp_parse_args( $args, $defaults );
		wp_nav_menu( $nav_args );
	}
}
