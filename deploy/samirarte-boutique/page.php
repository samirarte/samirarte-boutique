<?php
/**
 * Page template.
 *
 * @package Samirarte_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	$page_slug  = get_post_field( 'post_name', get_the_ID() );
	$is_contact = 'contacto' === $page_slug;
	$is_account = function_exists( 'is_account_page' ) && is_account_page();
	$config     = array(
		'eyebrow'      => esc_html__( 'Samirarte', 'samirarte-boutique' ),
		'title'        => get_the_title(),
		'intro'        => esc_html__( 'Una presentación editorial para descubrir propuestas gourmet, experiencias y regalos cuidados.', 'samirarte-boutique' ),
		'subtitle'     => '',
		'media'        => array(
			array(
				'url' => '',
				'alt' => esc_attr__( 'Samirarte Artesanía Gourmet', 'samirarte-boutique' ),
			),
		),
		'buttons'      => array(),
		'cards'        => array(),
		'sections'     => array(),
		'final_cta'    => array(),
		'content_mode' => 'default',
	);

	if ( in_array( $page_slug, array( 'artesania-gourmet', 'cajas-gourmet' ), true ) ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ),
			'title'        => esc_html__( 'Configura una caja regalo', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Configura una caja regalo con piezas gourmet de autor. Elige entre minipastelas, dátiles gourmet y pastas finas, selecciona el tamaño de tu caja y recibe una composición preparada como una pequeña colección de joyas comestibles. Cada caja incluye un cuento en pergamino creado para acompañar la experiencia.', 'samirarte-boutique' ),
			'media'        => array(
				array(
					'url' => samirarte_boutique_image_url( 'caja-gourmet-samirarte.webp' ),
					'alt' => esc_attr__( 'Caja gourmet Samirarte', 'samirarte-boutique' ),
				),
				array(
					'url' => samirarte_boutique_image_url( 'datiles.webp' ),
					'alt' => esc_attr__( 'Dátiles seleccionados Samirarte', 'samirarte-boutique' ),
				),
			),
			'buttons'      => array(
				array(
					'label' => esc_html__( 'Personaliza tu caja', 'samirarte-boutique' ),
					'url'   => samirarte_boutique_boxes_url() . '#caja-gourmet-personalizada',
					'class' => 'sam-button',
				),
				array(
					'label' => esc_html__( 'Ver catálogo de piezas', 'samirarte-boutique' ),
					'url'   => samirarte_boutique_boxes_url() . '#catalogo-piezas',
					'class' => 'sam-button sam-button--ghost',
				),
			),
			'cards'        => array(
				array(
					'icon'  => 'box',
					'title' => esc_html__( 'Caja de 3 piezas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Un detalle pequeño y precioso, presentado como una colección de joyas comestibles.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'date',
					'title' => esc_html__( 'Caja de 6 piezas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Un formato equilibrado para regalar, compartir o acompañar una celebración íntima.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'ribbon',
					'title' => esc_html__( 'Caja de 9 piezas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Una composición generosa para descubrir diferentes piezas y crear un recorrido de sabores.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'scroll',
					'title' => esc_html__( 'Caja de 12 piezas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'La colección completa para una ocasión especial, con presentación premium y cuento incluido.', 'samirarte-boutique' ),
				),
			),
			'sections'     => array(
				array(
					'type'  => 'steps',
					'title' => esc_html__( 'Cómo configurar tu caja', 'samirarte-boutique' ),
					'items' => array(
						array( esc_html__( 'Elige el tamaño', 'samirarte-boutique' ), esc_html__( 'Selecciona una caja de 3, 6, 9 o 12 piezas.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Selecciona tus piezas', 'samirarte-boutique' ), esc_html__( 'Combina minipastelas, dátiles gourmet y pastas finas del catálogo.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Creamos la composición', 'samirarte-boutique' ), esc_html__( 'Preparamos cada pieza y cuidamos el acabado como un regalo premium.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Añadimos la historia', 'samirarte-boutique' ), esc_html__( 'Incluimos un cuento en pergamino para acompañar la experiencia.', 'samirarte-boutique' ) ),
					),
				),
				array(
					'type'  => 'list',
					'title' => esc_html__( 'Piezas para crear tu colección', 'samirarte-boutique' ),
					'items' => array(
						esc_html__( 'Minipastelas', 'samirarte-boutique' ),
						esc_html__( 'Dátiles gourmet', 'samirarte-boutique' ),
						esc_html__( 'Pastas finas', 'samirarte-boutique' ),
						esc_html__( 'Ediciones estacionales', 'samirarte-boutique' ),
						esc_html__( 'Cuento en pergamino incluido', 'samirarte-boutique' ),
					),
				),
			),
			'final_cta'    => array(
				'title'   => esc_html__( 'Crea tu colección de joyas comestibles', 'samirarte-boutique' ),
				'text'    => esc_html__( 'Elige el tamaño, descubre el catálogo y prepara una caja lista para regalar.', 'samirarte-boutique' ),
				'buttons' => array(
					array( esc_html__( 'Personaliza tu caja', 'samirarte-boutique' ), samirarte_boutique_boxes_url() . '#caja-gourmet-personalizada', 'sam-button' ),
					array( esc_html__( 'Ver catálogo de piezas', 'samirarte-boutique' ), samirarte_boutique_boxes_url(), 'sam-button sam-button--ghost' ),
				),
			),
			'content_mode' => 'curated',
		);
	} elseif ( 'experiencias' === $page_slug ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Experiencias a medida', 'samirarte-boutique' ),
			'title'        => esc_html__( 'Experiencias Samirarte', 'samirarte-boutique' ),
			'subtitle'     => esc_html__( 'Té, cocina, relato y puesta en escena para celebraciones con alma.', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Creamos experiencias gastronómicas a medida donde cada sabor, cada gesto y cada detalle forman parte de una historia pensada para ser recordada.', 'samirarte-boutique' ),
			'media'        => array(
				array(
					'url' => samirarte_boutique_image_url( 'experiencia-privada-samirarte.webp' ),
					'alt' => esc_attr__( 'Experiencia Samirarte preparada para una celebración', 'samirarte-boutique' ),
				),
				array(
					'url' => samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' ),
					'alt' => esc_attr__( 'Mesa gourmet Samirarte', 'samirarte-boutique' ),
				),
			),
			'buttons'      => array(
				array(
					'label' => esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ),
					'url'   => home_url( '/contacto/' ),
					'class' => 'sam-button',
				),
				array(
					'label' => esc_html__( 'Ver experiencias', 'samirarte-boutique' ),
					'url'   => '#opciones',
					'class' => 'sam-button sam-button--ghost',
				),
			),
			'intro_block'  => array(
				'title' => esc_html__( 'Tres formas de vivir Samirarte', 'samirarte-boutique' ),
				'text'  => esc_html__( 'Cada experiencia Samirarte nace de una intención: reunir, emocionar y convertir la comida en un momento con significado. Desde una sobremesa íntima en torno al té hasta un evento gastronómico completo o una creación conceptual diseñada desde cero.', 'samirarte-boutique' ),
			),
			'experiences'  => array(
				array(
					'title'       => esc_html__( 'El Ritual', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'La experiencia guiada', 'samirarte-boutique' ),
					'format'      => esc_html__( 'Una sobremesa o tardeo gourmet interactivo y presencial en torno al té y los dulces de autor.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un viaje sensorial guiado donde el té premium y los bocados dulces selectos se sirven en una vajilla meticulosamente escogida. El protagonismo lo tiene la narrativa: se desvela la historia, el origen y los matices de cada pieza artesanal mientras los comensales disfrutan de una atmósfera íntima y pausada.', 'samirarte-boutique' ),
					'difference'  => esc_html__( 'Una experiencia enfocada en el universo dulce y el arte del té, ideal para tardes especiales, reuniones íntimas o momentos de sobremesa.', 'samirarte-boutique' ),
					'ideal'       => array(
						esc_html__( 'Tardeos especiales', 'samirarte-boutique' ),
						esc_html__( 'Reuniones íntimas', 'samirarte-boutique' ),
						esc_html__( 'Sobremesas cuidadas', 'samirarte-boutique' ),
						esc_html__( 'Celebraciones pequeñas', 'samirarte-boutique' ),
						esc_html__( 'Regalos experienciales', 'samirarte-boutique' ),
					),
					'cta'         => esc_html__( 'Solicitar El Ritual', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' ),
				),
				array(
					'title'       => esc_html__( 'Taller Gastronómico', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Cocina en directo y menú completo', 'samirarte-boutique' ),
					'format'      => esc_html__( 'Comidas, cenas o eventos culinarios completos con cocina en directo, showcooking o menú degustación.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un despliegue gastronómico para un evento completo, con propuestas saladas y dulces. Puede desarrollarse como menú degustación a mesa puesta o mediante estaciones gastronómicas dinámicas, donde se elaboran platos principales y bocados mediterráneos o de autor a la vista de los invitados, convirtiendo la cocina en el motor del evento.', 'samirarte-boutique' ),
					'difference'  => esc_html__( 'Un servicio de menú completo para comida o cena, con infraestructura y logística de catering para eventos salados y dulces de distinta envergadura.', 'samirarte-boutique' ),
					'ideal'       => array(
						esc_html__( 'Comidas privadas', 'samirarte-boutique' ),
						esc_html__( 'Cenas especiales', 'samirarte-boutique' ),
						esc_html__( 'Eventos familiares', 'samirarte-boutique' ),
						esc_html__( 'Celebraciones con menú completo', 'samirarte-boutique' ),
						esc_html__( 'Eventos donde la cocina forma parte del espectáculo', 'samirarte-boutique' ),
					),
					'cta'         => esc_html__( 'Solicitar Taller Gastronómico', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'experiencia-privada-samirarte.webp' ),
				),
				array(
					'title'       => esc_html__( 'Atelier Samirarte', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Creación exclusiva a medida', 'samirarte-boutique' ),
					'format'      => esc_html__( 'Laboratorio de creación exclusiva y diseño conceptual personalizado.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Una hoja en blanco absoluta. Diseñamos desde cero tanto el menú completo como la identidad visual, el concepto temático y la puesta en escena para que todo encaje con una idea, una época histórica, un hilo conductor sensorial o una campaña de marca específica del cliente.', 'samirarte-boutique' ),
					'difference'  => esc_html__( 'No se elige nada de un menú cerrado. Se inventa un concepto culinario y artístico único para encargos de autor, marcas premium o eventos con una identidad propia muy marcada.', 'samirarte-boutique' ),
					'ideal'       => array(
						esc_html__( 'Marcas premium', 'samirarte-boutique' ),
						esc_html__( 'Eventos de autor', 'samirarte-boutique' ),
						esc_html__( 'Presentaciones de producto', 'samirarte-boutique' ),
						esc_html__( 'Celebraciones conceptuales', 'samirarte-boutique' ),
						esc_html__( 'Encargos gastronómicos únicos', 'samirarte-boutique' ),
					),
					'cta'         => esc_html__( 'Solicitar Atelier', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
				),
			),
			'gallery'      => array(
				array(
					'title'       => esc_html__( 'Mesa del Ritual', 'samirarte-boutique' ),
					'type'        => esc_html__( 'Foto / vídeo', 'samirarte-boutique' ),
					'category'    => esc_html__( 'El Ritual', 'samirarte-boutique' ),
					'description' => esc_html__( 'Vajilla, té, dulces de autor y una atmósfera íntima preparada para una sobremesa guiada.', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' ),
				),
				array(
					'title'       => esc_html__( 'Cocina en directo', 'samirarte-boutique' ),
					'type'        => esc_html__( 'Vídeo', 'samirarte-boutique' ),
					'category'    => esc_html__( 'Taller Gastronómico', 'samirarte-boutique' ),
					'description' => esc_html__( 'Platos, estaciones y gestos culinarios que convierten la cocina en parte visible del evento.', 'samirarte-boutique' ),
					'image'       => '',
				),
				array(
					'title'       => esc_html__( 'Concepto de Atelier', 'samirarte-boutique' ),
					'type'        => esc_html__( 'Foto', 'samirarte-boutique' ),
					'category'    => esc_html__( 'Atelier Samirarte', 'samirarte-boutique' ),
					'description' => esc_html__( 'Bocetos, piezas, packaging y detalles creados alrededor de una idea única.', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
				),
				array(
					'title'       => esc_html__( 'Procesos y montaje', 'samirarte-boutique' ),
					'type'        => esc_html__( 'Vídeo corto', 'samirarte-boutique' ),
					'category'    => esc_html__( 'Taller Gastronómico', 'samirarte-boutique' ),
					'description' => esc_html__( 'Momentos de elaboración, servicio, montaje y acabado de una experiencia completa.', 'samirarte-boutique' ),
					'image'       => '',
				),
				array(
					'title'       => esc_html__( 'Detalle sensorial', 'samirarte-boutique' ),
					'type'        => esc_html__( 'Foto', 'samirarte-boutique' ),
					'category'    => esc_html__( 'El Ritual', 'samirarte-boutique' ),
					'description' => esc_html__( 'Bocados, té, vajilla y pequeños gestos que dan forma al relato de la mesa.', 'samirarte-boutique' ),
					'image'       => samirarte_boutique_image_url( 'pastelas.webp' ),
				),
			),
			'gallery_filters' => array(
				esc_html__( 'El Ritual', 'samirarte-boutique' ),
				esc_html__( 'Taller Gastronómico', 'samirarte-boutique' ),
				esc_html__( 'Atelier Samirarte', 'samirarte-boutique' ),
			),
			'process'      => array(
				array( esc_html__( 'Nos cuentas la ocasión', 'samirarte-boutique' ), esc_html__( 'Tipo de evento, número aproximado de personas, lugar, estilo y preferencias.', 'samirarte-boutique' ) ),
				array( esc_html__( 'Elegimos el formato', 'samirarte-boutique' ), esc_html__( 'Definimos si encaja mejor El Ritual, un Taller Gastronómico o un Atelier Samirarte.', 'samirarte-boutique' ) ),
				array( esc_html__( 'Diseñamos la propuesta', 'samirarte-boutique' ), esc_html__( 'Planteamos sabores, ritmo, puesta en escena, vajilla, narrativa y nivel de personalización.', 'samirarte-boutique' ) ),
				array( esc_html__( 'Preparamos cada detalle', 'samirarte-boutique' ), esc_html__( 'Cuidamos elaboración, montaje, presentación, servicio y experiencia final.', 'samirarte-boutique' ) ),
			),
			'final_cta'    => array(
				'title'   => esc_html__( '¿Quieres crear una experiencia Samirarte?', 'samirarte-boutique' ),
				'text'    => esc_html__( 'Cuéntanos la ocasión y prepararemos una propuesta a medida.', 'samirarte-boutique' ),
				'buttons' => array(
					array( esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ), home_url( '/contacto/' ), 'sam-button' ),
				),
			),
			'content_mode' => 'experience_landing',
		);
	} elseif ( 'cuentos' === $page_slug ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Archivo de cuentos', 'samirarte-boutique' ),
			'title'        => esc_html__( 'Cuentos enviados', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Cada caja Samirarte puede viajar acompañada de un cuento en pergamino. En esta sección reunimos algunos relatos enviados a clientes, preservando siempre su intimidad. Solo mostramos el nombre de pila y el lugar al que viajó la caja. La historia pertenece al recuerdo; los datos personales, no.', 'samirarte-boutique' ),
			'media'        => array(
				array(
					'url' => samirarte_boutique_image_url( 'cuento-pergamino-samirarte.webp' ),
					'alt' => esc_attr__( 'Cuento en pergamino Samirarte', 'samirarte-boutique' ),
				),
				array(
					'url' => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
					'alt' => esc_attr__( 'Caja Samirarte con cuento en pergamino', 'samirarte-boutique' ),
				),
			),
			'buttons'      => array(
				array(
					'label' => esc_html__( 'Encargar una caja con cuento', 'samirarte-boutique' ),
					'url'   => samirarte_boutique_boxes_url(),
					'class' => 'sam-button',
				),
				array(
					'label' => esc_html__( 'Leer archivo', 'samirarte-boutique' ),
					'url'   => '#archivo-cuentos',
					'class' => 'sam-button sam-button--ghost',
				),
			),
			'stories'      => array(
				array(
					'nombre_publico' => esc_html__( 'Nura', 'samirarte-boutique' ),
					'lugar_envio'    => esc_html__( 'Valencia', 'samirarte-boutique' ),
					'titulo_cuento'  => esc_html__( 'La semilla que recordaba el camino', 'samirarte-boutique' ),
					'extracto'       => esc_html__( 'Un cuento enviado con una caja Samirarte.', 'samirarte-boutique' ),
					'caja_asociada'  => esc_html__( 'Caja Samirarte', 'samirarte-boutique' ),
					'fecha'          => esc_html__( 'Archivo de preapertura', 'samirarte-boutique' ),
					'texto_cuento'   => array(
						esc_html__( 'Cuentan que, en una ciudad de arena clara y patios perfumados, vivía una muchacha llamada Nura, hija de un viejo mercader de especias.', 'samirarte-boutique' ),
						esc_html__( 'Su padre no vendía oro, ni sedas, ni piedras preciosas. Vendía cosas más pequeñas y más poderosas: vainas de cardamomo, cortezas de canela, pétalos secos de rosa, miel espesa y almendras tostadas. Decía que el oro brillaba solo por fuera, pero las especias sabían encender recuerdos dentro de las personas.', 'samirarte-boutique' ),
						esc_html__( 'Una tarde, cuando el sol caía como miel sobre los tejados, llegó a la ciudad una caravana antigua. Los camellos traían cofres de madera, telas bordadas y pequeños frascos cerrados con cera. El último viajero, un hombre silencioso con los ojos llenos de desierto, entregó a Nura una semilla verde.', 'samirarte-boutique' ),
						esc_html__( '—No la plantes en la tierra —le dijo—. Plántala en algo que pueda ser compartido.', 'samirarte-boutique' ),
						esc_html__( 'Nura no entendió aquellas palabras. Guardó la semilla junto al cardamomo y, durante siete noches, soñó con caminos: puertos lejanos, mercados de luz, manos que molían especias, mujeres que preparaban té, niños que esperaban un dulce al final de una fiesta.', 'samirarte-boutique' ),
						esc_html__( 'A la octava mañana, abrió el cofre de su padre y mezcló almendra, miel, azahar y una pizca de aquella semilla misteriosa. Con paciencia, envolvió la mezcla en una masa fina y dorada, pequeña como una joya.', 'samirarte-boutique' ),
						esc_html__( 'Cuando la probó, no supo decir si era dulce o recuerdo. Tenía el perfume de una noche templada, el crujido de una puerta antigua y la suavidad de una historia contada en voz baja.', 'samirarte-boutique' ),
						esc_html__( 'Desde entonces, en aquella ciudad se decía que algunas semillas no nacen para convertirse en árboles. Algunas nacen para convertirse en regalos.', 'samirarte-boutique' ),
						esc_html__( 'Y por eso, cada caja Samirarte guarda algo más que bocados: guarda un camino, una memoria y una pequeña historia esperando ser abierta.', 'samirarte-boutique' ),
					),
				),
			),
			'final_cta'    => array(
				'title'   => esc_html__( 'Encargar una caja con cuento', 'samirarte-boutique' ),
				'text'    => esc_html__( 'Cada cuento se prepara para acompañar una caja concreta y convertirse en parte del recuerdo.', 'samirarte-boutique' ),
				'buttons' => array(
					array( esc_html__( 'Encargar una caja con cuento', 'samirarte-boutique' ), samirarte_boutique_boxes_url(), 'sam-button' ),
				),
			),
			'content_mode' => 'story_archive',
		);
	} elseif ( 'galeria' === $page_slug ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Galería', 'samirarte-boutique' ),
			'title'        => esc_html__( 'El universo visual Samirarte', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Una mirada visual al universo Samirarte: cajas, bocados, detalles, procesos y momentos creados para ser recordados.', 'samirarte-boutique' ),
			'media'        => array(
				array(
					'url' => samirarte_boutique_image_url( 'galeria-caja-gourmet-16-piezas.webp' ),
					'alt' => esc_attr__( 'Caja gourmet Samirarte preparada como regalo', 'samirarte-boutique' ),
				),
				array(
					'url' => samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' ),
					'alt' => esc_attr__( 'Mesa de experiencia Samirarte', 'samirarte-boutique' ),
				),
			),
			'buttons'      => array(),
			'cards'        => array(
				array(
					'image' => samirarte_boutique_image_url( 'galeria-caja-gourmet-8-piezas.webp' ),
					'alt'   => esc_attr__( 'Caja gourmet', 'samirarte-boutique' ),
					'title' => esc_html__( 'Cajas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Composiciones de 3, 6, 9 y 12 piezas preparadas como regalos premium.', 'samirarte-boutique' ),
				),
				array(
					'image' => samirarte_boutique_image_url( 'datiles.webp' ),
					'alt'   => esc_attr__( 'Bocados gourmet', 'samirarte-boutique' ),
					'title' => esc_html__( 'Bocados', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Minipastelas, dátiles gourmet, pastas finas y detalles de cada pieza.', 'samirarte-boutique' ),
				),
				array(
					'image' => samirarte_boutique_image_url( 'pastas_finas.webp' ),
					'alt'   => esc_attr__( 'Proceso artesanal', 'samirarte-boutique' ),
					'title' => esc_html__( 'Procesos', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Elaboración, selección, montaje y acabados realizados con atención artesanal.', 'samirarte-boutique' ),
				),
				array(
					'image' => samirarte_boutique_image_url( 'experiencia-privada-samirarte.webp' ),
					'alt'   => esc_attr__( 'Experiencia privada', 'samirarte-boutique' ),
					'title' => esc_html__( 'Experiencias', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Mesas preparadas, celebraciones privadas y momentos compartidos.', 'samirarte-boutique' ),
				),
				array(
					'image' => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
					'alt'   => esc_attr__( 'Detalle de packaging', 'samirarte-boutique' ),
					'title' => esc_html__( 'Detalles', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Packaging, pergaminos, lazos y pequeños gestos que completan el regalo.', 'samirarte-boutique' ),
				),
			),
			'sections'     => array(
				array(
					'type'  => 'list',
					'title' => esc_html__( 'Contenido preparado para crecer', 'samirarte-boutique' ),
					'items' => array(
						esc_html__( 'Vídeos de producto', 'samirarte-boutique' ),
						esc_html__( 'Imágenes de cajas', 'samirarte-boutique' ),
						esc_html__( 'Imágenes de bocados', 'samirarte-boutique' ),
						esc_html__( 'Mesas preparadas', 'samirarte-boutique' ),
						esc_html__( 'Procesos artesanales', 'samirarte-boutique' ),
						esc_html__( 'Detalles de packaging', 'samirarte-boutique' ),
						esc_html__( 'Momentos de eventos', 'samirarte-boutique' ),
					),
				),
			),
			'final_cta'    => array(),
			'content_mode' => 'curated',
		);
	} elseif ( 'diario' === $page_slug ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Diario', 'samirarte-boutique' ),
			'title'        => esc_html__( 'Historias, ingredientes y rituales', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Notas, historias e inspiración alrededor de la cocina árabe, la cultura del té, los ingredientes singulares y el arte de regalar experiencias gourmet.', 'samirarte-boutique' ),
			'media'        => array(
				array(
					'url' => samirarte_boutique_image_url( 'pastas_finas.webp' ),
					'alt' => esc_attr__( 'Inspiración culinaria Samirarte', 'samirarte-boutique' ),
				),
			),
			'buttons'      => array(),
			'cards'        => array(),
			'sections'     => array(
				array(
					'type'  => 'list',
					'title' => esc_html__( 'Temas del Diario', 'samirarte-boutique' ),
					'items' => array(
						esc_html__( 'Cocina árabe', 'samirarte-boutique' ),
						esc_html__( 'Ingredientes', 'samirarte-boutique' ),
						esc_html__( 'Té y rituales', 'samirarte-boutique' ),
						esc_html__( 'Historias de bocados', 'samirarte-boutique' ),
						esc_html__( 'Celebraciones', 'samirarte-boutique' ),
						esc_html__( 'Procesos artesanales', 'samirarte-boutique' ),
					),
				),
			),
			'final_cta'    => array(),
			'content_mode' => 'curated',
		);
	} elseif ( $is_account ) {
		$config['eyebrow']      = esc_html__( 'Área cliente', 'samirarte-boutique' );
		$config['title']        = esc_html__( 'Bienvenida a tu espacio', 'samirarte-boutique' );
		$config['intro']        = esc_html__( 'Gestiona tus pedidos, preferencias y experiencias gourmet.', 'samirarte-boutique' );
		$config['media']        = array();
		$config['content_mode'] = 'account';
	} elseif ( $is_contact ) {
		$config['eyebrow']      = esc_html__( 'Diseñemos tu propuesta', 'samirarte-boutique' );
		$config['title']        = esc_html__( 'Diseñemos tu propuesta', 'samirarte-boutique' );
		$config['intro']        = esc_html__( 'Cuéntanos la ocasión, el número de personas y el tipo de detalle que quieres preparar. Te responderemos con una propuesta personalizada, cuidada en presentación, sabores y relato.', 'samirarte-boutique' );
		$config['media']        = array(
			array(
				'url' => samirarte_boutique_image_url( 'contacto-propuesta-samirarte.webp' ),
				'alt' => esc_attr__( 'Propuesta personalizada Samirarte', 'samirarte-boutique' ),
			),
		);
		$config['content_mode'] = 'contact';
	}
	?>
	<?php
	$page_class = 'sam-page';
	if ( $is_contact ) {
		$page_class .= ' sam-page--contact';
	} elseif ( $is_account ) {
		$page_class .= ' sam-page--account';
	}
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $page_class ); ?>>
		<header class="sam-page-hero sam-page-hero--visual<?php echo $is_account ? ' sam-page-hero--account' : ''; ?>">
			<div class="sam-container sam-page-hero__grid">
				<div class="sam-page-hero__copy">
					<p class="sam-eyebrow"><?php echo esc_html( $config['eyebrow'] ); ?></p>
					<h1><?php echo esc_html( $config['title'] ); ?></h1>
					<?php if ( ! empty( $config['subtitle'] ) ) : ?>
						<h2 class="sam-page-hero__subtitle"><?php echo esc_html( $config['subtitle'] ); ?></h2>
					<?php endif; ?>
					<p><?php echo esc_html( $config['intro'] ); ?></p>
					<?php if ( ! empty( $config['buttons'] ) ) : ?>
						<div class="sam-actions">
							<?php foreach ( $config['buttons'] as $button ) : ?>
								<a class="<?php echo esc_attr( $button['class'] ); ?>" href="<?php echo esc_url( $button['url'] ); ?>"><?php echo esc_html( $button['label'] ); ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( ! $is_account ) : ?>
					<div class="sam-page-hero__media">
						<?php if ( ! empty( $config['media'][0]['url'] ) ) : ?>
							<img src="<?php echo esc_url( $config['media'][0]['url'] ); ?>" alt="<?php echo esc_attr( $config['media'][0]['alt'] ); ?>" loading="lazy">
						<?php else : ?>
							<div class="sam-image-placeholder sam-image-placeholder--page" aria-hidden="true"></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</header>

		<div class="sam-container sam-page__content">
			<?php if ( 'account' === $config['content_mode'] ) : ?>
				<div class="sam-account-content">
					<?php the_content(); ?>
				</div>
			<?php elseif ( 'contact' === $config['content_mode'] ) : ?>
				<section class="sam-contact-panel" id="contacto">
					<div class="sam-contact-panel__intro">
						<h2><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></h2>
						<p><?php echo esc_html__( 'Solicitudes para cajas gourmet, experiencias privadas, regalos personalizados o cuentos en pergamino.', 'samirarte-boutique' ); ?></p>
						<?php if ( ! empty( $config['media'][0]['url'] ) ) : ?>
							<img class="sam-contact-panel__image" src="<?php echo esc_url( $config['media'][0]['url'] ); ?>" alt="<?php echo esc_attr( $config['media'][0]['alt'] ); ?>" loading="lazy">
						<?php endif; ?>
					</div>
					<div class="sam-contact-panel__form">
						<?php the_content(); ?>
					</div>
				</section>
			<?php elseif ( 'experience_landing' === $config['content_mode'] ) : ?>
				<section class="sam-experience-intro" aria-labelledby="sam-experience-intro-title">
					<div>
						<p class="sam-eyebrow"><?php echo esc_html__( 'Diseño gastronómico a medida', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-experience-intro-title"><?php echo esc_html( $config['intro_block']['title'] ); ?></h2>
					</div>
					<p><?php echo esc_html( $config['intro_block']['text'] ); ?></p>
				</section>

				<section id="opciones" class="sam-experience-types" aria-labelledby="sam-experience-types-title">
					<div class="sam-experience-section-heading">
						<p class="sam-eyebrow"><?php echo esc_html__( 'Formatos posibles', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-experience-types-title"><?php echo esc_html__( 'Tipos de experiencias', 'samirarte-boutique' ); ?></h2>
					</div>
					<div class="sam-experience-types__grid">
						<?php foreach ( $config['experiences'] as $experience ) : ?>
							<article class="sam-experience-card">
								<figure class="sam-experience-card__media">
									<?php if ( ! empty( $experience['image'] ) ) : ?>
										<img src="<?php echo esc_url( $experience['image'] ); ?>" alt="" loading="lazy">
									<?php else : ?>
										<span><?php echo esc_html__( 'Medio pendiente', 'samirarte-boutique' ); ?></span>
									<?php endif; ?>
								</figure>
								<div class="sam-experience-card__body">
									<h3><?php echo esc_html( $experience['title'] ); ?></h3>
									<?php if ( ! empty( $experience['subtitle'] ) ) : ?>
										<p class="sam-experience-card__subtitle"><?php echo esc_html( $experience['subtitle'] ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $experience['format'] ) ) : ?>
										<p class="sam-experience-card__format"><?php echo esc_html( $experience['format'] ); ?></p>
									<?php endif; ?>
									<p><?php echo esc_html( $experience['description'] ); ?></p>
									<?php if ( ! empty( $experience['difference'] ) ) : ?>
										<div class="sam-experience-card__difference">
											<strong><?php echo esc_html__( 'Diferencia clave', 'samirarte-boutique' ); ?></strong>
											<span><?php echo esc_html( $experience['difference'] ); ?></span>
										</div>
									<?php endif; ?>
									<div class="sam-experience-card__ideal">
										<strong><?php echo esc_html__( 'Ideal para', 'samirarte-boutique' ); ?></strong>
										<?php if ( is_array( $experience['ideal'] ) ) : ?>
											<ul>
												<?php foreach ( $experience['ideal'] as $ideal_item ) : ?>
													<li><?php echo esc_html( $ideal_item ); ?></li>
												<?php endforeach; ?>
											</ul>
										<?php else : ?>
											<span><?php echo esc_html( $experience['ideal'] ); ?></span>
										<?php endif; ?>
									</div>
									<a class="sam-experience-card__cta" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php echo esc_html( ! empty( $experience['cta'] ) ? $experience['cta'] : esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ) ); ?></a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

				<section id="ejemplos-experiencias" class="sam-experience-gallery" aria-labelledby="sam-experience-gallery-title">
					<div class="sam-experience-section-heading">
						<p class="sam-eyebrow"><?php echo esc_html__( 'Galería editable', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-experience-gallery-title"><?php echo esc_html__( 'Ejemplos de experiencias', 'samirarte-boutique' ); ?></h2>
						<p><?php echo esc_html__( 'Algunas ideas visuales para imaginar cómo puede adaptarse Samirarte a distintos momentos: cajas, mesas, bocados, rituales, detalles y procesos.', 'samirarte-boutique' ); ?></p>
					</div>
					<ul class="sam-experience-filters" aria-label="<?php echo esc_attr__( 'Categorías de ejemplos', 'samirarte-boutique' ); ?>">
						<?php foreach ( $config['gallery_filters'] as $filter ) : ?>
							<li><?php echo esc_html( $filter ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="sam-experience-gallery__grid">
						<?php foreach ( $config['gallery'] as $item ) : ?>
							<article class="sam-experience-example">
								<figure class="sam-experience-example__media">
									<?php if ( ! empty( $item['image'] ) ) : ?>
										<img src="<?php echo esc_url( $item['image'] ); ?>" alt="" loading="lazy">
									<?php else : ?>
										<span><?php echo esc_html__( 'Placeholder para foto o vídeo', 'samirarte-boutique' ); ?></span>
									<?php endif; ?>
									<figcaption><?php echo esc_html( $item['type'] ); ?></figcaption>
								</figure>
								<div class="sam-experience-example__body">
									<p><?php echo esc_html( $item['category'] ); ?></p>
									<h3><?php echo esc_html( $item['title'] ); ?></h3>
									<span><?php echo esc_html( $item['description'] ); ?></span>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

				<section class="sam-experience-process" aria-labelledby="sam-experience-process-title">
					<div class="sam-experience-section-heading">
						<p class="sam-eyebrow"><?php echo esc_html__( 'Proceso', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-experience-process-title"><?php echo esc_html__( 'Cómo creamos tu experiencia', 'samirarte-boutique' ); ?></h2>
					</div>
					<ol class="sam-experience-process__list">
						<?php foreach ( $config['process'] as $index => $step ) : ?>
							<li>
								<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<strong><?php echo esc_html( $step[0] ); ?></strong>
								<p><?php echo esc_html( $step[1] ); ?></p>
							</li>
						<?php endforeach; ?>
					</ol>
				</section>

				<?php if ( ! empty( $config['final_cta'] ) ) : ?>
					<section class="sam-page-final-cta sam-page-final-cta--experiences">
						<h2><?php echo esc_html( $config['final_cta']['title'] ); ?></h2>
						<p><?php echo esc_html( $config['final_cta']['text'] ); ?></p>
						<div class="sam-actions">
							<?php foreach ( $config['final_cta']['buttons'] as $button ) : ?>
								<a class="<?php echo esc_attr( $button[2] ); ?>" href="<?php echo esc_url( $button[1] ); ?>"><?php echo esc_html( $button[0] ); ?></a>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( trim( get_the_content() ) ) : ?>
					<div class="sam-content-card sam-content-card--editable">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			<?php elseif ( 'story_archive' === $config['content_mode'] ) : ?>
				<section id="archivo-cuentos" class="sam-story-archive" aria-labelledby="sam-story-archive-title">
					<div class="sam-story-archive__intro">
						<p class="sam-eyebrow"><?php echo esc_html__( 'Relatos con consentimiento', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-story-archive-title"><?php echo esc_html__( 'Archivo de cuentos enviados', 'samirarte-boutique' ); ?></h2>
						<p><?php echo esc_html__( 'Cada ficha recoge solo la parte pública de la experiencia: nombre de pila, destino de la caja y relato compartido para inspirar nuevos regalos.', 'samirarte-boutique' ); ?></p>
					</div>

					<div class="sam-story-archive__grid">
						<?php foreach ( $config['stories'] as $story ) : ?>
							<article class="sam-story-card">
								<div class="sam-story-card__header">
									<p class="sam-story-card__meta">
										<?php
										echo esc_html(
											sprintf(
												/* translators: 1: public first name, 2: destination city. */
												__( 'Para %1$s · %2$s', 'samirarte-boutique' ),
												$story['nombre_publico'],
												$story['lugar_envio']
											)
										);
										?>
									</p>
									<?php if ( ! empty( $story['fecha'] ) ) : ?>
										<span><?php echo esc_html( $story['fecha'] ); ?></span>
									<?php endif; ?>
								</div>

								<h2><?php echo esc_html( $story['titulo_cuento'] ); ?></h2>
								<p class="sam-story-card__excerpt"><?php echo esc_html( $story['extracto'] ); ?></p>

								<?php if ( ! empty( $story['caja_asociada'] ) ) : ?>
									<p class="sam-story-card__box"><?php echo esc_html( $story['caja_asociada'] ); ?></p>
								<?php endif; ?>

								<details class="sam-story-card__details" open>
									<summary><?php echo esc_html__( 'Leer cuento completo', 'samirarte-boutique' ); ?></summary>
									<div class="sam-story-card__text">
										<?php foreach ( $story['texto_cuento'] as $paragraph ) : ?>
											<p><?php echo esc_html( $paragraph ); ?></p>
										<?php endforeach; ?>
									</div>
								</details>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

				<?php if ( ! empty( $config['final_cta'] ) ) : ?>
					<section class="sam-page-final-cta sam-page-final-cta--stories">
						<h2><?php echo esc_html( $config['final_cta']['title'] ); ?></h2>
						<p><?php echo esc_html( $config['final_cta']['text'] ); ?></p>
						<div class="sam-actions">
							<?php foreach ( $config['final_cta']['buttons'] as $button ) : ?>
								<a class="<?php echo esc_attr( $button[2] ); ?>" href="<?php echo esc_url( $button[1] ); ?>"><?php echo esc_html( $button[0] ); ?></a>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( trim( get_the_content() ) ) : ?>
					<div class="sam-content-card sam-content-card--editable">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			<?php elseif ( 'curated' === $config['content_mode'] ) : ?>
				<?php if ( ! empty( $config['cards'] ) || ! empty( $config['media'][1]['url'] ) ) : ?>
					<section id="opciones" class="sam-page-showcase">
						<div class="sam-page-card-grid">
							<?php foreach ( $config['cards'] as $card ) : ?>
								<?php $card_class = ! empty( $card['image'] ) ? 'sam-feature-card sam-feature-card--image' : 'sam-feature-card'; ?>
								<div class="<?php echo esc_attr( $card_class ); ?>">
									<?php if ( ! empty( $card['image'] ) ) : ?>
										<figure class="sam-feature-card__image">
											<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['alt'] ); ?>" loading="lazy">
										</figure>
									<?php elseif ( ! empty( $card['icon'] ) ) : ?>
										<span class="sam-mini-icon sam-mini-icon--<?php echo esc_attr( $card['icon'] ); ?>" aria-hidden="true"></span>
									<?php endif; ?>
									<h2><?php echo esc_html( $card['title'] ); ?></h2>
									<p><?php echo esc_html( $card['text'] ); ?></p>
								</div>
							<?php endforeach; ?>
						</div>
						<?php if ( ! empty( $config['media'][1]['url'] ) ) : ?>
							<figure class="sam-page-editorial-image">
								<img src="<?php echo esc_url( $config['media'][1]['url'] ); ?>" alt="<?php echo esc_attr( $config['media'][1]['alt'] ); ?>" loading="lazy">
							</figure>
						<?php endif; ?>
					</section>
				<?php endif; ?>

				<?php foreach ( $config['sections'] as $section ) : ?>
					<section <?php echo ! empty( $section['id'] ) ? 'id="' . esc_attr( $section['id'] ) . '"' : ''; ?> class="sam-content-card sam-content-card--<?php echo esc_attr( $section['type'] ); ?>">
						<h2><?php echo esc_html( $section['title'] ); ?></h2>
						<?php if ( 'intro' === $section['type'] || 'note' === $section['type'] ) : ?>
							<p><?php echo esc_html( $section['text'] ); ?></p>
						<?php elseif ( 'quote' === $section['type'] ) : ?>
							<blockquote><?php echo esc_html( $section['quote'] ); ?></blockquote>
							<p><?php echo esc_html( $section['secondary'] ); ?></p>
						<?php elseif ( 'steps' === $section['type'] ) : ?>
							<ol class="sam-process-list">
								<?php foreach ( $section['items'] as $item ) : ?>
									<li>
										<strong><?php echo esc_html( $item[0] ); ?></strong>
										<span><?php echo esc_html( $item[1] ); ?></span>
									</li>
								<?php endforeach; ?>
							</ol>
						<?php elseif ( 'list' === $section['type'] ) : ?>
							<ul class="sam-pill-list">
								<?php foreach ( $section['items'] as $item ) : ?>
									<li><?php echo esc_html( $item ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</section>
				<?php endforeach; ?>

				<?php if ( ! empty( $config['final_cta'] ) ) : ?>
					<section class="sam-page-final-cta">
						<h2><?php echo esc_html( $config['final_cta']['title'] ); ?></h2>
						<p><?php echo esc_html( $config['final_cta']['text'] ); ?></p>
						<div class="sam-actions">
							<?php foreach ( $config['final_cta']['buttons'] as $button ) : ?>
								<a class="<?php echo esc_attr( $button[2] ); ?>" href="<?php echo esc_url( $button[1] ); ?>"><?php echo esc_html( $button[0] ); ?></a>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<?php if ( trim( get_the_content() ) ) : ?>
					<div class="sam-content-card sam-content-card--editable">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<div class="sam-content-card">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
