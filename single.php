<?php 
/*
*Template for displaying single post or page.
*
*@package -> Wordpress
*@sub-package -> afia
*@since -> V 1.0.0
*/ 
?>
<?php get_header();?>
<?php 
the_post();
?>
<header id = "ex-header">
<h2 class = 'linkab title'><?php the_title();?></h2>
<hr />
<span class = "time"><i class="fa fa-clock-o"></i><span class = 'linkab'><?php echo date("F j,Y",get_post_time());?></span></span> 
 | <span class = "author"><i class="fa fa-user"></i> <span class = "linka"><?php the_author_posts_link();?></span></span>
<?php if(current_user_can( 'edit_posts')) {?>
 <span class = "alignright" style="display:inline; margin:0px;">
<a href = "<?php  get_edit_post_link();?>">
<i class="fa fa-edit" title="<?php _e('Edit','afia');?>"> <?php _e('Edit','afia');?></i>
</a>
</span>
<?php } ?>
 <hr />
</header>
<div id = "pos-ex" class = "content-post">
<!-- featured image -->
    <?php if ( '' != get_the_post_thumbnail() ) { ?>
      <div class="featured-image thumbnail">
          <?php the_post_thumbnail('featured-single'); ?>
      </div>
    <?php } ?>
<?php 
$gte = get_the_content();
if($gte == ''):
_e('This post seems to contain nothing.','afia');
else:
echo the_content();
endif;?>
</div>
<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'afia'), 'after' => '</p></nav>')); ?>
<footer>
<?php 
if(is_single())
{
	if(get_the_category() != '')
{?>
<hr />
<span class = "categ">
<i class="fa fa-folder-o"></i> <span class = "linka"><?php echo the_category(',');?></span>
</span>
<?php }?>
<hr />
<?php 
if(get_the_tags() != '')
{
	?>
<div class = 'afia-tags'>
<i class="fa fa-tags"></i>
<?php

echo the_tags();
?>
</div>
<hr />
<?php } 
}
if(is_page())
{
	?>
	<hr />
	<?php 
}
?>

<div id = "post_nav">
<br /><br />
<div class="inline">
<span class = "previous_post"><?php 
if(get_previous_post_link()):
$format = __('Previous Post: ','afia').'%link';
previous_post_link($format); 
endif;
?></span>
</div>
<div class="inline">
<span class = "next_post"><?php
if(get_next_post_link()):
$format = __('Next Post: ','afia').'%link';
 next_post_link($format);
endif;
 ?></span>
</div>
</div>
<br />
</footer>
<div id = "post_comments">
<?php 
comments_template('/lib/content-comments.php');
?>
</div>
<?php 
$cat = get_the_category();
$title = get_the_title();
$cat_name = $cat[0]->name;
$cat_id = get_cat_ID($cat_name);
$afia_query = new WP_Query();
$afia_query->query('category_name='.$cat_name.'&posts_per_page=3&orderby="comment_count"');
if($afia_query->have_posts()):?><h2 class = "tt"><?php
_e('Related Posts.','afia');?></h2><?php
$i=0;
while($afia_query->have_posts()): $afia_query->the_post();
if($i<=2 && $i!=0)
{
	echo '  |  ';
}
?>
<span id = "related_post_title"><a href= "<?php the_permalink(); ?>"><?php afia_lowercase(the_title(),true);?></a></span>      
<?php
$i++;
endwhile;
endif;
?>
<?php get_footer();?>