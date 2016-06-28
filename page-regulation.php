<?php
/**
 * Template Name: Regulation Page
 *
 */

global $wp_query;

extract(etheme_get_page_sidebar());

get_header();

?>
<div class="container <?php echo $sidebarname; ?>">
		<div class="row">
				<div class="col-xs-12">
					<?php blog_breadcrumbs(); ?>
				</div>
				<div class="<?php echo ($position)? 'col-xs-9':'col-xs-6'; ?> grid_content with-sidebar-<?php echo $position ?>">
					<?php $post_id = $wp_query->get_queried_object_id();
								$title = get_post_field( 'post_title', $post_id );
								$page_slug = get_post_field( 'post_name', $post_id ); ?>
						<h3 class="page-title"><?php echo $title; ?></h3>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', ETHEME_DOMAIN ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '', '' ); ?>
						<?php endwhile; ?>
					<?php else : ?>
							<p><strong><?php _e( 'Not Found', ETHEME_DOMAIN ); ?></strong></p>
							<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', ETHEME_DOMAIN ); ?></p>
							<?php get_search_form(); ?>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="col-xs-3 sidebar_grid">
						<ul class="regulation-side-bar">
							<li class="<?php echo ("gioi-thieu" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/gioi-thieu">Giới thiệu công ty</a></li>
							<li class="<?php echo ("dieu-khoan-su-dung" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/dieu-khoan-su-dung">Điều khoản sử dụng</a></li>
							<li class="<?php echo ("huong-dan-mua-hang-online" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/huong-dan-mua-hang-online">Hướng dẫn mua hàng online</a></li>
							<li class="<?php echo ("huong-dan-thanh-toan" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/huong-dan-thanh-toan">Hướng dẫn thanh toán</a></li>
							<li class="<?php echo ("chinh-sach-bao-mat" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/chinh-sach-bao-mat">Chính sách bảo mật</a></li>
							<li class="<?php echo ("chinh-sach-van-chuyen" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/chinh-sach-van-chuyen">Chính sách vận chuyển</a></li>
							<li class="<?php echo ("chinh-sach-bao-hanh" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/chinh-sach-bao-hanh">Chính sách bảo hành</a></li>
							<li class="<?php echo ("chinh-sach-doi-hang" == $page_slug) ? 'current-page' : ''; ?>">
								<a href="<?php echo site_url(); ?>/chinh-sach-doi-hang">Chính sách đổi hàng</a></li>
						</ul>
				</div>
			<?php if($position && $responsive == 'bottom'): ?>
				<div class="col-xs-3 sidebar_grid sidebar_<?php echo $position ?>">
						<?php get_sidebar($sidebarname); ?>
				</div>
			<?php endif; ?>
				<div class="clear"></div>
		</div>
</div><!-- .container -->
<?php get_footer(); ?>
