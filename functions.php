<?php
/*Template for function code for theme.
*
*@package -> Wordpress
*@sub-package -> afia
*@since -> V 1.0.0
*/  
?>

<?php 
/**
 * Enqueue scripts and styles.
 */
function afia_enqueue_scripts() {
	wp_enqueue_style('genericon',get_template_directory_uri() .'/assets/css/font-awesome.min.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() ,array (), false, 'all');
    wp_enqueue_style('handheld',get_template_directory_uri() .'/assets/css/handheld.css',array (), false, 'all and (max-device-width:768px)');
   wp_enqueue_script( 'ie_html5shiv',get_template_directory_uri().'/lib/js/html5.js');
		wp_style_add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );
	}
add_action( 'wp_enqueue_scripts', 'afia_enqueue_scripts' );


/*echos the short form of description of the site.
*
*@params N/A
*@since 1.0.0
*/
if (!(function_exists('afia_short_description'))):
 function afia_short_description ()
 {
	 $d = get_bloginfo( 'description' );
		if((strlen($d)) >250)
		$s = substr($d,0,244).'....';
		else
		$s = $d;
		echo $s;
 }
endif;


if ( ! function_exists( 'afia_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since afia 1.0.0
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function afia_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link linkb">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s ', 'afia' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'afia_excerpt_more' );
endif;


/*
*Function to write the top bar content.
*/
if(! function_exists('afia_top_bar')):
function afia_top_bar()
{
	if(!is_home()):
	  $home = '<span class = "idle"><a href = "'.esc_url( home_url( '/' ) ).'" title = "'.__('HOME','afia').'">'.__('HOME','afia').'</a></span>  | ';
	  $single = '<span class = "active">'. afia_title() .'</span>';
	  $fin = $home.''.$single;
	 echo $fin;
	 else:
	 $fin = '';
	endif;
	
}
//End of afia top bar.
endif;

/*
*Function to return the title of a page.
*/
if(! function_exists('afia_title')):
function afia_title()
{
	if (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      return apply_filters('single_term_title', $term->name);
    } elseif (is_post_type_archive()) {
      return apply_filters('the_title', get_queried_object()->labels->name);
    } elseif (is_day()) {
      return sprintf(__('Daily Archives: %s', 'afia'), get_the_date());
    } elseif (is_month()) {
      return sprintf(__('Monthly Archives: %s', 'afia'), get_the_date('F Y'));
    } elseif (is_year()) {
      return sprintf(__('Yearly Archives: %s', 'afia'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      return sprintf(__('Author Archives: %s', 'afia'), $author->display_name);
    } else {      return single_cat_title('', false);

    }
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'afia'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'afia');
  } else {
	  $c = get_the_category();
	  $cat_name = $c[0]->name;
	  $cat_id = get_cat_ID($cat_name);
	  $cat_link = get_category_link($cat_id);
	  $lk = '<span class="idle"><a href = "'.$cat_link.'" title = "'.__('Category ','afia').'->'.$cat_name.'">'.$cat_name.'</a></span>  |  '.get_the_title();
	return $lk;
  }
}
endif;



/*
*function to edit details of user or login button if not logged in.
*
*@sub-package afia
*@since 1.0.0
*/
if(! function_exists('afia_logged_details')):
function afia_logged_details()
{
	if(is_user_logged_in())
	{
	    $current_user = wp_get_current_user();
		$name = $current_user -> user_login;
		$fin = '<span class = "lucida">'.__('Logged in as: ','afia').'</span><span class = "logname"><i>'.$name.'</i><span>';
		$fin .= '<span class = "log"> <a href = "'. wp_logout_url().'">'.__('Logout','afia').'</a></span>';
	}
	else if(! is_user_logged_in())
	{
		$fin = '<span class = "log"><a href = "'. wp_login_url().'">'.__('Login','afia').'</a>'.__(' or', 'afia').' <a href="'. wp_registration_url( get_permalink() ) .'">'.__('Register','afia').'</a></span>';
	}
	echo '<span class = "right">'.$fin.'</span>';
}
endif;
/*
*function to echo the footer text.
*/
if(!function_exists('afia_echo_footer')):
function afia_echo_footer()
{
$txt = '<a href="http://WordPress.org"> WordPress</a>: &copy; 2015 ';
$date = date('Y');
if($date > 2015):
$txt .= '- '.$date;
endif;
$t = __('Theme powered by:','afia'). $txt . '<a href ="'.esc_url(home_url("/")).'">'. get_bloginfo( 'title' ) .'</a>';
return $t;
}
endif;



function afia_set_up()
{
	add_theme_support( 'post-thumbnails' ); 
 /**
 *Add support for background info.
 */
	$background_args = array(
	'default-color'  => '#f2f2f2',
      'default-repeat' => 'fixed',
      'default-image'  => esc_url(get_template_directory_uri() . '/assets/img/pat.jpg'),
  );
  add_theme_support( 'custom-background', $background_args );
  /**
*Register menus.
*/
	 register_nav_menus( array('primary' => 'Primary Navigation'));
 /**
 *Add support for menu.
 */	 
 add_theme_support('nav-menus');
 
 /**
 *Add support for header image.
 */
  $defaults = array(
	'default-image'          => '',
	'width'                  => 850,
	'height'                 => 371,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

 /**
 *Add support for feed.
 */
add_theme_support( 'automatic-feed-links' );

 /**
 *Add support for title to avoid hard coding.
 */
add_theme_support( 'title-tag' );
// editor style
  add_editor_style('/assets/css/editor-style.css');

  // Content width
  global $content_width;
  if (!isset($content_width)) { $content_width = 657; }
}
add_action('after_setup_theme', 'afia_set_up');

function afia_setup_cus($wp_customize ) 
{
   
$wp_customize->add_panel( 'afia_logo_settings', array(
        'priority'       =>   200,
        'capability'     =>   'edit_theme_options',
        'title'          =>   __( 'Logo Settings', 'afia' ), 
        'description'    =>   __('customize Logo', 'afia'),
    ));

    $wp_customize->add_section( 'afia_logo_section', array(
        'title'         =>    __( 'Logo Settings', 'afia' ), 
        'priority'      =>    1, 
        'capability'    =>    'edit_theme_options', 
        'panel'         =>    'afia_logo_settings',
    ));

     $wp_customize->add_setting( 'afia_show_logo', 
       array(
          'default' => false, 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'afia_sanitize_checkbox',
       ) 
    );

    $wp_customize->add_control( 'afia_show_logo', array(
        'type'     => 'checkbox',
        'priority' => 1,
        'section'  => 'afia_logo_section',
        'label'    => __('Show Logo.', 'afia'),
    ));	

    $wp_customize->add_section( 'afia_logo_upload_section', array(
        'title'         =>    __( 'Upload a Logo', 'afia' ), 
        'priority'      =>    2, 
        'capability'    =>    'edit_theme_options', 
        'panel'         =>    'afia_logo_settings',
    ));
	
	$wp_customize->add_setting( 'afia_upload_logo', array(
	'default'          => '',
	'sanitize_callback' => 'esc_url_raw',
	));
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'logo',array(
               'label'      => __( 'Upload a logo.', 'afia' ),
               'section'    => 'afia_logo_upload_section',
               'settings'   => 'afia_upload_logo', 
           )
       )
   );
    $wp_customize->add_panel( 'afia_text_settings', array(
        'priority'       =>   102,
        'capability'     =>   'edit_theme_options',
        'title'          =>   __( 'Text Color and Font Settings', 'afia' ), 
        'description'    =>   __('customize your text', 'afia'),
    ));
    $wp_customize->add_section('afia_text_colors',array(
        'title'         =>    __( 'Colors', 'afia' ), 
        'priority'      =>    1, 
        'capability'    =>    'edit_theme_options', 
        'panel'         =>    'afia_text_settings',
    ));
	$wp_customize->add_section('afia_text_fonts',array(
        'title'         =>    __( 'Fonts', 'afia' ), 
        'priority'      =>    2, 
        'capability'    =>    'edit_theme_options', 
        'panel'         =>    'afia_text_settings',
    ));
	$wp_customize->add_setting( 'afia_heading_color', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_hex_color',
       ) 
    );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'afia_heading_color',array(
  'section' => 'afia_text_colors',
  'label' => __( 'Heading Text Color','afia' ),
  'description' => __( 'Set the font color of the post, comment and widget headings.','afia' ),
) ));
 $wp_customize->add_setting( 'afia_heading_font', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_text_field',
       ) 
    );
    $wp_customize->add_control( 'afia_heading_font', array(
        'type'     => 'text',
        'priority' => 1,
        'section'  => 'afia_text_fonts',
        'label'    => __('Heading font.', 'afia'),
		'description' => __( 'Set the font name of all post, comment and widget headings.','afia' ),
    ));	
	//Set for links
	 //unvisited links.
	$wp_customize->add_setting( 'afia_link_color', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_hex_color',
       ) 
    );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'afia_link_color',array(
  'section' => 'afia_text_colors',
  'label' => __( 'Unvisted Link Text Color','afia' ),
  'description' => __( 'Set the color of all unvisited links.','afia' ),
) ));
 $wp_customize->add_setting( 'afia_link_font', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_text_field',
       ) 
    );
    $wp_customize->add_control( 'afia_link_font', array(
        'type'     => 'text',
        'priority' => 1,
        'section'  => 'afia_text_fonts',
        'label'    => __('Unvisited Link font.', 'afia'),
		'description' => __( 'Set the font name of all links in your page','afia' ),
    ));	
	//Hovered links
	$wp_customize->add_setting( 'afia_hover_color', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_hex_color',
       ) 
    );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'afia_hover_color',array(
  'section' => 'afia_text_colors',
  'label' => __( 'Hovered Link Text Color','afia' ),
  'description' => __( 'Set the color of all hovered links.','afia' ),
) ));
 $wp_customize->add_setting( 'afia_hover_font', 
       array(
          'default' => '', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_text_field',
       ) 
    );
    $wp_customize->add_control( 'afia_hover_font', array(
        'type'     => 'text',
        'priority' => 1,
        'section'  => 'afia_text_fonts',
        'label'    => __('Hovered Link font.', 'afia'),
		'description' => __( 'Set the font name of hovered links in your page','afia' ),
    ));	
	//Main body content.
	$wp_customize->add_setting( 'afia_main_color', 
       array(
          'default' => '#000000', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_hex_color',
       ) 
    );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'afia_main_color',array(
  'section' => 'afia_text_colors',
  'label' => __( 'Main content Text Color','afia' ),
  'description' => __( 'Set the color for main post content.','afia' ),
) ));
 $wp_customize->add_setting( 'afia_main_font', 
       array(
          'default' => 'Georgia', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_text_field',
       ) 
    );
    $wp_customize->add_control( 'afia_main_font', array(
        'type'     => 'text',
        'priority' => 1,
        'section'  => 'afia_text_fonts',
        'label'    => __('Main Content font.', 'afia'),
		'description' => __( 'Set the font name of Main content, ie post content.','afia' ),
    ));	
	$wp_customize->add_setting( 'afia_main_size', 
       array(
          'default' => '16px', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_text_field',
       ) 
    );
    $wp_customize->add_control( 'afia_main_size', array(
        'type'     => 'text',
        'priority' => 1,
        'section'  => 'afia_text_fonts',
        'label'    => __('Main Content font size.', 'afia'),
		'description' => __( 'Set the font size name of Main content, ie post content.','afia' ),
    ));	
	//Main background
	$wp_customize->add_setting( 'afia_main_back', 
       array(
          'default' => '#ffffff', 
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', 
          'transport' => 'refresh', 
          'sanitize_callback' => 'sanitize_hex_color',
       ) 
    );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'afia_main_back',array(
  'section' => 'colors',
  'label' => __( 'Main content Background Color','afia' ),
  'description' => __( 'Set the Background color for main post content.','afia' ),
) ));
}
add_action( 'customize_register', 'afia_setup_cus' );

