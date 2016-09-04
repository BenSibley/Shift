<div <?php post_class(); ?>>
	<?php do_action( 'ct_shift_page_before' ); ?>
	<article>
		<div class='post-header'>
			<h1 class='post-title'><?php the_title(); ?></h1>
		</div>
		<?php ct_shift_featured_image(); ?>
		<div class="post-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array(
				'before' => '<p class="singular-pagination">' . __( 'Pages:', 'shift' ),
				'after'  => '</p>',
			) ); ?>
			<?php do_action( 'ct_shift_page_after' ); ?>
		</div>
	</article>
	<?php comments_template(); ?>
</div>