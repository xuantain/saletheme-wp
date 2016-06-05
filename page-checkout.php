<?php
/**
 * Template Name: CheckoutPage
 */

get_header(); ?>
<div class="container">
		<div class="row">
				<div class="span12 grid_content">
					<?php $post_id = $wp_query->get_queried_object_id();
							$title = get_post_field( 'post_title', $post_id ); ?>
						<h1 class="page-title"><?php echo $title; ?></h1>
						<?php
						/* Run the loop to output the posts.
						 * If you want to overload this in a child theme then include a file
						 * called loop-index.php and that will be used instead.
						 */
						get_template_part( 'loop', 'page' );
						?>
				</div><!-- #content -->
				<!-- <div class="span3 sidebar_grid"> -->
						<?php //get_sidebar(); ?>
				<!-- </div> -->
				<div class="clear"></div>
		</div>
</div><!-- .container -->
<?php get_footer(); ?>
