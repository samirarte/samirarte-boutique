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

	// If the editor has content (blocks or classic), render it directly so pages are fully editable from WP admin.
	if ( has_blocks( get_the_ID() ) || trim( get_the_content() ) !== '' ) {
		echo '<div class="sam-page-content">';
		the_content();
		echo '</div>';
		continue;
	}

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

	if ( 'cajas-gourmet' === $page_slug ) {
		$config['eyebrow']      = esc_html__( 'Cajas Gourmet', 'samirarte-boutique' );
		$config['title']        = esc_html__( 'Cajas gourmet listas para pedir', 'samirarte-boutique' );
		$config['intro']        = esc_html__( 'Compra cajas definidas con precio visible o solicita una propuesta cuando el pedido necesite diseño, muchas unidades o una composición compleja.', 'samirarte-boutique' );
		$config['content_mode'] = 'boxes_landing';
	} elseif ( 'artesania-gourmet' === $page_slug ) {
		$config = array(
			'eyebrow'      => esc_html__( 'Cajas Gourmet', 'samirarte-boutique' ),
			'title'        => esc_html__( 'Cajas gourmet con precio visible', 'samirarte-boutique' ),
			'intro'        => esc_html__( 'Elige entre cajas definidas y encargos ya realizados, con precio y descripción visibles en WooCommerce. Las peticiones complejas se valoran siempre bajo solicitud y propuesta previa.', 'samirarte-boutique' ),
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
					'label' => esc_html__( 'Ver cajas con precio', 'samirarte-boutique' ),
					'url'   => samirarte_boutique_boxes_url() . '#catalogo-cajas',
					'class' => 'sam-button',
				),
				array(
					'label' => esc_html__( 'Ver tipos de caja', 'samirarte-boutique' ),
					'url'   => samirarte_boutique_boxes_url() . '#catalogo-cajas',
					'class' => 'sam-button sam-button--ghost',
				),
			),
			'cards'        => array(
				array(
					'icon'  => 'box',
					'title' => esc_html__( 'Caja de dátiles gourmet', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Un producto cerrado con su propio precio, pensado para regalar o compartir.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'date',
					'title' => esc_html__( 'Caja de pastas finas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Pastas delicadas preparadas como caja de producto con precio propio.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'ribbon',
					'title' => esc_html__( 'Caja surtida Samirarte', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Una selección combinada de productos gourmet con descripción y precio visibles.', 'samirarte-boutique' ),
				),
				array(
					'icon'  => 'scroll',
					'title' => esc_html__( 'Caja regalo con cuento', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Una caja de producto acompañada por un relato en pergamino cuando el regalo pide historia.', 'samirarte-boutique' ),
				),
			),
			'sections'     => array(
				array(
					'type'  => 'steps',
					'title' => esc_html__( 'Cómo funciona la tienda', 'samirarte-boutique' ),
					'items' => array(
						array( esc_html__( 'Elige un tipo de caja', 'samirarte-boutique' ), esc_html__( 'Consulta cajas de productos diferentes y encargos ya realizados.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Revisa precio y disponibilidad', 'samirarte-boutique' ), esc_html__( 'WooCommerce muestra el precio configurado para cada caja de producto.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Compra o consulta', 'samirarte-boutique' ), esc_html__( 'Los productos cerrados se pueden pedir desde la tienda; los complejos pasan a propuesta.', 'samirarte-boutique' ) ),
						array( esc_html__( 'Propuesta para casos especiales', 'samirarte-boutique' ), esc_html__( 'Eventos, muchas unidades, montajes o relatos muy personalizados se valoran antes de confirmar.', 'samirarte-boutique' ) ),
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
				'title'   => esc_html__( 'Elige una caja o pide una propuesta', 'samirarte-boutique' ),
				'text'    => esc_html__( 'Compra cajas de producto con precio visible o cuéntanos el pedido complejo que quieres preparar.', 'samirarte-boutique' ),
				'buttons' => array(
					array( esc_html__( 'Ver cajas con precio', 'samirarte-boutique' ), samirarte_boutique_boxes_url() . '#catalogo-cajas', 'sam-button' ),
					array( esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ), samirarte_boutique_boxes_url() . '#pedido-complejo', 'sam-button sam-button--ghost' ),
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
					'description' => esc_html__( 'Una sobremesa gourmet guiada en torno al té premium y los bocados dulces de autor. Una experiencia íntima, pausada y sensorial para compartir historias, sabores y detalles cuidados.', 'samirarte-boutique' ),
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
					'description' => esc_html__( 'Una experiencia culinaria completa con cocina en directo, menú degustación o showcooking. Ideal para encuentros privados, celebraciones y eventos donde la gastronomía forma parte del espectáculo.', 'samirarte-boutique' ),
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
					'description' => esc_html__( 'Una propuesta creada a medida para marcas, eventos o encargos especiales. Diseñamos una experiencia visual y gastronómica con identidad propia, cuidando concepto, presentación y narrativa.', 'samirarte-boutique' ),
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
			'workshops'    => array(
				array(
					'title'       => esc_html__( 'Ceremonia del Té y Maamoul', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Ritual, aroma y repostería de dátil y azahar.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un taller que combina ceremonia del té, modelado manual y dulces rellenos de dátil, almendra y agua de azahar. Una experiencia pausada, aromática y social, pensada para cerrar en mesa con degustación compartida.', 'samirarte-boutique' ),
					'details'     => esc_html__( 'Formato participativo · 3 horas · por estaciones', 'samirarte-boutique' ),
					'sensory'     => array(
						esc_html__( 'Vertido del té en altura y sonido ceremonial.', 'samirarte-boutique' ),
						esc_html__( 'Modelado manual de piezas, una a una.', 'samirarte-boutique' ),
						esc_html__( 'Degustación final con té y dulces recién elaborados.', 'samirarte-boutique' ),
					),
				),
				array(
					'title'       => esc_html__( 'Ghriba: el Secreto del Agrietado', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Texturas arenosas y horneado de precisión.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un taller centrado en la textura de la ghriba, el punto exacto de arenado de la masa, los aromas de frutos secos tostados y el agrietado perfecto al horno.', 'samirarte-boutique' ),
					'details'     => esc_html__( 'Formato participativo · 3 horas · por estaciones', 'samirarte-boutique' ),
					'sensory'     => array(
						esc_html__( 'Trabajo de la masa con la punta de los dedos.', 'samirarte-boutique' ),
						esc_html__( 'Búsqueda del agrietado exacto.', 'samirarte-boutique' ),
						esc_html__( 'Degustación con infusión aromática.', 'samirarte-boutique' ),
					),
				),
				array(
					'title'       => esc_html__( 'Pastela: el Arte de lo Crujiente', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Tres rellenos, una misma búsqueda de textura.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un taller dedicado a la pastela individual, trabajando el equilibrio entre rellenos jugosos y exterior crujiente. Cada participante monta sus propias piezas y descubre el contraste entre aroma, textura y corte.', 'samirarte-boutique' ),
					'details'     => esc_html__( 'Formato participativo · 3 horas · por estaciones', 'samirarte-boutique' ),
					'sensory'     => array(
						esc_html__( 'El crujido como prueba final de la técnica.', 'samirarte-boutique' ),
						esc_html__( 'Tres aromas y rellenos distintos.', 'samirarte-boutique' ),
						esc_html__( 'Cata compartida de variedades.', 'samirarte-boutique' ),
					),
				),
				array(
					'title'       => esc_html__( 'Tajín de Kefta y Especias Sorpresa', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Aromas que se revelan al destapar.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Una experiencia construida alrededor del tajín, la cocción lenta y una cata inicial de especias a ciegas. El taller culmina con el destapado en mesa y la liberación de los aromas concentrados.', 'samirarte-boutique' ),
					'details'     => esc_html__( 'Formato participativo · 3 horas · por estaciones', 'samirarte-boutique' ),
					'sensory'     => array(
						esc_html__( 'Cata a ciegas de especias.', 'samirarte-boutique' ),
						esc_html__( 'Cocción lenta y sonido del borboteo.', 'samirarte-boutique' ),
						esc_html__( 'Destapado final en mesa.', 'samirarte-boutique' ),
					),
				),
				array(
					'title'       => esc_html__( 'Mlaoui y Rghaif: el Arte del Pliegue', 'samirarte-boutique' ),
					'subtitle'    => esc_html__( 'Capas, calor de plancha y relleno a elegir.', 'samirarte-boutique' ),
					'description' => esc_html__( 'Un taller dedicado a panes plegados de sartén, trabajando capas, aceite, mantequilla y rellenos. Cada participante amasa, dobla, cocina y degusta sus propias piezas.', 'samirarte-boutique' ),
					'details'     => esc_html__( 'Formato participativo · 3 horas · por estaciones', 'samirarte-boutique' ),
					'sensory'     => array(
						esc_html__( 'Técnica manual del pliegue.', 'samirarte-boutique' ),
						esc_html__( 'Chisporroteo de la masa en la plancha.', 'samirarte-boutique' ),
						esc_html__( 'Capas que se abren al partir el pan.', 'samirarte-boutique' ),
					),
				),
			),
			'gallery'      => array(
				array(
					'title'       => esc_html__( 'Mesa del Ritual', 'samirarte-boutique' ),
					'category'    => esc_html__( 'El Ritual', 'samirarte-boutique' ),
					'description' => esc_html__( 'Vajilla, té, dulces de autor y una atmósfera íntima preparada para una sobremesa guiada.', 'samirarte-boutique' ),
					'video'       => get_template_directory_uri() . '/assets/video/ritual.mp4',
					'image'       => samirarte_boutique_image_url( 'mesa-gourmet-samirarte.webp' ),
				),
				array(
					'title'       => esc_html__( 'Cocina en directo', 'samirarte-boutique' ),
					'category'    => esc_html__( 'Taller Gastronómico', 'samirarte-boutique' ),
					'description' => esc_html__( 'Platos, estaciones y gestos culinarios que convierten la cocina en parte visible del evento.', 'samirarte-boutique' ),
					'video'       => get_template_directory_uri() . '/assets/video/taller.mp4',
					'image'       => '',
				),
				array(
					'title'       => esc_html__( 'Concepto de Atelier', 'samirarte-boutique' ),
					'category'    => esc_html__( 'Atelier Samirarte', 'samirarte-boutique' ),
					'description' => esc_html__( 'Bocetos, piezas, packaging y detalles creados alrededor de una idea única.', 'samirarte-boutique' ),
					'video'       => get_template_directory_uri() . '/assets/video/atelier.mp4',
					'image'       => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
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
					'fecha'          => esc_html__( 'Archivo Samirarte', 'samirarte-boutique' ),
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
				array(
					'nombre_publico' => esc_html__( 'Cris y Pepe', 'samirarte-boutique' ),
					'lugar_envio'    => esc_html__( 'Alcañiz (Teruel)', 'samirarte-boutique' ),
					'titulo_cuento'  => esc_html__( 'La Leyenda de la Raíz de Fuego y la Flor del Reposo', 'samirarte-boutique' ),
					'extracto'       => esc_html__( 'Un relato sobre el jengibre dorado, el agua de azahar y el equilibrio que nace cuando el fuego encuentra reposo.', 'samirarte-boutique' ),
					'caja_asociada'  => esc_html__( 'Mira la caja para Cris y Pepe', 'samirarte-boutique' ),
					'caja_url'       => 'https://www.instagram.com/reel/DcEgTBos_DQ/?utm_source=ig_web_copy_link&igsi=NTc4MTIwNjQ2YQ==',
					'caja_thumbnail' => 'regalocrisypepe.png',
					'fecha'          => esc_html__( 'Archivo Samirarte', 'samirarte-boutique' ),
					'texto_cuento'   => array(
						esc_html__( 'Cuentan los antiguos maestros artesanos de las Medinas, aquellos que amasan con el alma y endulzan con la memoria, que cada ingrediente de nuestra gastronomía no fue elegido por el azar, sino que encierra un secreto del universo. Dicen que las recetas no solo alimentan el cuerpo, sino que narran la esencia inmaterial de quienes las comparten. Esta es una de esas historias, escrita en el lenguaje antiguo de las especias y las flores.', 'samirarte-boutique' ),
						esc_html__( 'Para comprender la fuerza de este relato, hay que escuchar primero la leyenda del sinjibir, el jengibre dorado. Cuentan las sabias abuelas que esta raíz milenaria no se limita a crecer, sino que palpita bajo la tierra, guardando celosamente en su interior la luz y la fuerza del sol. En nuestros dulces tradicionales, el jengibre representa la pura energía; es esa chispa vital, radiante e incansable que despierta los sentidos y pone el mundo en movimiento. Pero, desde tiempos inmemoriales, es también el mayor símbolo de protección: su calor inconfundible abraza desde dentro, ahuyenta el viento frío de la adversidad y levanta una poderosa muralla cálida e invisible alrededor del hogar. Es el impulso inagotable que ilumina los días y el escudo inquebrantable que resguarda a los que ama.', 'samirarte-boutique' ),
						esc_html__( 'Como contrapeso perfecto a este fuego vital, la naturaleza nos regala el milagro del naranjo amargo y su flor, zahr, el destilado de agua de azahar. Cuenta la tradición que este árbol debe resistir estoicamente las heladas y los vientos más hostiles, moldeando sus ramas con el tiempo, para poder finalmente florecer. Es, por tanto, el emblema eterno de la superación y de la vida que se abre paso. Tras la dureza del clima, brota una pequeña flor blanca cuya esencia destila una infinita serenidad. Un aroma que, con solo acariciar el aire, aquieta los pensamientos y ofrece un remanso de paz. Cuando esta gota fragante humedece la masa y se une al dulzor de la almendra, revela una ternura inmensa que reconforta hasta el corazón más cansado. Es el alma que ha sabido florecer a pesar de las tormentas, ofreciendo siempre un refugio de calma, quietud y lealtad.', 'samirarte-boutique' ),
						esc_html__( 'Por separado, la raíz vibrante y la flor paciente son joyas invaluables de la tierra. Pero cuando el destino las une en el silencioso obrador de la vida —como en el corazón de los dulces más exquisitos de Marruecos—, ocurre el verdadero milagro. La energía protectora encuentra su equilibrio perfecto, descansando al fin en la tierna serenidad. El fuego no quema, sino que mantiene vivo el calor del hogar; y el agua mansa no apaga la llama, sino que la hace eterna, creando un sabor único, profundo e inolvidable que desafía el paso del tiempo.', 'samirarte-boutique' ),
					),
				),
				array(
					'nombre_publico' => esc_html__( 'Antonio', 'samirarte-boutique' ),
					'lugar_envio'    => esc_html__( 'Valencia', 'samirarte-boutique' ),
					'titulo_cuento'  => esc_html__( 'La Leyenda de las Semillas de Luz', 'samirarte-boutique' ),
					'extracto'       => esc_html__( 'Un cuento sobre el amor silencioso que se amasa de madrugada y llega envuelto en aroma de azahar.', 'samirarte-boutique' ),
					'caja_asociada'  => esc_html__( 'Mira la caja para Víctor', 'samirarte-boutique' ),
					'caja_url'       => 'https://www.instagram.com/reel/DcZNbfNMSuL/?utm_source=ig_web_copy_link&igsi=NTc4MTIwNjQ2YQ==',
					'caja_thumbnail' => 'reagalo_antonio.png',
					'fecha'          => esc_html__( 'Archivo Samirarte', 'samirarte-boutique' ),
					'texto_cuento'   => array(
						esc_html__( 'El silencio de la medianoche envolvía la cocina. Allí estaba ella, con las manos curtidas de quien libra batallas diarias, amasando con el tacto suave de quien ama sin reservas. Sobre la mesa, los dátiles palpitaban con una extraña luz ambarina.', 'samirarte-boutique' ),
						esc_html__( 'En la habitación contigua descansaba él, un hombre de alma inmensa; un padre maravilloso que fue el refugio de muchos y que ahora encontraba su puerto seguro en los inagotables cuidados de una mujer de hierro y miel.', 'samirarte-boutique' ),
						esc_html__( 'Aunque estaban solos, el aire se saturó de una presencia antigua y protectora. Una pizca de canela, el suspiro del agua de azahar y el calor del clavo levitaron por unos instantes. Caían sobre el cuenco guiados por una brisa invisible, como si entidades de otro mundo acudieran a sostener los brazos de la mujer cuando el cansancio amenazaba con doblarla.', 'samirarte-boutique' ),
						esc_html__( 'La leyenda de aquellos dulces hablaba de unas «semillas secretas». En el corazón de esas madrugadas se revelaba el verdadero misterio: mientras ella velaba el sueño, finas motas de luz plateada —polvo estelar indetectable de día— descendían de la nada para fundirse con el almíbar hirviendo. Esas semillas no eran de este mundo. Eran la cristalización de una devoción pura, el milagro sobrenatural de dos almas que se sostienen.', 'samirarte-boutique' ),
						esc_html__( 'Al alba, el aroma del horneado llenó la casa. Ella tomó el primer dulce aún tibio y se lo ofreció al hombre justo cuando abría los ojos. Al compartir aquel bocado, el crujido dio paso a una oleada de paz inexplicable. En ese sabor habitaba un «gracias» mudo, inmenso y eterno, flotando brillante entre dos personas que, desafiando al tiempo, se siguen salvando cada día.', 'samirarte-boutique' ),
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
					'url' => samirarte_boutique_image_url( 'mesa-gourmet-samirarte_2.webp' ),
					'alt' => esc_attr__( 'Mesa de experiencia Samirarte', 'samirarte-boutique' ),
					'class' => 'sam-page-editorial-image--mesa-gourmet',
				),
			),
			'buttons'      => array(),
			'cards'        => array(
				array(
					'image' => samirarte_boutique_image_url( 'galeria-caja-gourmet-8-piezas.webp' ),
					'alt'   => esc_attr__( 'Caja gourmet', 'samirarte-boutique' ),
					'title' => esc_html__( 'Cajas', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Cajas de productos diferentes preparadas como regalos premium, cada una con su precio y descripción.', 'samirarte-boutique' ),
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
					'image' => samirarte_boutique_image_url( 'experiencia-privada-samirarte_2.webp' ),
					'alt'   => esc_attr__( 'Experiencia privada', 'samirarte-boutique' ),
					'title' => esc_html__( 'Experiencias', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Mesas preparadas, celebraciones privadas y momentos compartidos.', 'samirarte-boutique' ),
				),
				array(
					'image' => samirarte_boutique_image_url( 'packaging-regalo-samirarte.webp' ),
					'alt'   => esc_attr__( 'Detalle de packaging', 'samirarte-boutique' ),
					'title' => esc_html__( 'Detalles', 'samirarte-boutique' ),
					'text'  => esc_html__( 'Packaging, pergaminos, lazos y pequeños gestos que completan el regalo.', 'samirarte-boutique' ),
					'class' => 'sam-gallery-card--details',
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
			'eyebrow'         => esc_html__( 'Diario', 'samirarte-boutique' ),
			'title'           => esc_html__( 'Diario', 'samirarte-boutique' ),
			'subtitle'        => esc_html__( 'Notas sobre gastronomía, rituales, ingredientes y detalles con historia.', 'samirarte-boutique' ),
			'intro'           => esc_html__( 'Un espacio editorial para compartir inspiración, cultura del té, artesanía gourmet y relatos del universo Samirarte.', 'samirarte-boutique' ),
			'media'           => array(
				array(
					'url' => samirarte_boutique_image_url( 'pastas_finas.webp' ),
					'alt' => esc_attr__( 'Inspiración culinaria Samirarte', 'samirarte-boutique' ),
				),
			),
			'buttons'         => array(),
			'cards'           => array(),
			'sections'        => array(),
			'journal_entries' => array(
				array(
					'slug'        => 'secretos-ancestrales-del-datil',
					'label'       => esc_html__( '24 agosto 2026', 'samirarte-boutique' ),
					'title'       => esc_html__( 'Secretos ancestrales del dátil: el elixir del desierto en la mesa gourmet', 'samirarte-boutique' ),
					'description' => esc_html__( 'Descubre los secretos milenarios del dátil, desde la maceración en especias hasta el elixir robb, y cómo aplicarlos en la alta cocina gourmet.', 'samirarte-boutique' ),
					'pubDate'     => '2026-08-24',
					'author'      => esc_html__( 'Samirarte', 'samirarte-boutique' ),
					'tags'        => array( 'gastronomia', 'datiles', 'recetas-ancestrales', 'gourmet' ),
					'draft'       => false,
					'paragraphs'  => array(
						esc_html__( 'Durante milenios, el dátil no fue considerado un simple alimento, sino un verdadero tesoro de vida. En las vastas rutas de caravanas y en los oasis del desierto, la palmera datilera era venerada como el «árbol de la vida». En el obrador de Samirarte, recogemos ese legado de sabiduría antigua para llevar a tu mesa técnicas y combinaciones que han atravesado siglos de tradición.', 'samirarte-boutique' ),
						esc_html__( 'Estos son algunos de los secretos ancestrales que transforman al dátil en una joya gastronómica:', 'samirarte-boutique' ),
					),
					'items'       => array(
						array(
							'title' => esc_html__( 'El arte de la maceración en especias:', 'samirarte-boutique' ),
							'text'  => esc_html__( 'En la antigüedad, los dátiles se maceraban junto a cardamomo, canela en rama y clavos de olor en vasijas de barro. Este reposo lento permite que las especias infusionen la carne del fruto, creando un contraste aromático que equilibra su dulzor natural.', 'samirarte-boutique' ),
						),
						array(
							'title' => esc_html__( 'La manteca natural de la cocina antigua:', 'samirarte-boutique' ),
							'text'  => esc_html__( 'Antes de la repostería moderna, la pasta de dátil cocida a fuego lento con unas gotas de agua de azahar o rosa se utilizaba como aglutinante noble. Aporta a los dulces una textura melosa e inalterable, manteniendo la humedad de las masas durante días de forma 100% natural.', 'samirarte-boutique' ),
						),
						array(
							'title' => esc_html__( 'El elixir concentrado (Robb):', 'samirarte-boutique' ),
							'text'  => esc_html__( 'Tradicionalmente, la reducción prolongada del jugo de dátil daba lugar a un jarabe oscuro y denso. Este arrope ancestral se utilizaba tanto para endulzar infusiones como para glasear platos salados, aportando notas profundas de toffee y tostado.', 'samirarte-boutique' ),
						),
						array(
							'title' => esc_html__( 'El maridaje con frutos secos tostados:', 'samirarte-boutique' ),
							'text'  => esc_html__( 'La combinación clásica de dátil relleno de almendra o nuez tostada a la leña responde a un sabio equilibrio de texturas y nutrientes. El amargor sutil del fruto seco recién tostado rompe la densidad del dátil, creando un bocado redondo en paladar.', 'samirarte-boutique' ),
						),
					),
					'closing'     => esc_html__( 'Respetar los tiempos de elaboración y el origen del fruto es nuestra forma de rendir tributo a una tradición milenaria donde la cocina es, ante todo, arte y memoria.', 'samirarte-boutique' ),
				),
				array(
					'label'      => esc_html__( 'Primera entrada', 'samirarte-boutique' ),
					'title'      => esc_html__( 'Bienvenida al diario de Samirarte', 'samirarte-boutique' ),
					'closing'    => esc_html__( 'Bienvenida a los sabores que cuentan historias.', 'samirarte-boutique' ),
					'paragraphs' => array(
						esc_html__( 'Hay proyectos que nacen para vender un producto. Samirarte nace para contar una historia.', 'samirarte-boutique' ),
						esc_html__( 'Este diario será un espacio íntimo y vivo dentro de nuestra web: un lugar donde compartir el origen de nuestras piezas, la inspiración de cada caja, los rituales del té, los ingredientes que nos emocionan y las pequeñas decisiones que convierten un bocado en un recuerdo. Aquí hablaremos de sabores, de artesanía, de celebraciones, de hospitalidad y de esa forma especial de regalar algo que no se consume solo con el paladar, sino también con la memoria.', 'samirarte-boutique' ),
						esc_html__( 'Samirarte es una invitación a mirar la gastronomía como un lenguaje. Cada dátil relleno, cada pastela delicada, cada pasta fina y cada cuento que acompaña nuestras cajas forman parte de una misma intención: crear detalles con alma, pensados para emocionar antes, durante y después del último bocado.', 'samirarte-boutique' ),
						esc_html__( 'Nuestra inspiración nace de una cocina de raíces antiguas, cálida, especiada y ceremonial. Una cocina donde el dulce y el salado pueden encontrarse en equilibrio; donde la almendra, la miel, la canela, el azahar, el sésamo, los frutos secos y las masas finas evocan sobremesas largas, bandejas compartidas y conversaciones alrededor del té.', 'samirarte-boutique' ),
						esc_html__( 'Los dulces de esta tradición no son simples postres. Son gestos de bienvenida, símbolos de celebración y pequeñas joyas elaboradas con paciencia. Muchos se preparan para acompañar momentos importantes: una visita, una fiesta familiar, una mesa especial o un regalo cuidado. En ellos conviven la textura crujiente, los aromas florales, el dulzor medido y ese punto especiado que permanece suavemente en el recuerdo.', 'samirarte-boutique' ),
						esc_html__( 'Con este diario empieza también una forma de abrir las puertas de Samirarte. Queremos que cada persona que llegue hasta aquí entienda que detrás de una caja no hay solo un producto bonito: hay una historia, una intención y una manera de celebrar la belleza de lo hecho a mano.', 'samirarte-boutique' ),
						esc_html__( 'Bienvenida a Samirarte.', 'samirarte-boutique' ),
					),
				),
			),
			'final_cta'       => array(),
			'content_mode'    => 'journal',
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
				'url' => samirarte_boutique_image_url( 'contacto-propuesta-samirarte_2.webp' ),
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
		<?php if ( 'boxes_landing' !== $config['content_mode'] ) : ?>
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

		<?php endif; ?>

		<div class="<?php echo 'boxes_landing' === $config['content_mode'] ? 'sam-page__content sam-page__content--boxes-landing' : 'sam-container sam-page__content'; ?>">
			<?php if ( 'boxes_landing' === $config['content_mode'] ) : ?>
				<?php samirarte_boutique_render_boxes_landing(); ?>
				<?php if ( trim( get_the_content() ) ) : ?>
					<div class="sam-container">
						<div class="sam-content-card sam-content-card--editable">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php elseif ( 'account' === $config['content_mode'] ) : ?>
				<div class="sam-account-content">
					<?php the_content(); ?>
				</div>
			<?php elseif ( 'contact' === $config['content_mode'] ) : ?>
				<section class="sam-contact-panel" id="contacto">
					<div class="sam-contact-panel__intro">
						<h2><?php echo esc_html__( 'Solicitar propuesta', 'samirarte-boutique' ); ?></h2>
						<p><?php echo esc_html__( 'Solicitudes para cajas gourmet, experiencias privadas, regalos personalizados o cuentos en pergamino.', 'samirarte-boutique' ); ?></p>
						<div class="sam-social-links sam-social-links--contact" aria-label="<?php echo esc_attr__( 'Redes sociales', 'samirarte-boutique' ); ?>">
							<p><?php echo esc_html__( 'También puedes seguir el universo Samirarte en redes.', 'samirarte-boutique' ); ?></p>
							<ul>
								<li>
									<a class="sam-social-links__link" href="https://www.instagram.com/samirarte.es/" target="_blank" rel="noopener noreferrer">
										<svg class="sam-social-links__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
											<path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2Zm0 1.8A3.96 3.96 0 0 0 3.8 7.75v8.5a3.96 3.96 0 0 0 3.95 3.95h8.5a3.96 3.96 0 0 0 3.95-3.95v-8.5a3.96 3.96 0 0 0-3.95-3.95h-8.5Zm4.25 3.1a5.1 5.1 0 1 1 0 10.2 5.1 5.1 0 0 1 0-10.2Zm0 1.8a3.3 3.3 0 1 0 0 6.6 3.3 3.3 0 0 0 0-6.6Zm5.35-2.15a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z" />
										</svg>
										<span class="sam-social-links__text"><?php echo esc_html__( 'Instagram Samirarte', 'samirarte-boutique' ); ?></span>
									</a>
								</li>
								<li>
									<a class="sam-social-links__link" href="https://instagram.com/sambirsousou/" target="_blank" rel="noopener noreferrer">
										<svg class="sam-social-links__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
											<path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2Zm0 1.8A3.96 3.96 0 0 0 3.8 7.75v8.5a3.96 3.96 0 0 0 3.95 3.95h8.5a3.96 3.96 0 0 0 3.95-3.95v-8.5a3.96 3.96 0 0 0-3.95-3.95h-8.5Zm4.25 3.1a5.1 5.1 0 1 1 0 10.2 5.1 5.1 0 0 1 0-10.2Zm0 1.8a3.3 3.3 0 1 0 0 6.6 3.3 3.3 0 0 0 0-6.6Zm5.35-2.15a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z" />
										</svg>
										<span class="sam-social-links__text"><?php echo esc_html__( 'Instagram Handmade', 'samirarte-boutique' ); ?></span>
									</a>
								</li>
								<li>
									<a class="sam-social-links__link" href="https://www.tiktok.com/@simsi901?is_from_webapp=1&amp;sender_device=pc" target="_blank" rel="noopener noreferrer">
										<svg class="sam-social-links__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
											<path d="M15.25 2.8c.3 2.15 1.56 3.68 3.95 3.82v3.08a7.1 7.1 0 0 1-3.9-1.22v5.98c0 3.02-2.06 5.42-5.16 5.42-2.9 0-5.34-2.16-5.34-5.08 0-3.36 3.25-5.88 6.48-4.96v3.18c-1.31-.48-3.25.15-3.25 1.75 0 1.09.94 1.9 2.06 1.9 1.29 0 2.06-.86 2.06-2.27V2.8h3.1Z" />
										</svg>
										<span class="sam-social-links__text"><?php echo esc_html__( 'TikTok', 'samirarte-boutique' ); ?></span>
									</a>
								</li>
							</ul>
						</div>
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

				<?php if ( ! empty( $config['workshops'] ) ) : ?>
					<section class="sam-experience-workshops" aria-labelledby="sam-experience-workshops-title">
						<div class="sam-experience-section-heading">
							<p class="sam-eyebrow"><?php echo esc_html__( 'Cursos-taller cerrados', 'samirarte-boutique' ); ?></p>
							<h2 id="sam-experience-workshops-title"><?php echo esc_html__( 'Cursos-taller sensoriales', 'samirarte-boutique' ); ?></h2>
							<p><?php echo esc_html__( 'Cinco experiencias gastronómicas participativas diseñadas para vivir la cocina con el olfato, el tacto, el oído, la vista, el gusto y la sorpresa.', 'samirarte-boutique' ); ?></p>
						</div>
						<p class="sam-experience-workshops__intro"><?php echo esc_html__( 'Cada taller comienza con un ritual de bienvenida, continúa con una fase de creación manual y termina con una degustación compartida. Son propuestas cerradas, participativas y pensadas para grupos, escuelas, eventos privados o colaboraciones gastronómicas.', 'samirarte-boutique' ); ?></p>
						<div class="sam-experience-workshops__grid">
							<?php foreach ( $config['workshops'] as $workshop ) : ?>
								<article class="sam-experience-workshop-card">
									<div class="sam-experience-workshop-card__body">
										<p class="sam-experience-workshop-card__details"><?php echo esc_html( $workshop['details'] ); ?></p>
										<h3><?php echo esc_html( $workshop['title'] ); ?></h3>
										<p class="sam-experience-workshop-card__subtitle"><?php echo esc_html( $workshop['subtitle'] ); ?></p>
										<p class="sam-experience-workshop-card__description"><?php echo esc_html( $workshop['description'] ); ?></p>
									</div>
									<div class="sam-experience-workshop-card__sensory">
										<strong><?php echo esc_html__( 'Experiencia sensorial', 'samirarte-boutique' ); ?></strong>
										<ul>
											<?php foreach ( $workshop['sensory'] as $sensory_point ) : ?>
												<li><?php echo esc_html( $sensory_point ); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
									<a class="sam-experience-workshop-card__cta" href="<?php echo esc_url( home_url( '/contacto/#contacto' ) ); ?>"><?php echo esc_html__( 'Solicitar taller', 'samirarte-boutique' ); ?></a>
								</article>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>
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
									<?php if ( ! empty( $item['video'] ) ) : ?>
										<video class="sam-experience-example__video" src="<?php echo esc_url( $item['video'] ); ?>" autoplay muted loop playsinline preload="metadata"></video>
									<?php elseif ( ! empty( $item['image'] ) ) : ?>
										<img src="<?php echo esc_url( $item['image'] ); ?>" alt="" loading="lazy">
									<?php endif; ?>
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
							<?php foreach ( array_reverse( $config['stories'] ) as $story ) : ?>
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
									<?php if ( ! empty( $story['caja_url'] ) ) : ?>
										<div class="sam-story-card__reel-wrap">
											<?php if ( ! empty( $story['caja_thumbnail'] ) ) : ?>
												<?php $thumb_url = samirarte_boutique_image_url( $story['caja_thumbnail'] ); ?>
												<?php if ( $thumb_url ) : ?>
													<a class="sam-story-card__reel-thumb" href="<?php echo esc_url( $story['caja_url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Ver reel en Instagram', 'samirarte-boutique' ); ?>">
														<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $story['caja_asociada'] ); ?>" loading="lazy" width="160" height="160">
														<span class="sam-story-card__reel-play" aria-hidden="true">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32" height="32"><path d="M8 5v14l11-7z"/></svg>
														</span>
													</a>
												<?php endif; ?>
											<?php endif; ?>
											<a class="sam-story-card__box" href="<?php echo esc_url( $story['caja_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $story['caja_asociada'] ); ?></a>
										</div>
									<?php else : ?>
										<p class="sam-story-card__box"><?php echo esc_html( $story['caja_asociada'] ); ?></p>
									<?php endif; ?>
								<?php endif; ?>

								<details class="sam-story-card__details">
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
			<?php elseif ( 'journal' === $config['content_mode'] ) : ?>
				<section class="sam-journal" aria-labelledby="sam-journal-title">
					<div class="sam-journal__heading">
						<p class="sam-eyebrow"><?php echo esc_html__( 'Diario editorial', 'samirarte-boutique' ); ?></p>
						<h2 id="sam-journal-title"><?php echo esc_html__( 'Entradas del diario', 'samirarte-boutique' ); ?></h2>
					</div>

					<div class="sam-journal__entries">
						<?php foreach ( $config['journal_entries'] as $entry ) : ?>
							<?php if ( ! empty( $entry['draft'] ) ) : ?>
								<?php continue; ?>
							<?php endif; ?>
							<article class="sam-journal-entry" <?php echo ! empty( $entry['slug'] ) ? 'id="' . esc_attr( $entry['slug'] ) . '"' : ''; ?>>
								<header class="sam-journal-entry__header">
									<?php if ( ! empty( $entry['label'] ) ) : ?>
										<p class="sam-journal-entry__label"><?php echo esc_html( $entry['label'] ); ?></p>
									<?php endif; ?>
									<h2><?php echo esc_html( $entry['title'] ); ?></h2>
									<?php if ( ! empty( $entry['description'] ) ) : ?>
										<p class="sam-journal-entry__description"><?php echo esc_html( $entry['description'] ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $entry['author'] ) || ! empty( $entry['pubDate'] ) ) : ?>
										<p class="sam-journal-entry__meta">
											<?php
											echo esc_html(
												trim(
													implode(
														' · ',
														array_filter(
															array(
																! empty( $entry['author'] ) ? $entry['author'] : '',
																! empty( $entry['pubDate'] ) ? mysql2date( 'd/m/Y', $entry['pubDate'] ) : '',
															)
														)
													)
												)
											);
											?>
										</p>
									<?php endif; ?>
								</header>

								<div class="sam-journal-entry__content">
									<?php foreach ( $entry['paragraphs'] as $paragraph ) : ?>
										<p><?php echo esc_html( $paragraph ); ?></p>
									<?php endforeach; ?>
									<?php if ( ! empty( $entry['items'] ) ) : ?>
										<ul class="sam-journal-entry__list">
											<?php foreach ( $entry['items'] as $item ) : ?>
												<li>
													<strong><?php echo esc_html( $item['title'] ); ?></strong>
													<?php echo esc_html( ' ' . $item['text'] ); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									<?php if ( ! empty( $entry['tags'] ) ) : ?>
										<ul class="sam-journal-entry__tags" aria-label="<?php echo esc_attr__( 'Etiquetas', 'samirarte-boutique' ); ?>">
											<?php foreach ( $entry['tags'] as $tag ) : ?>
												<li><?php echo esc_html( $tag ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>

								<?php if ( ! empty( $entry['closing'] ) ) : ?>
									<footer class="sam-journal-entry__closing">
										<p><?php echo esc_html( $entry['closing'] ); ?></p>
									</footer>
								<?php endif; ?>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

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
								<?php $card_class .= ! empty( $card['class'] ) ? ' ' . $card['class'] : ''; ?>
								<div class="<?php echo esc_attr( $card_class ); ?>">
									<?php if ( ! empty( $card['image'] ) ) : ?>
										<figure class="sam-feature-card__image<?php echo ! empty( $card['image_class'] ) ? ' ' . esc_attr( $card['image_class'] ) : ''; ?>">
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
							<figure class="sam-page-editorial-image<?php echo ! empty( $config['media'][1]['class'] ) ? ' ' . esc_attr( $config['media'][1]['class'] ) : ''; ?>">
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
