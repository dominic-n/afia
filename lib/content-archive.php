<?php 
/*
*This is a template to display posts and pages on a given archive.
*
*@since 1.0.0
*
*
*/
get_header();
?>
<?php
 if(have_posts()):
 while(have_posts()):
 the_post();
?>
<?php 
get_template_part('lib/content','excerpt');
?>
<?php 
endwhile;
the_posts_pagination( array( 'mid_size' => 4,'screen_reader_text' => ' ') );
else:
get_template_part('lib/content','error');
endif;
?>
<?php 
get_footer();
?>