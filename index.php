<?php 
/*
*This is one of the two files required for any theme to work, it is used in-case any template file is missing.
*
*
*
*
*
*@package -> Word-press
*@sub-package -> afia
*@since -> V 1.0.0
*/ 
?>
<?php get_header();?>
<?php

while(have_posts()):

the_post();
get_template_part('lib/content','excerpt');
?>
<?php endwhile;?>
<?php 
the_posts_pagination( array( 'mid_size' => 2,'screen_reader_text' => ' ') );
?>
<?php get_footer();?>