<span class="comments-link">
	<i class="fa fa-comment" aria-hidden="true"></i>
	<?php
	if ( ! comments_open() && get_comments_number() < 1 ) :
		comments_number( __( 'Comments closed', 'shift' ), __( '1 Comment', 'shift' ), _x( '% Comments', 'noun: 5 comments', 'shift' ) );
	else :
		echo '<a href="' . esc_url( get_comments_link() ) . '">';
		comments_number( __( 'Leave a Comment', 'shift' ), __( '1 Comment', 'shift' ), _x( '% Comments', 'noun: 5 comments', 'shift' ) );
		echo '</a>';
	endif;
	?>
</span>