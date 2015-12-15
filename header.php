<?php
/*Template for displaying the header for all the files.
*
*@package -> Wordpress
*@sub-package -> afia
*@since -> V 1.0.0
*/ 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
 <meta charset = "<?php bloginfo('charset'); ?>"/>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">

<?php 
wp_head();
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
?>
</head>
<body <?php body_class(); ?>>
<!--We create a div container for the #content -->
<div id = "content">
<header class="header">
<?php if(afia_sanitize_checkbox(get_theme_mod( 'afia_show_logo',false)) ):?>
<a href = "<?php echo esc_url( home_url( '/' ) );?>">
<img src = "<?php echo esc_url( get_theme_mod( 'afia_upload_logo') ); ?>"/>
</a>
<?php else:?>
        <h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        </h1>
        <span class="site-description">
<div class="inline">
<?php  
		afia_short_description();
		?>
</div>
</span>
<?php endif;?>
<div class="inline">
		<?php 
		afia_logged_details();
		?>
</div>
<div id ="menu">
<span class = 'tes'>
<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
</span>
</div>
<br />
<br />
<?php 
if(get_header_image() != ''){?>
<div id = "header-img">
<img src="<?php header_image(); ?>"  alt="" />
</div>
<?php }?>
</header><br /> <!-- .header -->
<!--#leftContent-->
<div id = "leftContent" class="dotot">
<div class = "top-bar">
<!--Top-bar class -->
<?php afia_top_bar();?>
</div>
