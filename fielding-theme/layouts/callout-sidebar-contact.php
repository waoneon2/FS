<?php
$label   = get_sub_field( 'label' );
$heading = get_sub_field( 'heading' );
$content = get_sub_field( 'content' );
?>
<article class="contact_info_wrap sidebar_component margined_lg">
	<div class="contact_info">
		<h4 class="heading_dashed"><?php echo $label; ?></h4>
		<h5 class="heading_bold"><?php echo $heading; ?></h5>
		<?php
		if ( have_rows( 'links' ) ) :
			while ( have_rows( 'links' ) ) :
				the_row();

				$type  = get_sub_field( 'type' );
				$phone = get_sub_field( 'phone' );
				$email = get_sub_field( 'email' );

				if ( 'phone' === $type ) :
		?>
		<a href="tel:+<?php echo str_ireplace( array( "-", "(", ")", "." ), "", $phone ); ?>" class="ico_phone_white"><?php echo $phone; ?></a>
		<?php
				elseif ( 'email' === $type ) :
		?>
		<a href="mailto:<?php echo $email; ?>" class="underlined"><?php echo $email; ?></a>
		<?php
				endif;
			endwhile;
		endif;

		if ( $content ) :
		?>
		<p class="gray_italic"><?php echo $content; ?></p>
		<?php
		endif;
		?>
	</div>
</article>