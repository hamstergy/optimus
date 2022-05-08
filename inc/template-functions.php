<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package atlas
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function atlas_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'atlas_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function atlas_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'atlas_pingback_header' );

/////////
// Убираем wp-json

add_filter('rest_enabled', '__return_false');
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
//remove_action('init', 'rest_api_init');
//remove_action('parse_request', 'rest_api_loaded');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

// Убираем шортлинки

remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head','feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head','feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head','rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head','wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head','wp_generator');  // скрыть версию wordpress
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

return $headers;
}
function _remove_script_version( $src ){
$parts = explode( '?', $src );
return $parts[0];
}
// Удаляем версию скриптов
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
// Удаляем версию стилей
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}

	}

	return $data;
}
## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

/*Каталог*/
function catalog_post_pro() {

	$labels = array(
	  'name'               => __('Appliance repair', 'atlas'),
	   'singular_name'      => __('Appliance repair', 'atlas'),
	   'add_new'            => 'Добавить запись', 'catalog',
	   'add_new_item'       => 'Добавить запись',
	   'edit_item'          => 'Редактировать запись',
	   'new_item'           => 'Новый товар',
	   'all_items'          => 'Вся техника',
	   'view_item'          => 'Смотреть каталог',
	   'search_items'       => 'Найти технику',
	   'not_found'          => 'Техника не найдены',
	   'not_found_in_trash' => 'Нет удаленной техники',
	   'parent_item_colon'  => 'Parent Item',
	   'menu_name'          => __('Appliance repair')
	);

	$args = array(
	   'labels'              => $labels,
	   'menu_icon'           => 'dashicons-store',
	   'public'              => true,
	   'has_archive'         => true,
	   'publicly_queryable'  => true,
	   'query_var'           => true,
	   'rewrite'             => true,
	   'capability_type'     => 'post',
	   'hierarchical'        => true,
	   'menu_position'       => 12,
	   'rewrite'       => array( 'slug' => 'appliance-repair', 'with_front' => true ),
	   'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
	//   'taxonomies' => array('post_tag'),
	   'exclude_from_search' => false,
	);

	register_post_type( 'catalog', $args );
 }

 add_action( 'init', 'catalog_post_pro' );



 /*Бренды*/
 function brands_post_pro() {

 	$labels = array(
 	  'name'               => __('Brands', 'atlas'),
 	   'singular_name'      => __('Brands', 'atlas'),
 	   'add_new'            => 'Добавить бренд', 'catalog',
 	   'add_new_item'       => 'Добавить бренд',
 	   'edit_item'          => 'Редактировать бренд',
 	   'new_item'           => 'Новый бренд',
 	   'all_items'          => 'Все бренды',
 	   'view_item'          => 'Смотреть раздел',
 	   'search_items'       => 'Найти бренд',
 	   'not_found'          => 'Бренды не найдены',
 	   'not_found_in_trash' => 'Нет удаленных брендов',
 	   'parent_item_colon'  => 'Parent Item',
 	   'menu_name'          => __('Brands')
 	);

 	$br = array(
 	   'labels'              => $labels,
 	   'menu_icon'           => 'dashicons-welcome-view-site',
 	   'public'              => true,
 	   'has_archive'         => true,
 	   'publicly_queryable'  => true,
 	   'query_var'           => true,
 	   'rewrite'             => true,
 	   'capability_type'     => 'post',
 	   'hierarchical'        => true,
 	   'menu_position'       => 12,
 	   'rewrite'       => array( 'slug' => 'brands', 'with_front' => true ),
 	   'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'brands_category', 'revisions'),
 	   'exclude_from_search' => false,
 	);

 	register_post_type( 'brands', $br );
  }
  add_action( 'init', 'brands_post_pro' );

	/*Ремонт*/
  function repair_post_pro() {

  	$labels = array(
  	  'name'               => __('Issues', 'atlas'),
  	   'singular_name'      => __('Issues', 'atlas'),
  	   'parent_item_colon'  => 'Parent Item',
			 'add_new'            => 'Добавить запись', 'catalog',
				'add_new_item'       => 'Добавить запись',
				'edit_item'          => 'Редактировать запись',
  	   'menu_name'          => __('Issues')
  	);

  	$rep = array(
  	   'labels'              => $labels,
  	   'menu_icon'           => 'dashicons-admin-tools',
			 'public'              => true,
	 		'has_archive'         => false,
	 		'publicly_queryable'  => true,
	 		'query_var'           => true,
	 		'rewrite'             => true,
	 		'capability_type'     => 'post',
	 		'hierarchical'        => false,
  	   'menu_position'       => 12,
  	 //  'rewrite'       => array( 'slug' => '/', 'with_front' => true ),
  	   'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
  	   'exclude_from_search' => false,
  	);

  	register_post_type( 'repair', $rep );
   }
   add_action( 'init', 'repair_post_pro' );

	 /*Locations*/
	 function location_post_pro() {

	 	$labels = array(
	 		'name'               => __('Locations', 'atlas'),
	 		 'singular_name'      => __('Locations', 'atlas'),
	 		 'parent_item_colon'  => 'Parent Item',
	 		 'add_new'            => 'Добавить запись', 'catalog',
	 			'add_new_item'       => 'Добавить запись',
	 			'edit_item'          => 'Редактировать запись',
	 		 'menu_name'          => __('Locations')
	 	);

	 	$loc = array(
	 		 'labels'              => $labels,
	 		 'menu_icon'           => 'dashicons-admin-site',
	 		 'public'              => true,
	 		 'has_archive'         => true,
	 		 'publicly_queryable'  => true,
	 		 'query_var'           => true,
	 		 'rewrite'             => true,
	 		 'capability_type'     => 'post',
	 		 'hierarchical'        => true,
	 		 'menu_position'       => 12,
	 		 'rewrite'       => array( 'slug' => 'locations', 'with_front' => true ),
	 		 'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
	 		 'exclude_from_search' => false,
	 	);

	 	register_post_type( 'location', $loc );
	  }
	  add_action( 'init', 'location_post_pro' );

		/*Reviews*/
 	 function rewiew_post_pro() {

 	 	$labels = array(
 	 		'name'               => __('Reviews', 'atlas'),
 	 		 'singular_name'      => __('Reviews', 'atlas'),
 	 		 'parent_item_colon'  => 'Parent Item',
 	 		 'add_new'            => 'Добавить запись', 'catalog',
 	 			'add_new_item'       => 'Добавить запись',
 	 			'edit_item'          => 'Редактировать запись',
 	 		 'menu_name'          => __('Reviews')
 	 	);

 	 	$rew = array(
 	 		 'labels'              => $labels,
 	 		 'menu_icon'           => 'dashicons-format-status',
 	 		 'public'              => true,
 	 		 'has_archive'         => true,
 	 		 'publicly_queryable'  => false,
 	 		 'query_var'           => true,
 	 		 'rewrite'             => true,
 	 		 'capability_type'     => 'post',
 	 		 'hierarchical'        => true,
 	 		 'menu_position'       => 12,
 	 		 'rewrite'       => array( 'slug' => 'rewiew', 'with_front' => true ),
 	 		 'supports'            => array( 'title', 'editor','revisions'),
 	 		 'exclude_from_search' => false,
 	 	);

 	 	register_post_type( 'rewiew', $rew );
 	  }
 	  add_action( 'init', 'rewiew_post_pro' );

		if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		acf_add_options_page(array(
			'page_title' 	=> 'Type Area Settings',
			'menu_title'	=> 'Type-Area',
			'menu_slug' 	=> 'type-area-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

	}

	function wp_corenavi() {
  global $wp_query;
  $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
  $a['total'] = $total;
  $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
  $a['prev_text'] = ''; // текст ссылки "Предыдущая страница"
  $a['next_text'] = ''; // текст ссылки "Следующая страница"
	$a['type'] = 'list';

  if ( $total > 1 ) echo '<div class="pagination">';
  echo paginate_links( $a );
  if ( $total > 1 ) echo '</div>';
}

function stackoverflow_remove_cpt_slug( $post_link, $post ) {
    if ( 'repair' === $post->post_type && 'publish' === $post->post_status ) {
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'stackoverflow_remove_cpt_slug', 10, 2 );
function stackoverflow_add_cpt_post_names_to_main_query( $query ) {
    // Return if this is not the main query.
    if ( ! $query->is_main_query() ) {
        return;
    }
    // Return if this query doesn't match our very specific rewrite rule.
    if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
        return;
    }
    // Return if we're not querying based on the post name.
    if ( empty( $query->query['name'] ) ) {
        return;
    }
    // Add CPT to the list of post types WP will include when it queries based on the post name.
    $query->set( 'post_type', array( 'post', 'page', 'repair' ) );
}
add_action( 'pre_get_posts', 'stackoverflow_add_cpt_post_names_to_main_query' );


/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
/*
function kama_breadcrumbs( $sep = '', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}*/

function kama_breadcrumbs( $sep = '', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	$res = $kb->get_crumbs( $sep, $l10n, $args );
	$iteration = (substr_count($res, '&&&n&&&'));
	for ($i = 1; $i <= $iteration; $i++) {
		$res = preg_replace('/&&&n&&&/', $i, $res, 1); 
	}
	echo $res;

}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Home',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
										   // или можно указать свой массив разметки:
										   // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
									  // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
									  // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
									  // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="sep">'. $arg->sep .'</span>'; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="breadgrums">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="breadgrums" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="breadgrums" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',

				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a><meta itemprop="position" content="&&&n&&&" /></span>',
				'sep_after'  => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num )
					$home_after = sprintf( $this->arg->title_patt, $pt_title );
				// singular, paged post_type_archive, tax
				else{
					$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

					$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

/*
function wpschool_remove_yoast_jsonld( $data ){
    $data = array();
    return $data;
}
add_filter( 'wpseo_json_ld_output', 'wpschool_remove_yoast_jsonld', 10, 1 );
*/

add_action( 'template_redirect', 'remove_wpseo' );

/**
 * Removes output from Yoast SEO on the frontend for a specific post, page or custom post type.
 */
function remove_wpseo() {
    if ( is_page ( 336 ) ) {
        $contact = YoastSEO()->classes->get( Yoast\WP\SEO\Integrations\Front_End_Integration::class );

        remove_action( 'wpseo_head', [ $contact, 'present_head' ], -9999 );
    }
}



/*Rew form*/

add_action('wp_ajax_rewiew_post', 'rewiew_post__callback');
add_action('wp_ajax_nopriv_rewiew_post', 'rewiew_post__callback');

function rewiew_post__callback() {

    if (isset($_POST['cpt_nonce_field']) && wp_verify_nonce($_POST['cpt_nonce_field'], 'cpt_nonce_action')) {

        // create post object with the form values

        $my_cptpost_args = array(
            'post_title' => $_POST['cptTitle'],
            'post_content' => $_POST['cptContent'],
            'post_status' => 'pending',
            'post_type' => $_POST['post_type'],
            'meta_input' => array(
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
            )
        );

        $cpt_id = wp_insert_post($my_cptpost_args, true);

        if (!is_wp_error($cpt_id)) {
            wp_send_json_success(['msg' => 'Success!']);
        }
    }

    exit;
}

/*Forma*/
function send_form(){
  $method = $_SERVER['REQUEST_METHOD'];

$c = true;
if ( $method === 'POST' ) {

	$project_name = 'Request Service';
	$admin_email  = get_bloginfo('admin_email');
	$mailtp = 'optimusapplianceseo@gmail.com';
	$form_subject = 'Request Service';
	
	foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$mailtp.'>' . PHP_EOL .
'Reply-To: '.$mailtp.'' . PHP_EOL;

mail($admin_email, adopt($form_subject), $message, $headers );
mail('optimusapplianceseo@gmail.com', adopt($form_subject), $message, $headers );
 
  die();
}
add_action('wp_ajax_send_form', 'send_form');
add_action('wp_ajax_nopriv_send_form', 'send_form');


function wpschool_disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
    if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array(
        'admin-localization/admin-localization.php'
    )))
    unset( $actions['deactivate'] );
    return $actions;
}
add_filter( 'plugin_action_links', 'wpschool_disable_plugin_deactivation', 10, 4 );

