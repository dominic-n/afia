<?php
/*Template for displaying the sidebar for all the files.
*
*@package -> Wordpress
*@sub-package -> afia
*@since -> V 1.0.0
*/ 
?>

<!-- load widgets if any -->
<?php if ( is_active_sidebar( 'sidebar-primary' ) ) {
	dynamic_sidebar('sidebar-primary');
} else { 
_e('This sidebar seems to contain no widgets. Go to customization > widgets and add widgets to primary sidebar.','afia');
} ?>