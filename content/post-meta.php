<div class="post-meta">
	<div class="author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 24, '', get_the_author() ); ?>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
	</div>
	<div class="date">
		<i class="fa fa-calendar"></i>
		<a class='date' href="<?php echo esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'n' ) ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_date( 'r' ) ) ); ?></a>
	</div>
	<div class="comments">
		<?php get_template_part( 'content/comments-link' ); ?>
	</div>
</div>