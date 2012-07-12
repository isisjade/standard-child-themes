<?php
/**
 * The template for rendering the footer.
 *
 * @package Standard
 * @since 3.0
 */
?>
<div id="footer" class="clearfix">
	
		<?php if( ! standard_is_offline() ) { ?>
			<?php if( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) ) { ?>
				<div id="footer-widgets" class="clearfix">
					<div class="container">
						<div class="row">
						
							<div id="left-footer-widgets" class="span4 clearfix">
								<?php dynamic_sidebar( 'sidebar-3' ); ?>
							</div><!-- /#left-footer-widget -->
							
							<div id="center-footer-widgets" class="span4 clearfix">
								<?php dynamic_sidebar( 'sidebar-4' ); ?>
							</div><!-- /#center-footer-widget -->
							
							<div id="right-footer-widgets" class="span4 clearfix">
								<?php dynamic_sidebar( 'sidebar-5' ); ?>
							</div><!-- /#right-footer-widget -->
							
						</div><!-- /row -->
					</div><!-- /container -->
				</div><!-- /#footer-widgets -->
			<?php } // end if ?>							
		<?php } // end if ?>
		<div id="sub-floor" class="clearfix">
			<div class="container">
				<div class="row">
					<div id="footer-links" class="span7">
						<?php  
							if( has_nav_menu( 'footer_menu' ) && ! standard_is_offline() ) {
								wp_nav_menu( 
									array(
										'theme_location'  	=> 'footer_menu',
										'container_class' 	=> 'menu-footer-nav-container navbar',
										'items_wrap'      	=> '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
										'fallback_cb'		=> false,
										'depth'          	=> 1
									)
								); 	
							} // end if 
						?>
					</div><!-- /#footer-links -->			
					<?php $global_options = get_option( 'standard_theme_global_options' ); ?>		
					<div id="credit" class="<?php echo has_nav_menu( 'footer_menu' ) && ! standard_is_offline() ? 'span5' : 'span12'; ?>">
						<?php $standard_url = strlen( trim( $global_options['affiliate_code'] ) ) == 0 ? 'http://standardtheme.com/?utm_source=standard-theme&amp;utm_medium=footer&amp;utm_content=wp-org&amp;utm_campaign=Standard%2BFooter' : $global_options['affiliate_code'];
						$eightbit_url = 'http://8bit.io/?utm_source=standard-theme&amp;utm_medium=footer&amp;utm_content=wp-org&amp;utm_campaign=Standard%2BFooter';
						?>
						
						<?php printf( __( '&copy; %1$s %2$s &mdash; %3$s by %4$s', 'standard' ), date( 'Y' ), '<a href="' . site_url() . '">' . get_bloginfo( 'name' ) . '</a>', '<a href="' . $standard_url . '" target="_blank">Standard</a>', '<a href="' . $eightbit_url . '" target="_blank">8BIT</a>' ); ?>
						
					</div><!-- /#credits -->

				</div><!-- /row -->
			</div><!-- /.container -->
		</div><!-- /#sub-floor -->
	</div><!-- /#footer -->
	<?php wp_footer(); ?>
	</body>
</html>