## заменим слово страницы
add_filter('post_type_labels_page', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	$new = array(
		'name'                  => 'Pages',
		'singular_name'         => 'Page',
		'add_new'               => 'Add page',
		'add_new_item'          => 'Add page',
		'edit_item'             => 'Edit page',
		'new_item'              => 'New page',
		'view_item'             => 'View page',
		'search_items'          => 'Search page',
		'not_found'             => 'Page not found',
		'not_found_in_trash'    => 'Trash is empty',
		'all_items'             => 'All pages',
		'items_list'            => 'Pages',
		'menu_name'             => 'Pages',
		'name_admin_bar'        => 'Pages',
	);

	return (object) array_merge( (array) $labels, $new );
}

add_filter('wpseo_title', 'filter_product_wpseo_title');
function filter_product_wpseo_title($title) {
   /* if(  is_singular( 'brands') || is_singular('catalog') ) {
    	$blog_title = get_bloginfo('name');
        $title = "$title - $blog_title";
    }*/
    $blog_title = get_bloginfo('name');
        $title = "$title - $blog_title";
    return $title;
}

function custom_rewrite_rule_location_type() {
	add_rewrite_rule('appliance-repair/([^/]+)/([^/]+)/?$',
	  'index.php?type=$matches[1]&location=$matches[2]',
	  'top');
}
add_action('init', 'custom_rewrite_rule_location_type');

