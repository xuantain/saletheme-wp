<?php
/**
 * The template for displaying Author Archive pages.
 *
 */

$blog_layout = etheme_get_option('blog_layout');
$blog_sidebar = etheme_get_option('blog_sidebar');
$blog_sidebar_responsive = etheme_get_option('blog_sidebar_responsive');

get_header(); ?>
<div class="container">
		<div class="row">
				<?php if($blog_sidebar_responsive == 'top'): ?>
				<div class="col-xs-3 sidebar_grid sidebar_<?php echo $blog_sidebar ?>">
						<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
				<div class="<?php echo ($blog_sidebar)? 'col-xs-9':'col-xs-12'; ?> grid_content with-sidebar-<?php echo $blog_sidebar ?>">
				<?php
					/* Queue the first post, that way we know who
					 * the author is when we try to get their name,
					 * URL, description, avatar, etc.
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					if ( have_posts() )
						the_post();
				?>
						<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', ETHEME_DOMAIN ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>

						<?php
							// If a user has filled out their description, show a bio on their entries.
							if ( get_the_author_meta( 'description' ) ) : ?>
						<div id="entry-author-info">
								<div id="author-avatar">
										<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'etheme_author_bio_avatar_size', 60 ) ); ?>
								</div><!-- #author-avatar -->
								<div id="author-description">
										<h2><?php printf( __( 'About %s', ETHEME_DOMAIN ), get_the_author() ); ?></h2>
										<?php the_author_meta( 'description' ); ?>
								</div><!-- #author-description	-->
						</div><!-- #entry-author-info -->
						<?php endif; ?>

						<?php
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

							/* Run the loop for the author archive page to output the authors posts
							 * If you want to overload this in a child theme then include a file
							 * called loop-author.php and that will be used instead.
							 */
							 get_template_part( 'loop', 'author' );
						?>
				</div><!-- #content -->
				<?php if($blog_sidebar_responsive == 'bottom'): ?>
				<div class="col-xs-3 sidebar_grid sidebar_<?php echo $blog_sidebar ?>">
						<?php get_sidebar(); ?>
				</div>
				<?php endif; ?>
				<div class="clear"></div>
		</div>
</div><!-- .container -->
<?php get_footer(); ?>
