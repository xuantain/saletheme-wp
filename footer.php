<?php
/**
 * The template for displaying the footer.
 */
?>
<?php global $etheme_responsive; ?>
	<div class="container_footer_bg">
		<div class="container">
			<div class="row footer_container">
				<div class="span3 footer_block f-contacts">
					<?php if ( !is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
						<?php etheme_footer_demo(1); ?>
					<?php else: ?>
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					<?php endif; ?>
				</div>
				<div class="span3 footer_block footer-big-block">
					<?php if ( !is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
						<?php etheme_footer_demo(2); ?>
					<?php else: ?>
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					<?php endif; ?>
				</div>
				<div class="span3 footer_block">
					<?php if ( !is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
						<span class="footer_title"><?php _e( 'Recent Tweets', ETHEME_DOMAIN); ?></span>
					<?php else: ?>
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					<?php endif; ?>
				</div>
				<div class="span3 footer_block">
					<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-black-bg">
		<div class="container no-bg">
			<div class="row after_footer">
				<div class="span6" id="after_footer_logo">
					<img src="<?php echo PARENT_URL.'/images/logo-footer.png'; ?>">
				</div>
				<div class="span6" id="after_footer_menu">
					<?php if ( !is_active_sidebar( 'copyrights-area' ) ) : ?>
						<?php etheme_footer_demo(8); ?>
					<?php else: ?>
						<?php dynamic_sidebar( 'copyrights-area' ); ?>
					<?php endif; ?>
					<!-- <div class="span6 footer-copyright">
						<span class="copyright"><?php etheme_option('copyright') ?></span>
					</div> -->
				</div>
				<div class="span6" id="after_footer_payments">
					<?php if ( !is_active_sidebar( 'payments-area' ) ) : ?>
						<?php etheme_footer_demo(9); ?>
					<?php else: ?>
						<?php dynamic_sidebar( 'payments-area' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if(etheme_get_option('to_top') != 'disable'): ?>
				<div id="back-to-top" class="btn-style-<?php etheme_option('to_top') ?>">
					<a href="#top" id="top-link">
						<!-- <span><?php //_e('Back to top',ETHEME_DOMAIN) ?></span></a> -->
				</div>
			<?php endif ;?>
		</div>
	</div>
	<?php if(etheme_get_option('responsive')): ?>
	<div class="span12 responsive-switcher visible-phone visible-tablet <?php if(!$etheme_responsive) echo 'visible-desktop'; ?>">
		<?php _e('Mobile version', ETHEME_DOMAIN) ?>:
		<?php if($etheme_responsive): ?>
			<a href="<?php echo home_url(); ?>/?responsive=off"><?php _e('Enabled',	ETHEME_DOMAIN) ?></a>
		<?php else: ?>
			<a href="<?php echo home_url(); ?>/?responsive=on"><?php _e('Disabled',	ETHEME_DOMAIN) ?></a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div> <!-- .wrapper -->

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */
	wp_footer();
?>
</body>
<script lang="javascript">(function() {var pname = ( (document.title !='')? document.title : document.querySelector('meta[property="og:title"]').getAttribute('content') );var ga = document.createElement('script'); ga.type = 'text/javascript';ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=dfbf112c5b186183feb159a4ef4602a9&data=eyJzc29faWQiOjM4MjIzODAsImhhc2giOiJjYjdiMjVjY2RjOWJmZGM0Y2E5MDZiY2JjOTE1NmJkYyJ9&pname='+pname;var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script><noscript><a href="http://www.vatgia.com" title="vatgia.com" target="_blank">Tài trợ bởi vatgia.com</a></noscript><noscript><a href="http://vchat.vn" title="vchat.vn" target="_blank">Phát triển bởi vchat.vn</a></noscript>
</html>
