<?php 
/**
 * @Packge    : SSDHostloud
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 */

add_shortcode( 'slider', 'hoskia_slider' );
function hoskia_slider( $atts, $content ){
	
	    $attr = shortcode_atts(
            array(
                'id' => ''
            ),
            $atts
        );
		
		// Enqueue owl carousel
		wp_enqueue_script( 'owl-carousel' );
		
		
		//
		if( !empty( $attr['id'] ) ){
			$id = $attr['id'];
		}else{
			$id = '';
		}
		
		$Css = '';
		// Uniq Id /Class 
		$uniqClass = uniqid( 'sliderwrapper' ).'-'.rand( 1, 9999 );
		
		$slidertype = get_post_meta( $id, '_hoskia_slider-type', true );
		
		$sliders = get_post_meta( $id, '_hoskia_slider-group-options', true );
		$speed 	 = get_post_meta( $id, '_hoskia_slider-slidspeed', true );
		$sliderbft 	 		= get_post_meta( $id, '_hoskia_slider-bft', true );
		$mousedrag 	 		= get_post_meta( $id, '_hoskia_slider-mousedrag', true );
		$autoplay 	 		= get_post_meta( $id, '_hoskia_slider-autoplay', true );
		$sliderNav 	 		= get_post_meta( $id, '_hoskia_slider-navactive', true );
		$genbg 	 			= get_post_meta( $id, '_hoskia_slider-genbg', true );
		$videobg 			= get_post_meta( $id, '_hoskia_slider-videobg', true );
		$activegenbgov 	= get_post_meta( $id, '_hoskia_slider-genbgov', true );
		$genoverlaycolor 	= get_post_meta( $id, '_hoskia_slider_genoverlaycolor', true );
		$genoverlayopacity 	= get_post_meta( $id, '_hoskia_slider_genoverlayopacity', true );
		$sliderTextColor 	= get_post_meta( $id, '_hoskia_slider-slidTextColor', true );
		$sliderBgColor 	    = get_post_meta( $id, '_hoskia_slider-slidBgColor', true );
		$sliderbtnColor 	= get_post_meta( $id, '_hoskia_slider-slidBtnTextColor', true );
		$sliderbtnBgColor 	= get_post_meta( $id, '_hoskia_slider-slidBtnBgColor', true );
		$sliderbtnBorderColor = get_post_meta( $id, '_hoskia_slider-sliderbtnBorderColor', true );
		
		$slidBtnhovTextColor  	 = get_post_meta( $id, '_hoskia_slider-slidBtnhovTextColor', true );
		$slidBtnhovBgColor 		 = get_post_meta( $id, '_hoskia_slider-slidBtnhovBgColor', true );
		$sliderbtnhovBorderColor = get_post_meta( $id, '_hoskia_slider-sliderbtnhovBorderColor', true );
		
		$linkbehaviour 			 = get_post_meta( $id, '_hoskia_slider-linkbehaviour', true );
		
		// slider speed
		if( $speed ){
			$speed = $speed;
		}else{
			$speed = '2000';
		}
		// slider mouse drag
		if( $mousedrag ){
			$mousedrag = true;
		}else{
			$mousedrag = false;
		}
		// slider autoplay
		if( $autoplay ){
			$autoplay = true;
		}else{
			$autoplay = false;
		}
		//  Genarel Background
		if( $genbg && !$videobg ){
			$genbg = 'data-bg-img="'.esc_url( $genbg ).'" data-depth="0.5"';
		}else{
			$genbg = '';
		}
		//  Genarel Video Background
		if( $videobg && !$genbg ){
			$videobg = 'data-bg-video="'.esc_attr( $videobg ).'"';
		}else{
			$videobg = '';
		}
		//  Genarel bg Overlay
		
		$itemgenbgov = $genbgov = '';	
		
		if( $activegenbgov == 'wrapperbg' ){
			$genbgov = ' bg--overlay';
			
		}
		if( $activegenbgov == 'singleov' ){
			$itemgenbgov = ' bg--overlay';
			
		}
		
		//  Genarel link behaviour
		if( $linkbehaviour != 'samepage' ){
			$linkbehaviour = '_blank';
		}else{
			$linkbehaviour = '';
		}
		// General Overlay color and opacity
		if( $genoverlaycolor || $genoverlayopacity ){
			
			$Css .= '#banner .banner--bg.'.esc_attr( $uniqClass ).'.bg--overlay:before{background-color:'.esc_attr( $genoverlaycolor ).';opacity:'.esc_attr( $genoverlayopacity ).';}';
			
			$Css .= '.banner--item.'.esc_attr( $uniqClass ).'.bg--overlay:before{background-color:'.esc_attr( $genoverlaycolor ).';opacity:'.esc_attr( $genoverlayopacity ).';}';
		}
		// Slider General Text color
		if( $sliderTextColor || $sliderBgColor ){
			
			$Css .= '#banner.'.esc_attr( $uniqClass ).'{background-color:'.esc_attr( $sliderBgColor ).';color:'.esc_attr( $sliderTextColor ).';}';
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .banner--content .h1{color:'.esc_attr( $sliderTextColor ).';}';
		}
		// Slider General button color
		if( $sliderbtnColor || $sliderbtnBgColor || $sliderbtnBorderColor ){
			//$sliderbtnColor
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-default{background-color:'.esc_attr( $sliderbtnBgColor ).';color:'.esc_attr( $sliderbtnColor ).';border-color:'.esc_attr( $sliderbtnBorderColor ).';}';
		}
		// Slider General button hover color
		if( $slidBtnhovTextColor || $slidBtnhovBgColor || $sliderbtnhovBorderColor ){
			//$sliderbtnColor
			$Css .= '#banner.'.esc_attr( $uniqClass ).' .btn-default:hover{background-color:'.esc_attr( $slidBtnhovBgColor ).';color:'.esc_attr( $slidBtnhovTextColor ).';border-color:'.esc_attr( $sliderbtnhovBorderColor ).';}';
		}
		
		// tubular js for Video background enqueue 
		if( $videobg ){
			wp_enqueue_script( 'tubular' );
		}
		
		
		ob_start();


// Slider type check
if( $slidertype != 'banner' ):		
?> 

<div id="banner" class="banner--section <?php echo esc_attr( $uniqClass ); ?>" data-trigger="parallax_layers">
	<div class="banner--bg<?php echo esc_attr( ' '.$uniqClass.$genbgov ); ?>" <?php echo wp_kses_post( $genbg.$videobg ); ?>></div>

	<div class="banner--slider owl-carousel" data-carousel-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-carousel-items="1" data-carousel-smartspeed="<?php echo esc_attr( $speed ); ?>" data-carousel-mousedrag="<?php echo esc_attr( $mousedrag ); ?>" data-carousel-nav="true" data-carousel-dots="true">
		<?php 
		if( is_array( $sliders ) && count( $sliders ) > 0 ):
		foreach( $sliders as $slider ):
			$bgimg 	= '';
			if( !empty( $slider['_hoskia_slider-bgimg'] ) ){
				$bgimg 	= $slider['_hoskia_slider-bgimg'];
			}
			
		?>
		<div class="banner--item">
			<div class="banner--bg<?php echo esc_attr( ' '.$uniqClass.$itemgenbgov ); ?>" data-bg-img="<?php echo esc_url( $bgimg ); ?>" data-depth="0.5"></div>
			<div class="container">
				<div class="row">
					<?php 
					$leftimg = $rightimg = $sliderimg = ''; 
					
					if( !empty( $slider['_hoskia_slider-img'] ) ){
						$sliderimg .= '<div class="banner--img col-md-5" data-depth="0.6">';
						$sliderimg .= hoskia_img_tag(
							array(
								'url' 	 => esc_url( $slider['_hoskia_slider-img'] ),
							)
						);
						$sliderimg .= '</div>';
					}
					
					// Image Position Condation
					if( !empty( $slider['_hoskia_slider-imgpos']  ) && $slider['_hoskia_slider-imgpos'] != 'right' ){
						
						$leftimg = $sliderimg;
					}else{
						$rightimg = $sliderimg;
					}
					// Image Left
					echo $leftimg;
					?>
					<div class="banner--content col-md-7">
						<?php 
						// Slider Title
						if( !empty( $slider['_hoskia_slider-title'] ) ){
							echo hoskia_heading_tag(
								array(
									'tag' 	 => 'h2',
									'text' 	 => esc_html( $slider['_hoskia_slider-title'] ),
									'class'  => 'h1',
								)
							);
						}
						// Slider description
						if( !empty( $slider['_hoskia_slider-descriptions'] ) ){
							echo hoskia_paragraph_tag(
								array(
									'text' 	 => esc_html( $slider['_hoskia_slider-descriptions'] ),
								)
							);
						}
						// Learn More Button
						if( !empty( $slider['_hoskia_sliderbutton-text'] ) && 
						!empty( $slider['_hoskia_sliderbutton-url'] ) ){
							$text = $slider['_hoskia_sliderbutton-text'];
							$url  = $slider['_hoskia_sliderbutton-url'];
							echo hoskia_anchor_tag(
								array(
									'url' 	 => esc_url( $url ),
									'text' 	 => wp_kses_post( $text ),
									'target' => esc_attr( $linkbehaviour ),
									'class'  => 'btn btn-primary',
									'id' 	 => '',
								)
							);
						}
						//
						if( !empty( $slider['_hoskia_sliderbutton-secondary-text'] ) && 
						!empty( $slider['_hoskia_sliderbutton-secondary-url'] ) ){
							
							$text = $slider['_hoskia_sliderbutton-secondary-text'];
							$url  = $slider['_hoskia_sliderbutton-secondary-url'];
							
							echo hoskia_anchor_tag(
								array(
									'url' 	 => esc_url( $url ),
									'text' 	 => wp_kses_post( $text ),
									'target' => esc_attr( $linkbehaviour ),
									'class'  => 'btn btn-secondary',
									'id' 	 => '',
								)
							);
						}
						?>
					</div>
					<?php 
					// Image right
					echo $rightimg;
					?>
					
					
				</div>
			</div>
		</div>
		<?php 
		endforeach;
		endif;
		?>
	</div>
	<?php 
	if( $sliderNav ):
	?>
	<div class="banner--slider-nav hidden-sm hidden-xs">
		<ul id="bannerSliderNav" class="nav">
			<?php 
			// Banner Slider Nav Item Start
			if( is_array( $sliders ) && count( $sliders ) > 0 ):
				$i = 0;
				foreach( $sliders as $slider ):
				
			?>
				<li class="active">
					<?php 
					
					$navicon = ( !empty( $slider['_hoskia_slider-navicon'] ) ) ? $slider['_hoskia_slider-navicon'] : '';
					
					$imgnavicon = ( !empty( $slider['_hoskia_slider-imgnavicon'] ) ) ? $slider['_hoskia_slider-imgnavicon'] : '';
					
					
					$getIcon = '';
					
					if( !$navicon ){
						$getIcon = hoskia_img_tag(
							array(
								'url' => $imgnavicon
							)
						);
					}else{
						$getIcon = '<i class="fa '.esc_attr( $navicon ).'"></i>';
					}
					
					?>
					<div class="icon">
						<?php echo wp_kses_post( $getIcon ); ?>
					</div>

					
					<div class="content bg-color--theme">
						<?php 
						if( !empty( $slider['_hoskia_slider-navtitle'] ) ){
							echo hoskia_heading_tag(
								array(
									'tag' 	 => 'h3',
									'text' 	 => esc_html( $slider['_hoskia_slider-navtitle'] ),
									'class'  => 'h3',
								)
							);
						}
						
						// Slider Nav description
						if( !empty( $slider['_hoskia_slider-navdescriptions'] ) ){
							echo hoskia_paragraph_tag(
								array(
									'text' 	 => esc_html( $slider['_hoskia_slider-navdescriptions'] ),
								)
							);
						}
						?>
					</div>
				</li>
			<?php 
				$i++;
				endforeach;
			endif;
			// Banner Slider Nav Item End
			?>
		</ul>
	</div>
	<?php 
	endif
	?>
</div>

<?php 
else :

// Banner
?>

<div id="banner" class="banner--section bg--img-bottom <?php echo esc_attr( ' '.$uniqClass.$genbgov ); ?>" <?php echo wp_kses_post( $genbg.$videobg ); ?>>

		<?php 
		if( is_array( $sliders ) && count( $sliders ) > 0 ):
		foreach( $sliders as $slider ):
		
		// Slider image
		
		$imgleft = $imgright = $sliderimage = '';

		
		if( !empty( $slider['_hoskia_slider-img'] ) ){
			
			$sliderimage .= '<div class="banner--img col-md-5">';
			$sliderimage .= hoskia_img_tag(
									array(
										'url' 	 => esc_url( $slider['_hoskia_slider-img'] ),
									)
								);
			
			if(
			!empty( $slider['_hoskia_slider-tone'] ) ||
			!empty( $slider['_hoskia_slider-ttwo'] ) ||
			!empty( $slider['_hoskia_slider-tthree'] )
			){
				$sliderimage .= '<div class="banner--offer">';
				$sliderimage .= '<div class="banner--offer-content">';
				
				//
				if( !empty( $slider['_hoskia_slider-tone'] ) ){
					$sliderimage .= '<p>'.esc_html( $slider['_hoskia_slider-tone'] ).'</p>';
				}
				//
				if( !empty( $slider['_hoskia_slider-ttwo'] ) ){
					$sliderimage .= '<h3 class="h2">'.esc_html( $slider['_hoskia_slider-ttwo'] ).'</h3>';
				}
				//
				if( !empty( $slider['_hoskia_slider-tthree'] ) ){
					$sliderimage .= '<p>'.esc_html( $slider['_hoskia_slider-tthree'] ).'</p>';
				}
				//
				if( !empty( $slider['_hoskia_slider-ofbtnurl'] ) && 
				!empty( $slider['_hoskia_slider-ofbtntext'] ) ){
					
					$sliderimage .= '<a href="'.esc_url( $slider['_hoskia_slider-ofbtnurl'] ) .'" class="btn btn-block btn-primary">'.esc_html( $slider['_hoskia_slider-ofbtntext'] ).'</a>';
					
				}
				
				$sliderimage .= '</div>';
				$sliderimage .= '</div>';
				
			}
			$sliderimage .= '</div>';
		}
		
		//
		if( !empty( $slider['_hoskia_slider-imgpos']  ) && $slider['_hoskia_slider-imgpos'] != 'right' ){
			$imgleft = $sliderimage;
		}else{
			$imgright = $sliderimage;
		}
		
		
		?>
		<div class="banner--item">
			<div class="container">
				<div class="row">
					<?php 
					// Left Image 
					echo $imgleft;
					?>
					<div class="banner--content col-md-7">
						<?php 
						// Slider Title
						if( !empty( $slider['_hoskia_slider-title'] ) ){
							echo hoskia_heading_tag(
								array(
									'tag' 	 => 'h2',
									'text' 	 => esc_html( $slider['_hoskia_slider-title'] ),
									'class'  => 'h1',
								)
							);
						}
						// Slider description
						if( !empty( $slider['_hoskia_slider-descriptions'] ) ){
							echo hoskia_paragraph_tag(
								array(
									'text' 	 => esc_html( $slider['_hoskia_slider-descriptions'] ),
								)
							);
						}
						// Learn More Button
						if( !empty( $slider['_hoskia_sliderbutton-text'] ) && !empty( $slider['_hoskia_sliderbutton-url'] ) ){
							$text = $slider['_hoskia_sliderbutton-text'];
							$url  = $slider['_hoskia_sliderbutton-url'];
							echo hoskia_anchor_tag(
								array(
									'url' 	 => esc_url( $url ),
									'text' 	 => wp_kses_post( $text.'<i class="fa flm fa-long-arrow-right"></i>' ),
									'target' => esc_attr( $linkbehaviour ),
									'class'  => 'btn btn-primary',
									'id' 	 => '',
								)
							);
						}
						?>
					</div>
					<?php
					// Slider Right Image
					echo $imgright;
					?>
				</div>
			</div>
		</div>
		<?php 
		endforeach;
		endif;
		?>


</div>


<?php 
endif;
	$inlinestyle = '';
	if( $Css ):

	$inlinestyle .= '<script typotica type="text/javascript">';
		$inlinestyle .= '( function($){
			$("head").append( "<style>'.$Css.'</style>" );
		})(jQuery);';
	$inlinestyle .= '</script>';
	
	endif;
	echo $inlinestyle;
			
$value = ob_get_clean();

return $value;

}

?>