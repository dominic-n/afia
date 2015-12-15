<?php 
/*
*This is a template to display error on page.
*
*@since 1.0.0
*
*/
?>
<br /><br /><br />
<span id = "errall">
<span class = "error-img">
<i class="fa fa-exclamation-triangle"></i>
</span>
<div id = "error-msg">
<p class = "content-error">
<?php _e('Sorry! The content you are looking for is not  available.','afia');?><br />
<?php _e('Try searching to see if any posts match it.','afia');?><br />
<form method = "get" action='<?php echo esc_url( home_url( '/' ) ); ?>'  name = "search">

<input type = "text" placeholder = "<?php _e('  Search','afia'); ?>" name= "s">
<input type = "submit" value = "<?php _e('Search','afia');?>"/>
</form>
</p>
</div>
</span>
<br /><br /><br />