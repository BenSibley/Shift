<?php do_action( 'ct_shift_main_bottom' ); ?>
</section> <!-- .main -->
<?php get_sidebar( 'primary' ); ?>
<?php do_action( 'ct_shift_after_main' ); ?>
</div><!-- .max-width -->
<footer id="site-footer" class="site-footer" role="contentinfo">
    <?php do_action( 'ct_shift_footer_top' ); ?>
    <div class="max-width">
        <div class="design-credit">
            <span>
                <?php
                $footer_text = sprintf( __( '<a href="%s">Shift WordPress Theme</a> by Compete Themes.', 'shift' ), 'https://www.competethemes.com/shift/' );
                $footer_text = apply_filters( 'ct_shift_footer_text', $footer_text );
                echo wp_kses_post( $footer_text );
                ?>
            </span>
        </div>
    </div>
</footer>
</div><!-- .overflow-container -->

<?php do_action( 'ct_shift_body_bottom' ); ?>

<?php wp_footer(); ?>

</body>
</html>