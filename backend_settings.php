<?php

/* function add_menu()
	{
		
		$page_title = "infinite scrolling settings";
		
		$menu_title = "Infinite Scrolling";
		
		$capability = "manage_options";
		
		$menu_slug = "infinite_scrolling_settings";
		
		$function = "settings";
		
		$icon_url = "dashicons-media-document";
		
		$position = "30";
		
		add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
		
	}
	
	add_action("admin_menu","add_menu"); */

	
	function ph_infinite_add_menu()
	{
		
		$page_title='Infinite Scrolling Settings';
		
		$menu_title='Infinite Scrolling';
		
		$capability='manage_options';
		
		$menu_slug='infinite_scrolling_settings';
		
		$function='infi_settings';
        
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug,$function , $icon_url, $position );
		
		add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, plugin_dir_url( __FILE__ ).'assets/img/logo-wp.png', 57 );
        
		add_submenu_page( 'phoeniixx', $page_title, $menu_title, $capability, $menu_slug, $function );

	}
	
    add_action("admin_menu","ph_infinite_add_menu",99);
	 
	function infi_settings()
	{
		
		echo"<h3>Infinite Scrolling Plugin Settings </h3>";
	
		if(isset($_POST['submit']))
		{
			
			$checkbox_status = $_POST['scrolling'];
			
		    $img_url = ($_POST['loader_img'])? $_POST['loader_img'] : plugins_url( '' , __FILE__ ).'/assets/img/loader.gif' ;
			
			update_option("image_url", $img_url, "yes");
			
			update_option("scroll_contentSelector", $_POST['scroll_infinite_contentSelector'], "yes");
			
			update_option("scroll_nextSelector", $_POST['scroll_infinite_nextSelector'], "yes");
			
			update_option("scroll_itemSelector", $_POST['scroll_infinite_itemSelector'], "yes");
			
			if($checkbox_status == 'on')
			{
				
				$option = "scrolling_status";
				
				$value = "on";
				
				$autoload = "yes";
				
				update_option($option, $value, $autoload);
				
				echo '<div class="updated notice is-dismissible below-h2" id="message"><p>Successfully saved. </p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
			
			}
			else
			{
				
				$option = "scrolling_status";
				
				$value = "off";
				
				$autoload = "yes";
				
				update_option($option, $value, $autoload);
				
				echo '<div class="updated notice is-dismissible below-h2" id="message"><p>Successfully saved. </p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
				
			}
			
		}
		

	$tab = sanitize_text_field( $_GET['tab'] );

?>
		
			<div class="wrap" id="profile-page">
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
						<a class="nav-tab <?php if($tab == 'general' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=infinite_scrolling_settings&amp;tab=general">General</a>
						<a class="nav-tab <?php if($tab == 'allp'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=infinite_scrolling_settings&amp;tab=allp">More Plugins</a>
				</h2>
				<?php 
				if($tab == 'general' || $tab == '')
				{
					
				?>
				<form action="" id="form7" method="post">
				<table class="form-table">
				<tbody>	
				
				<tr class="user-nickname-wrap">
					<th><label>Enable Infinite Scrolling </label></th><td><input type="checkbox" id="scrolling" name="scrolling"  <?php echo (get_option("scrolling_status") == "on")? 'checked' : ''  ?>  /></td>
				</tr>
				
				<tr class="user-nickname-wrap">
					<th colspan=2><label>Note: </label>"Selectors can be ID or Class: If ID use '#id_name' and if Class use '.class_name' " </th>
				</tr>
				
				<tr class="user-nickname-wrap">
					<th><label>Content Selector	</label></th>
					<td><input type="text" class="regular-text" id="scroll_infinite_contentSelector" name="scroll_infinite_contentSelector" value ="<?php echo (get_option('scroll_contentSelector'))? get_option('scroll_contentSelector'): '' ; ?>" ><br>
						<span class="description">The Selector of section that contain's your theme's content. </span>
					</td>
				</tr>
				
				<tr class="user-nickname-wrap">
					<th><label>Next Selector </label></th>
					<td><input type="text" class="regular-text" id="scroll_infinite_nextSelector" name="scroll_infinite_nextSelector" value ="<?php echo (get_option('scroll_nextSelector'))? get_option('scroll_nextSelector'): '' ; ?>" ><br>
						<span class="description">The Selector of section that contain's Link to next page of content. </span>
					</td>
				</tr>
				
				<tr class="user-nickname-wrap">
					<th><label>Item Selector</label></th>
					<td><input type="text" class="regular-text" id="scroll_infinite_itemSelector" name="scroll_infinite_itemSelector" value ="<?php echo (get_option('scroll_itemSelector'))? get_option('scroll_itemSelector'): '' ; ?>" ><br>
						<span class="description">The Selector of section that contain's an individual post.</span>
					</td>
				</tr>
				
				<tr class="user-nickname-wrap" >
					<th><label>Loader Image </label></th><td><input type="text" class="regular-text"  id="loader_img" name="loader_img" value ="<?php echo (get_option('image_url'))? get_option('image_url'): '' ; ?>"  />  
					<input type="button" id="img_upload_button" class="button" name="img_upload_button" value="Upload"  /></td>
				</tr> 
				
				<tr class="user-nickname-wrap">
					<td colspan="2"><input type="submit" class="button button-primary" id="submit" name="submit" value="Save" /> </td>
				</tr>
				
				</tbody>	
				</table>
				</form>
				<?php
				}
				
				if($tab == 'allp')
				{
					
	
								?>
							<style>
							iframe.more-plugin {
								min-height: 1000px;
								width: 100%;
							}

							.wrap{
								margin:0;
							}
							</style>
								<iframe class="more-plugin" src="http://plugins.snapppy.com/plugins.php"></iframe> 
								<?php

				}
				?>
			</div>       
			
<?php	
	
		wp_enqueue_script("conditions-js",plugins_url( '' , __FILE__ ).'/assets/js/custom.js',array('jquery'),'',true);
	
	} 
		
    add_action('admin_enqueue_scripts', 'script_for_upload');
 
	function script_for_upload() 
	{
		
		if (isset($_GET['page']) && $_GET['page'] == 'infinite_scrolling_settings') 
		{
			
			wp_enqueue_media();
			
		}
		
	}
	
?>