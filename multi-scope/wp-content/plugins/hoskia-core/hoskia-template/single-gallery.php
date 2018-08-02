<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}
/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

// Call Header
get_header();
?>
	<div id="gallery">
		<div class="container">
			<div class="gallery--content">
			<?php 
			if( have_posts() ):
				while( have_posts() ): the_post();
				
				//
				if( has_post_thumbnail() ){
					$url = get_the_post_thumbnail_url();
					echo '<div class="gallery--content-featured">';
						echo '<img src="'.esc_url( $url ).'" alt="'.esc_attr( hoskia_image_alt( $url ) ).'" />';
					echo '</div>';
				}
				?>
				<div class="gallery--content-title">
					<div class="btn-groups">						
						<?php 
						next_post_link( '%link', '<i class="fa fa-long-arrow-left"></i>', false  );
						previous_post_link( '%link', '<i class="fa fa-long-arrow-right"></i>', false  );
						
						?>
					</div>
					<?php 
					the_title( '<h2 class="h3">', '</h2>' );
					//
					if( hoskia_meta( 'gallery-sub-title' ) ){
						echo '<p>'.esc_html( hoskia_meta( 'gallery-sub-title' ) ).'</p>';
					}
					
					?>		
				</div>
				
				<div class="row">
					<div class="article col-md-8">
						<div class="gallery--content-text">
							<?php 
							the_content();
							?>
						</div>
					</div>
					
					<div class="aside col-md-4">
						<div class="gallery--content-sidebar bg-color--alabaster">
							<table class="table">
								<?php 
								//
								$html = '';
								if( hoskia_meta( 'clientname' ) ){
									$html .= '<tr><th><i class="fa fm fa-user"></i>Client</th><td>'.esc_html( hoskia_meta( 'clientname' ) ).'</td></tr>';
								}
								//
								
								echo $html;

								$terms = wp_get_post_terms( get_the_ID(), 'tab' );
								$tags = wp_get_post_terms( get_the_ID(), 'gallery_tag' );
								?>
								<tr>
									<th><i class="fa fm fa-th-list"></i><?php esc_html_e( 'Category', 'hoskia' ); ?></th>
									<?php 							
									if( is_array( $terms ) && count( $terms ) > 0 ){
										foreach( $terms as $term ){
											echo '<td>'.esc_html( $term->name ).'</td>';
										}
									}
									?>
								</tr>
								<tr>
									<?php 
									if( hoskia_meta( 'project-done' ) ){
										echo '<th><i class="fa fm fa-calendar"></i>'.esc_html__( 'Project Done', 'hoskia' ).'</th>';
										echo '<td>'.esc_html( hoskia_meta( 'project-done' ) ).'</td>';
									}
									?>
								</tr>
								<tr>
									<?php 
									if( is_array( $tags ) && count( $tags ) > 0 ){
										echo '<th><i class="fa fm fa-tags"></i>'.esc_html( 'Tag', 'hoskia' ).'</th>';
										echo '<td>';
										echo '<div class="tags">';
										foreach( $tags as $tag ){						
											echo '<a href="'.get_term_link( $tag->term_id ).'">'.esc_html( $tag->name ).'</a>';
										}
										echo '</div>';
										echo '</td>';
									}
									?>
								</tr>
								<?php 
								if( hoskia_meta( 'show-share-icon' ) ):
								?>
								<tr>
									<th><i class="fa fm fa-share-square-o"></i><?php echo esc_html( 'Share On', 'hoskia' ); ?></th>
									<td>
									<?php 
									echo hoskia_social_sharing_buttons( 'social nav', '' );
									?>
									</td>
								</tr>
								<?php 
								endif;
								?>
							</table>
							<?php
							if( hoskia_meta('live-preview-label') && 
								hoskia_meta('gallery-preview-url') ):
							?>
							<a href="<?php echo esc_url( hoskia_meta('gallery-preview-url') ); ?>" class="btn btn-black" target="_blank"><?php echo esc_html( hoskia_meta('live-preview-label') ); ?><i class="fa flm fa-long-arrow-right"></i></a>
							<?php 
							endif;
							?>
						</div>
					</div>
				</div>
			<?php 
				endwhile;
			endif;
			
			//
			if( hoskia_meta( 'display-more-project' ) ):
			$term = get_the_terms( get_the_ID(), 'tab' );
			if( $term ):
			?>
				<div class="gallery--related-projects">
					<div class="page--main-content-title">
						<h3 class="h3"><?php esc_html_e( 'More Projects :', 'hoskia' ); ?></h3>
					</div>
					<div class="gallery--items row">
						<?php 
						$trmId = '';
						if( !empty( $term[0]->term_id ) ){
							$trmId = $term[0]->term_id;
						}
						//
						$args = array(
							'post_type' 	 => 'gallery',
							'posts_per_page' => 3,
							'post__not_in' 		 => array( get_the_ID() ),
							'tax_query' 	 => array(
								array(
									'taxonomy'  => 'tab',
									'field' 	=> 'term_id',
									'terms' 	=> esc_html( $trmId ),
								)
							)
						);
						
						$loop = new WP_Query( $args );
						
						if( $loop->have_posts(  ) ){
							while( $loop->have_posts() ){
								$loop->the_post();
								?>
								<div class="gallery--item col-md-4">
									<figure>
										<a href="<?php the_permalink(); ?>">
										<?php 
										if( has_post_thumbnail() ){
											$url = get_the_post_thumbnail_url();
											echo '<div class="gallery--content-featured">';
												echo '<img src="'.esc_url( $url ).'" alt="'.esc_attr( hoskia_image_alt( $url ) ).'" />';
											echo '</div>';
										}
										?>
											<div class="figcaption bg--overlay">
												<div class="vc--parent">
													<div class="vc--child">
														<i class="fa fa-link"></i>
														<h3 class="h4"><?php the_title(); ?></h3>
													</div>
												</div>
											</div>
										</a>
									</figure>
								</div>
							<?php	
							}
							
						}
						?>
					</div>
				</div>
			<?php 
			endif;
			endif;
			?>
			</div>
		</div>
	</div>
<?php 
// Call Footer
get_footer();
?>