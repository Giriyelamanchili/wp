<?php 
if( hoskia_opt( 'hoskia_footercol_switch' ) ){
	$col = hoskia_opt( 'hoskia_footercol_switch' );
}else{
	$col = '4';
}

$colStert ='<div class="col-md-'.esc_attr( $col ).' col-sm-6 col-xs-12">';
$colEnd   ='</div>';
?>
<footer id="footer" class="footer--section">
	<?php 
	// Footer Widgets Start
	
	if( hoskia_opt('hoskia_footerwidget_switch') ):
	?>
	<div class="footer--widgets">
		<div class="container">
			<div class="row AdjustRow" data-scroll-reveal="group">
				<?php 
				// Footer Widget Start

				// Footer widget 1
				if( is_active_sidebar( 'footer-1' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-1' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 2
				if( is_active_sidebar( 'footer-2' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-2' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 3
				if( is_active_sidebar( 'footer-3' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-3' );
					echo wp_kses_post( $colEnd  );
				}
				// Footer widget 4
				if( is_active_sidebar( 'footer-4' ) ){
					echo wp_kses_post( $colStert  );
						dynamic_sidebar( 'footer-4' );
					echo wp_kses_post( $colEnd  );
				}
				?>
			</div>
		</div>
	</div>
	<?php 
	endif;
	// Footer Widgets End 
	?>
	
	<!-- Footer Copyright Start -->
	<div class="footer--copyright">
		<div class="container">
			<?php 

			$copyRight = sprintf( 'Copyright &copy; %s <a href="%s">Hoskia</a>. All Rights Reserved.', date('Y') ,'#' );

			if( hoskia_opt('hoskia_copyright_text') ){
				$copyRight = hoskia_opt('hoskia_copyright_text');
			}
			//
			if( $copyRight ){
				echo hoskia_paragraph_tag(
					array(
						'text' 	 => wp_kses_post( $copyRight ),
					)
				);
			}
				 
			// Footer Nav Links
			if( has_nav_menu('footer-menu') ){
				$args = array(
					'theme_location' => 'footer-menu',
					'menu_class' 	 => 'footer--menu',
					'depth' 		 => '2',
					'fallback_cb' 	 => 'hoskia_bootstrap_navwalker::fallback',
					'walker' 		 => new hoskia_bootstrap_navwalker(),
				);
				wp_nav_menu( $args );
			}
		
			?>
		</div>
	</div>
	<!-- Footer Copyright End -->
</footer>