/**
 * Register our sidebars and widgetized areas.
 *
 */

function afia_widgets_init() {

	register_sidebar( array(
		'name'          => __('right sidebar','afia'),
		'id'            => 'sidebar-primary',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'afia_widgets_init' );


function afia_customze_css()
{
?>

<style>
#content{background:<?php echo esc_html(get_theme_mod('afia_main_back','#ffffff'));?>;}
<?php
if(esc_html(get_theme_mod('afia_heading_color','')) != '' || esc_html(get_theme_mod('afia_heading_font','')) != '')
{?>
.widget-title, .rounded,.title,.round,#respond h3,.tt{
	color:<?php if(esc_html(get_theme_mod('afia_heading_color','')) != ''): echo esc_html(get_theme_mod('afia_heading_color','')); endif;?>;
	font-family:<?php if(esc_html(get_theme_mod('afia_heading_font','')) != ''):echo esc_html(get_theme_mod('afia_heading_font','')); endif;?>;}
<?php }?>
<?php
if(esc_html(get_theme_mod('afia_link_color','')) != '' || esc_html(get_theme_mod('afia_link_font','')) != '')
{?>
body a{
	color:<?php if(esc_html(get_theme_mod('afia_link_color','')) != ''): echo esc_html(get_theme_mod('afia_link_color','')); endif;?>;
	font-family:<?php if(esc_html(get_theme_mod('afia_link_font','') != '')):echo esc_html(get_theme_mod('afia_link_font','')); endif;?>;}
<?php }?><?php
if(esc_html(get_theme_mod('afia_hover_color','')) != '' || esc_html(get_theme_mod('afia_hover_font','')) != '')
{?>
body a{
	color:<?php if(esc_html(get_theme_mod('afia_hover_color','')) != ''): echo esc_html(get_theme_mod('afia_hover_color','')); endif;?>;
	font-family:<?php if(esc_html(get_theme_mod('afia_hover_font','')) != ''):echo esc_html(get_theme_mod('afia_hover_font','')); endif;?>;}
<?php }?>
.content-post{
	color:<?php echo esc_html(get_theme_mod('afia_main_color','#000000')); ?>;
	font-family:<?php echo esc_html(get_theme_mod('afia_main_font','Georgia')); ?>;
font-family:<?php echo esc_html(get_theme_mod('afia_main_size','16px')); ?>;}
<?php 
if(is_home() || is_front_page()):?>
.top-bar{display:none;}
	<?php
endif;
$z  = get_header_image();
if(! $z):
?>
#header-img{display:none;}
<?php
endif; 
?>
	</style>
	 
<?php 
    
}
add_action( 'wp_head', 'afia_customze_css');

function afia_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


function afia_password_form() {
    global $post;
    $label = 'password-'.( empty( $post->ID ) ? rand() : $post->ID );
    $password_form = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
    '.__('This post is password protected. To view it please enter your password below: ', 'afia').'
    <div class="protected-form input-group has-info col-md-6">
        <input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="Submit"><span class="fa fa-lock"></span></button>
        </span>
    </div>
  </form>';
    return $password_form;
}
apply_filters( 'the_password_form', 'afia_password_form' );

?>