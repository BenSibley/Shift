<div class='search-form-container'>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search', 'shift' ); ?></label>
        <input id="search-field" type="search" class="search-field" value="" name="s"
               title="<?php esc_attr_e( 'Search for:', 'shift' ); ?>"/>
        <input type="submit" class="search-submit" value='<?php esc_attr_e( 'Search', 'shift' ); ?>'/>
    </form>
</div>