<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
	<head>	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<title><?php wp_title( '' ); ?></title>
		<?php $presentation_options = get_option( 'standard_theme_presentation_options'); ?>
		<?php if( '' != $presentation_options['fav_icon'] ) { ?>
			<link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $presentation_options['fav_icon']; ?>" />
		<?php } // end if ?>
		<?php global $post; ?>
		<?php if( standard_using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) { ?>
			<link rel="author" href="<?php echo trailingslashit( $google_plus ) ?>posts"/>
		<?php } // end if ?>
		<?php $global_options = get_option( 'standard_theme_global_options' ); ?>
		<?php if( '' != $global_options['google_analytics'] ) { ?>
			<?php if( is_user_logged_in() ) { ?>
				<!-- Google Analytics is restricted only to users who are not logged in. -->
			<?php } else { ?>
				<script type="text/javascript">
					var _gaq = _gaq || [];
					_gaq.push(['_setAccount', '<?php echo $global_options[ 'google_analytics' ] ?>']);
					_gaq.push(['_trackPageview']);
		
					(function() {
						var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
						ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
				</script>
			<?php } // end if/else ?>
		<?php } // end if ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php if( standard_is_offline() && ! current_user_can( 'manage_options' ) ) { ?>
			<?php get_template_part( 'page', 'offline-mode' ); ?>
			<?php exit; ?>
		<?php } // end if ?>
		
		<?php get_template_part( 'lib/breadcrumbs/standard_breadcrumbs' ); ?>
		
		<?php if( ! has_nav_menu( 'menu_below_logo' ) || has_nav_menu( 'menu_above_logo' ) ) { ?>
			<div id="menu-above-header" class="menu-navigation navbar navbar-fixed-top">
				<div class="navbar-inner ">
					<div class="container">
		
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".above-header-nav-collapse">
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
										
						<?php if( is_front_page() || 'video' == get_post_format() || 'image' == get_post_format() || '' == get_the_title() ) { ?>					
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php } else { ?>
							<p id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>	
							</p>
						<?php } // end if/else ?>
									
						<div class="nav-collapse above-header-nav-collapse">													
							<?php
								wp_nav_menu( 
									array(
										'container_class'	=> 'menu-header-container',
										'theme_location'  	=> 'menu_above_logo',
										'items_wrap'      	=> '<ul id="%1$s" class="nav nav-menu %2$s">%3$s</ul>',
										'fallback_cb'	  	=> 'standard_fallback_nav_menu',
										'walker'			=> new Standard_Nav_Walker()
								 	)
								 );
							?>

						</div><!-- /.nav-collapse -->		
						
						<?php $social_options = get_option( 'standard_theme_social_options' ); ?>
						<?php if( '' != $social_options['active-social-icons'] ) { ?>
							<div id="social-networking" class="clearfix">
								<?php get_template_part( 'social-networking' ); ?>  
							</div><!-- /#social-networking -->	
						<?php } // end if ?>

					</div> <!-- /container -->
				</div><!-- /navbar-inner -->
			</div> <!-- /#menu-above-header -->	
		<?php } // end if ?>
		