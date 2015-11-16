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
						<a class="nav-tab <?php if($tab == 'general' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=infinite_scrolling_settings&amp;tab=general">General</a>						<a class="nav-tab <?php if($tab == 'prem'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=infinite_scrolling_settings&amp;tab=prem">Premium Version</a>														
						
				</h2>
				<style>
				.upgrade-heading{padding-left: 11px; font-size: 23px;}

				.upgrade-setting{font-size: 23px;}

				.grn-btn{  background: none repeat scroll 0 0 #6cab3d !important;
					border: medium none #6cab3d !important;}
					
				.grn-btn:hover{ background:#5a8f32 !important;}
				.phoeniixx_page_infinite_scrolling_settings .upgrade-setting {
    font-size: 18px;
    padding-left: 13px;
}
				</style>
				<?php 
				if($tab == 'general' || $tab == '')
				{
					
				?>
				<div class="meta-box-sortables" id="normal-sortables">
				<div class="postbox " id="yith_wcqv_general_videobox">
					<h3><span class="upgrade-setting">Upgrade to the PREMIUM VERSION</span></h3>
					<div class="inside">
						<div class="yith_videobox">

							<div class="column two">
								<!----<h2>Get access to Pro Features</h2>----->

								<p>Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features!</p>

									<p>
										<a target="_blank" href="http://www.phoeniixx.com/product/infinite-ajax-scrolling-for-woocommerce/?utm_source=Free%20Plugin&utm_medium=Promotion&utm_campaign=Free%20Plugin" class="button-primary grn-btn">Get access to Premium Features</a>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>
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
				if($tab == 'prem'){				?>				
				
				<div><!-------**------premium versin start from here-------**------>						
					<div class="premium-box">					
						<div class="upgrade">					
							<div class="upgrade-box">					<!--<p> Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features! </p>					-->
							<a href="http://www.phoeniixx.com/product/infinite-ajax-scrolling-for-woocommerce/?utm_source=Free%20Plugin&utm_medium=Promotion&utm_campaign=Free%20Plugin" target="_blank"><b>UPGRADE</b> to the <span class="premium-vr">premium version</span></a>					
							</div>					
						</div>					
						<ul class="premium-features">					
							<h1 class="premium-heading">Premium Feature Descriptions</h1>						<li>
								<div class="img-box"><span class="pagignation-type"></span></div>				<div class="detail">					 
									<div class="inner-detail">
										<h2>Select Types of Pagination</h2>						
											<p>	This option allows you to pick the type of Pagination you would like to have. The available options include: Infinite Scrolling, Load More Button and Ajax Pagination.</p>					  
									</div> 					
								</div>
							</li>
							
							<li><div class="detail">
									<div class="inner-detail">
										<h2>Loader Option</h2>
										<p>You have the choice to upload a Loader Image or you could choose a Loader from the available options.</p>					</div> 					 
								</div>
								<div class="img-box">
									<span class="loader-option"></span>
								</div>
							</li>
							
						  <li><div class="img-box">
							     <span class="loading-effects"></span>
							</div>					 
							<div class="detail">					 
							  <div class="inner-detail">				
                                 <h2>Select Loading Effect</h2>
							     <p>You could pick a Loading effect from a list of options (Zoom in, Bounce in, Fade in, Fade in from top to down, Fade in from down to top, Fade in from right to left, Fade in from left to right).</p>
							</div> 
						</div>	
						</li>
						
						<li><div class="detail">
							<div class="inner-detail">						   
								<h2>Styling Option</h2>							
								<p>You could also pick a Styling Option from the available options.</p>			 </div> 						
							</div>					  
							<div class="img-box">
								<span class="styling-option"></span>
							</div>
							</li>
							</ul>
							
							<div class="upgrade">
								<div class="upgrade-box"><!--<p> Switch to the premium version of Woocommerce 	Check Pincode/Zipcode for Shipping and COD to get the benefit of all features! </p>					-->
								<a href="http://www.phoeniixx.com/product/infinite-ajax-scrolling-for-woocommerce/?utm_source=Free%20Plugin&utm_medium=Promotion&utm_campaign=Free%20Plugin" target="_blank">
						<b>UPGRADE</b> to the <span class="premium-vr">premium version</span></a>					
							  </div>					
							  </div>
							  </div>
				</div>	
					<?php $plugin_dir_url = plugin_dir_url( __FILE__ ); ?>				
					
					<style type="text/css">				 							.premium-box{ width:100%; height:auto; background:#fff;  }		.premium-features{}		.premium-heading{  color: #484747;font-size: 40px;padding-top: 35px;text-align: center;text-transform: uppercase;}		.premium-features li:nth-child(1){ padding-bottom: 0;}		.premium-features li{ width:100%; float:left;  padding: 80px 0; margin: 0; }		.premium-features li .detail{ width:50%; }		.premium-features li .img-box{ width:50%; }		.premium-features li:nth-child(odd) { background:#f4f4f9; }		.premium-features li:nth-child(odd) .detail{float:right; text-align:left; }		.premium-features li:nth-child(odd) .detail .inner-detail{}		.premium-features li:nth-child(odd) .detail p{ }		.premium-features li:nth-child(odd) .img-box{ float:left; text-align:right;}		.premium-features li:nth-child(even){  }		.premium-features li:nth-child(even) .detail{ float:left; text-align:right;}		.premium-features li:nth-child(even) .detail .inner-detail{ margin-right: 46px;}		.premium-features li:nth-child(even) .detail p{ float:right;} 		.premium-features li:nth-child(even) .img-box{ float:right;}		.premium-features .detail{}		.premium-features .detail h2{ color: #484747;  font-size: 24px; font-weight: 700; padding: 0;}		.premium-features .detail p{  color: #484747;  font-size: 13px; }		/**images**/		.pagignation-type{ background:url(<?php echo $plugin_dir_url; ?>assets/img/type-pagitpic.jpg); width:507px; height:80px; display:inline-block; margin-right: 25px; background-repeat:no-repeat; background-size: 100% auto;}		.loader-option{ background:url(<?php echo $plugin_dir_url; ?>assets/img/loader-option-pic.jpg); width:500px; height:80px; display:inline-block; background-size:500px auto; margin-right:30px; background-repeat:no-repeat; background-size: 100% auto;}		.loading-effects{background:url(<?php echo $plugin_dir_url; ?>assets/img/select-loading-efefcts.png ); width:507px; height:275px; display:inline-block; background-repeat:no-repeat;}		.styling-option{background:url(<?php echo $plugin_dir_url; ?>assets/img/styling-option.png) top right ; width:92%; height:414px; display:inline-block; margin-right:30px; background-repeat:no-repeat ;background-size: 90%;  }		/*upgrade css*/		.upgrade{background:#f4f4f9;padding: 50px 0; width:100%; clear: both;}		.upgrade .upgrade-box{ background-color: #808a97;			color: #fff;			margin: 0 auto;		   min-height: 110px;			position: relative;			width: 60%;}		.upgrade .upgrade-box p{ font-size: 15px;			 padding: 19px 20px;			text-align: center;}		.upgrade .upgrade-box a{background: none repeat scroll 0 0 #6cab3d;			border-color: #ff643f;			color: #fff;			display: inline-block;			font-size: 17px;			left: 50%;			margin-left: -150px;			outline: medium none;			padding: 11px 6px;			position: absolute;			text-align: center;			text-decoration: none;			top: 36%;			width: 277px;}		.upgrade .upgrade-box a:hover{background: none repeat scroll 0 0 #72b93c;}		.premium-vr{ text-transform:capitalize;} .phoeniixx_page_infinite_scrolling_settings .upgrade-setting {
    padding-left: 11px;
}												</style>				<?php									}
				
				
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