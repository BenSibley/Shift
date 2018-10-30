<span class="comments-link">
	<i class="fas fa-comment" aria-hidden="true"></i>
	<?php
	if ( ! comments_open() && get_comments_number() < 1 ) :
		comments_number( esc_html__( 'Comments closed', 'shift' ), esc_html__( '1 Comment', 'shift' ), esc_html_x( '% Comments', 'noun: 5 comments', 'shift' ) );
	else :
		echo '<a href="' . esc_url( get_comments_link() ) . '">';
		comments_number( esc_html__( 'Leave a Comment', 'shift' ), esc_html__( '1 Comment', 'shift' ), esc_html_x( '% Comments', 'noun: 5 comments', 'shift' ) );
		echo '</a>';
	endif;
	?>
</span>