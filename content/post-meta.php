<?php

$author_display   = get_theme_mod( 'display_post_author' );
$date_display     = get_theme_mod( 'display_post_date' );
$comments_display = get_theme_mod( 'display_post_comments' );

if ( $author_display == 'hide' && $date_display == 'hide' && $comments_display == 'hide' ) {
	return;
}
?>
<div class="post-meta">
	<?php if ( $author_display != 'hide' ) : ?>
		<div class="author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 24, '', get_the_author() ); ?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
		</div>
	<?php endif; ?>
	<?php if ( $date_display != 'hide' ) : ?>
		<div class="date">
			<i class="fa fa-calendar" aria-hidden="true"></i>
			<a class='date' href="<?php echo esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'n' ) ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_date( 'r' ) ) ); ?></a>
		</div>
	<?php endif; ?>
	<?php if ( $comments_display != 'hide' ) : ?>
		<div class="post-comments">
			<?php get_template_part( 'content/comments-link' ); ?>
		</div>
	<?php endif; ?>
</div>