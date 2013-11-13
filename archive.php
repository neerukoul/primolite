<?php
/**
 * Archive Template
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */
 
get_header(); ?>

<div id="archive_page" class="container-full-width">
	
	<div class="container">
		
		<div class="container-fluid">
		
			<?php do_action( 'cyberchimps_before_container'); ?>
			
			<div id="container" <?php cyberchimps_filter_container_class(); ?>>
				
				<?php do_action( 'cyberchimps_before_content_container'); ?>
				
				<div id="content" <?php cyberchimps_filter_content_class(); ?>>
						
					<?php do_action( 'cyberchimps_before_content'); ?>
					
					<?php if ( have_posts() ) : ?>
			
						<header class="page-header">
							<h1 class="page-title">
								<?php
									if ( is_category() ) {
										printf( __( 'Category Archives: %s', 'cyberchimps' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			
									} elseif ( is_tag() ) {
										printf( __( 'Tag Archives: %s', 'cyberchimps' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			
									} elseif ( is_author() ) {
										/* Queue the first post, that way we know
										 * what author we're dealing with (if that is the case).
										*/
										the_post();
										printf( __( 'Author Archives: %s', 'cyberchimps' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
										/* Since we called the_post() above, we need to
										 * rewind the loop back to the beginning that way
										 * we can run the loop properly, in full.
										 */
										rewind_posts();
			
									} elseif ( is_day() ) {
										printf( __( 'Daily Archives: %s', 'cyberchimps' ), '<span>' . get_the_date() . '</span>' );
			
									} elseif ( is_month() ) {
										printf( __( 'Monthly Archives: %s', 'cyberchimps' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
			
									} elseif ( is_year() ) {
										printf( __( 'Yearly Archives: %s', 'cyberchimps' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
			
									} else {
										_e( 'Archives', 'cyberchimps' );
			
									}
								?>
							</h1>
							<?php
								if ( is_category() ) {
									// show an optional category description
									$category_description = category_description();
									if ( ! empty( $category_description ) )
										echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
			
								} elseif ( is_tag() ) {
									// show an optional tag description
									$tag_description = tag_description();
									if ( ! empty( $tag_description ) )
										echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
								}
							?>
						</header>
			
						<?php rewind_posts(); ?>
			
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
			
							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?>
			
						<?php endwhile; ?>
			
					<?php else : ?>
			
						<?php get_template_part( 'no-results', 'archive' ); ?>
			
					<?php endif; ?>
					
				<?php do_action( 'cyberchimps_after_content'); ?>
					
				</div><!-- #content -->
				
				<?php do_action( 'cyberchimps_after_content_container'); ?>
					
			</div><!-- #container .row-fluid-->
			
			<?php do_action( 'cyberchimps_after_container'); ?>
			
		</div><!--container fluid -->
		
	</div><!-- container -->

</div><!-- container full width -->

<?php get_footer(); ?>