<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Hoskia
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

if( hoskia_opt( 'hoskia_fof_bgoverlay' ) ){
	$overlay = 'bg--overlay';
}else{
	$overlay = '';
}
 

?>

	<div id="f0f" class="<?php echo esc_attr( $overlay ); ?>">
		<div class="container">
			<div class="row">
				<div class="f0f--title col-md-4">
					<div class="vc--parent">
						<div class="vc--child">
							<?php 
							$errorText = esc_html__( 'Ooops 404 Error !', 'hoskia' );
							if( hoskia_opt( 'hoskia_fof_text' ) ){
								$errorText = hoskia_opt( 'hoskia_fof_text' );
							}
							?>
							<h1><?php echo esc_html( $errorText ); ?></h1>
						</div>
					</div>
				</div>
				
				<div class="f0f--content col-md-7 col-md-offset-1">
					<div class="vc--parent">
						<div class="vc--child">
							<?php 
							$img = hoskia_opt('hoskia_fof_img', 'url');
							if( $img ){
								echo hoskia_img_tag(
									array(
										'url'	=> esc_url( $img ),
									)
								);
							}

							// Sorry Test Block

							$sorryText = wp_kses_post( __( 'Ooops ! sorry we can&rsquo;t find the page', 'hoskia' ) );
							if( hoskia_opt( 'hoskia_fof_sorry_text' ) ){
								$sorryText = hoskia_opt( 'hoskia_fof_sorry_text' ); 
							}
							//
							if( $sorryText ){
								echo hoskia_heading_tag(
									array(
										'tag' 	 => 'h2',
										'text' 	 => esc_html( $sorryText ),
										'class'  => 'h2',
									)
								);
							}

							// Wrong text block

							$wrongText = wp_kses_post( __( 'Either something went wrong or the page dosen&rsquo;t exist anymore.', 'hoskia' ) );
							$gotoText = esc_html__( 'Go to.', 'hoskia' );

							if( hoskia_opt('hoskia_fof_desc') ){
								$wrongText = hoskia_opt('hoskia_fof_desc');
							}

							$anchor = hoskia_anchor_tag(
								array(
									'url' 	 => esc_url( site_url( '/' ) ),
									'text' 	 => esc_html__( 'Home page', 'hoskia' ),
								)
							);

							echo hoskia_paragraph_tag(
								array(
									'text' 	 => esc_html( $wrongText.' '.$gotoText ).' '.wp_kses_post( $anchor ),
								)
							);

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>