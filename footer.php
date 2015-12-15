<?php
/*Template for displaying the footer for all the files.
*
*@package -> Wordpress
*@sub-package -> afia
*@since -> V 1.0.0
*/ 
?>
<!--End of #leftContent-->
</div>
<!--Side bar inclusion-->
<div id = "sideba" class="dotot">
	<?php get_sidebar();?>
</div>
<!--End of #content-->
<br />
<br />
<br />
<br />
<div id = "footba">
<span class = "footertext">
<?php 
echo afia_echo_footer();
wp_footer();
?>
</span>
</div>
<!--End of content section-->
</div>
<!--End of the document body section-->
</body>
</html>