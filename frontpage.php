<?php
/**
 * Template Name: Frontpage
 */

	global $wp_query, $current_page_id;
	$orig_query = $wp_query;
	$current_page_id = $wp_query->get_queried_object_id();
?>

<?php get_header(); ?>

<div class="container <?php echo $sidebarname; ?>">
	<div class="row">
		<div class="span8">
			<?php $frontpage_query = new WP_Query( array ( 'page_id' => $current_page_id ) ); ?>
			<?php if ( $frontpage_query->have_posts() ) : ?>
				<?php while ( $frontpage_query->have_posts() ) : $frontpage_query->the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="span4 sidebar_right">
			<?php dynamic_sidebar('about-sidebar-right'); ?>
		</div>
	</div>
</div><!-- .container -->

<?php get_footer(); ?>

<?php if ($current_page_id == '218') : ?>
<script type="text/javascript">
	function add_to_cart_redirect_ajax (_url) {
		jQuery.ajax({
			method: 'post',
			url: _url,
			success: function (res) {
				if (res) {
					window.location = './thanh-toan';
				}
			},
			error: function (err) {
				alert('Error: Cannot put to your card!');
			}
		})
	}
</script>
<?php endif; ?>
