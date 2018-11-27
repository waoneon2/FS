			<footer>
				<?php get_sidebar('bottom'); ?>
				<div class="bottom-footer">
					<div class="main-container">
						<div class="table-box">
							<div class="left-cell">
								<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/public/images/logotype-footer.png" alt="<?php bloginfo('name'); ?>"></a>
							</div>
							<div class="right-cell">
								<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-menu')); ?>
                                <a class="powered-eresources" href="http://eresources.com/"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/public/images/eresources.png" alt="eresources"></a>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<!-- Form -->
	<div class="modal-form popup" id="modal-form">
		<?php if (is_active_sidebar('contact-form')) {
			dynamic_sidebar('contact-form');
		} ?>
		<a href="tel:+1-360-329-2072" class="wpcf7-form-control wpcf7-submit call-btn">Call</a>
	</div>
	<!-- End Form -->
	</div>

<?php wp_footer(); ?>
</body>
<!-- Tracking Code for http://stpaul.academy -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:178074,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1532185680420048');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1532185680420048&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</html>
