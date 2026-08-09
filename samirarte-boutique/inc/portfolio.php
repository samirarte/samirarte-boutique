<?php
/**
 * Register Portfolio custom post type (Proyectos)
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'samirarte_register_portfolio_cpt' ) ) {
	function samirarte_register_portfolio_cpt() {
		$labels = array(
			'name'               => _x( 'Proyectos', 'post type general name', 'samirarte-boutique' ),
			'singular_name'      => _x( 'Proyecto', 'post type singular name', 'samirarte-boutique' ),
			'menu_name'          => _x( 'Proyectos', 'admin menu', 'samirarte-boutique' ),
			'name_admin_bar'     => _x( 'Proyecto', 'add new on admin bar', 'samirarte-boutique' ),
			'add_new'            => _x( 'Añadir nuevo', 'proyecto', 'samirarte-boutique' ),
			'add_new_item'       => __( 'Añadir nuevo proyecto', 'samirarte-boutique' ),
			'new_item'           => __( 'Nuevo proyecto', 'samirarte-boutique' ),
			'edit_item'          => __( 'Editar proyecto', 'samirarte-boutique' ),
			'view_item'          => __( 'Ver proyecto', 'samirarte-boutique' ),
			'all_items'          => __( 'Todos los proyectos', 'samirarte-boutique' ),
			'search_items'       => __( 'Buscar proyectos', 'samirarte-boutique' ),
			'parent_item_colon'  => __( 'Proyecto padre:', 'samirarte-boutique' ),
			'not_found'          => __( 'No se han encontrado proyectos.', 'samirarte-boutique' ),
			'not_found_in_trash' => __( 'No hay proyectos en la papelera.', 'samirarte-boutique' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'proyectos' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
		);

		register_post_type( 'portfolio', $args );
	}
	add_action( 'init', 'samirarte_register_portfolio_cpt' );
}