add_filter( 'query_vars', 'wp_custom_query_vars' );
function wp_custom_query_vars( $query_vars ){
    $query_vars[] = 'location';
    $query_vars[] = 'type';
    return $query_vars;
}

add_action('template_include', function($template){
	if (get_query_var('location') !== false && 
		get_query_var('location') !== '' &&
		get_query_var('type') !== false && 
		get_query_var('type') !== '') {
		
		// вытаскиваю массив всех постов с типом location
		$location_posts = get_posts([
			'post_type' => 'location',
			'post_status' => 'publish',
			'numberposts' => -1
		]);

		//оставляю только slug -> пример 'pacific-beach'
		$locations = array_map(function($location) {
			return $location->post_name;
		}, $location_posts);
		
		// вытаскиваю массив всех постов с типом catalog
		$catalog_posts = get_posts([
			'post_type' => 'catalog',
			'post_status' => 'publish',
			'numberposts' => -1
		]);

		//оставляю только slug -> пример 'refrigerator-repair'
		$types = array_map(function($post) {
			return $post->post_name;
		}, $catalog_posts);

		//проверяю те которые в URL совпадают с теми которые в массивах, если да, возвращаю новый тип шаблон
		if (in_array(get_query_var('location'), $locations) && in_array(get_query_var('type'), $types)) {
			return get_template_directory() . '/single-type-area.php';
		}
		return $template;
	}
	return $template;
});