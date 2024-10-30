<?php 
if ( !defined('ABSPATH') )
	die('error');

require_once(ABSPATH . 'wp-admin/includes/admin.php');

wp_reset_vars(array('action', 'cat_id', 'linkurl', 'name', 'image',
	'description', 'visible', 'target', 'category', 'link_id',
	'submit', 'order_by', 'links_show_cat_id', 'rating', 'rel',
	'notes', 'linkcheck[]'));

?><html><head>
<link rel='stylesheet' href='<?php echo get_option('siteurl'); ?>/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load=global,wp-admin&amp;ver=ba4d987ec2b562bd22e5da70fe38318d' type='text/css' media='all' />
<link rel='stylesheet' id='colors-css'  href='<?php echo get_option('siteurl'); ?>/wp-admin/css/colors-fresh.css?ver=20090625' type='text/css' media='all' />
<!--[if lte IE 7]>
<link rel='stylesheet' id='ie-css' href='<?php echo get_option('siteurl'); ?>/wp-admin/css/ie.css?ver=20090630' type='text/css' media='all' />
<![endif]-->
<script type="text/javascript">
function removeWindow() {
	var url = '<?php echo esc_attr($_REQUEST['link_url']); ?>'.split('#')[0] + "#WPLINKHARE";
	try {
	top.location.replace(url);
	} catch (e) {
	top.location = url;
	}


	return false;
}

<?php if (strpos($_SERVER['REQUEST_URI'], '?added=true')) { ?>
removeWindow();
<?php } ?>
</script>
</head><body style=" ">
<div style="border: 2px solid #CCC; margin:0;" class="wrap">
<div class="icon32" id="icon-link-manager"><br/></div>
<h2 style="font-size:18px;">Add New Link to <?php bloginfo('name'); ?></h2>
<div id="poststuff" style="padding: 0 10px 10px 10px; ">
<form action="<?php echo get_option('siteurl'); ?>/wp-admin/link.php" method="post">
<?php 
wp_nonce_field( 'add-bookmark' );
wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); 
?>
<input name="action" value="add" type="hidden" />
<div id="namediv" class="stuffbox">
<h3><label for="link_name"><?php _e('Name') ?></label></h3>
<div class="inside">
	<input type="text" name="link_name" size="30" tabindex="1" value="<?php echo esc_attr($_REQUEST['link_name']); ?>" id="link_name" />
</div>
</div>

<div id="addressdiv" class="stuffbox">
<h3><label for="link_url"><?php _e('Web Address') ?></label></h3>
<div class="inside">
	<input type="text" name="link_url" size="30" class="code" tabindex="2" value="<?php echo esc_attr($_REQUEST['link_url']); ?>" id="link_url" />
</div>
</div>

<div id="descriptiondiv" class="stuffbox">
<h3><label for="link_description"><?php _e('Description') ?></label></h3>
<div class="inside">
	<input type="text" name="link_description" size="30" tabindex="3" value="<?php echo isset($link->link_description) ? esc_attr($link->link_description) : ''; ?>" id="link_description" />
</div>
</div>

<div id="categoriesdiv" class="stuffbox">
<h3><label for="link_category"><?php _e('Category') ?></label></h3>
<div class="inside">
	<ul id="categorychecklist" class="list:category categorychecklist form-no-clear">
		<?php wp_link_category_checklist(); ?>
	</ul>
</div>
</div>

<div id="publishing-action" style="float:none;">
	<input type="button" value="Cancel" accesskey="c" tabindex="5" id="cancel" class="button-primary" name="cancel" onclick="return removeWindow()"/>
	<input type="submit" value="Add Link" accesskey="p" tabindex="6" id="publish" class="button-primary" name="save" />
</div>

</form>
</div></div>

</body></html>