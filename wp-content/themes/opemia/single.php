<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Opemia
 */

get_header();

?>
	
	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="post single">
						<?php
						while ( have_posts() ) :
							the_post();
							
							get_template_part( 'template-parts/content/content', 'single' );

							opemia_posts_nav();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile;
						?>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
