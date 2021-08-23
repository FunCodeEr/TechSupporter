<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opemia
 */

get_header();
?>
	
	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="posts">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content/content', get_post_type() );
							endwhile;
							opemia_posts_pagination();
						else :
							get_template_part( 'template-parts/content/content', 'none' );
						endif;
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