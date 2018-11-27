<?php
/**
 * Template For Full Width Components - Share
 *
 */
?>

<div class="share">
	<div class="fs-row">

		<div class="fs-cell fs-xl-10 fs-all-justify-center addthis_inline_share_toolbox_sg7c"
			data-url="<?php the_permalink() ?>"
			data-title="<?php the_title() ?> – <?php bloginfo('name') ?>">
			<div id="atstbx" class="share_inner" aria-labelledby="at-b0fe79b0-a75b-460e-b4eb-c366f8e9a3ed" role="region">
				<span class="share_label">Share This Page</span>
				<div class="share_tools">
					<a role="button" tabindex="1" class="share_link at-icon-wrapper at-share-btn at-svc-facebook">
						<span class="share_link_label">facebook</span>
						<span class="share_link_icon">
							<svg class="icon icon_facebook">
								<use xlink:href="<?php tric_icon('facebook') ?>"></use>
							</svg>
						</span>
					</a>
					<a role="button" tabindex="1" class="share_link at-icon-wrapper at-share-btn at-svc-twitter">
						<span class="share_link_label">twitter</span>
						<span class="share_link_icon">
							<svg class="icon icon_twitter">
								<use xlink:href="<?php tric_icon('twitter') ?>"></use>
							</svg>
						</span>
					</a>
					<a role="button" tabindex="1" class="share_link at-icon-wrapper at-share-btn at-svc-email">
						<span class="share_link_label">forward</span>
						<span class="share_link_icon">
							<svg class="icon icon_forward">
								<use xlink:href="<?php tric_icon('forward') ?>"></use>
							</svg>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>