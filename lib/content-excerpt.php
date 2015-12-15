<?php
/*
*Template to produce an excerpt used in archive, home (if set for latest posts in settings),
*category among others.
*/
?>
<header id = "ex-header">
<a class = "linka lnk" href= "<?php the_permalink(); ?>"><h2 class = "title"><?php the_title();?></h2></a>
<hr />
<span class = "time"><i class="fa fa-clock-o"></i> <span class = 'linkab'><a class = "linka lnk" href= "<?php the_permalink(); ?>"><?php echo date("F j,Y",get_post_time());?></a></span></span> 
 | <span class = "author"><i class="fa fa-user"></i> <span class = "linka"><?php the_author_posts_link();?></span></span>
<hr />
</header>
<div id = "pos-ex" class = "content-post">
<!-- featured image -->
    <?php if ( '' != get_the_post_thumbnail() ) { ?>
      <div class="exc-featured-image thumbnail">
          <?php the_post_thumbnail('featured-single'); ?>
      </div>
    <?php } ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 

$gte = get_the_excerpt();
if($gte == ''):
_e('This post seems to contain nothing.','afia');
else:
echo the_excerpt();
endif;
?>
</div>
</div>
<footer>
<hr />
<span class = "categ">
<i class="fa fa-folder-o"></i> <span class = "linka"><?php echo the_category(', ');?></span>
</span>
<hr />
</footer>
<br />
