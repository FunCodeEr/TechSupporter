<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" id="<?php echo esc_attr( uniqid( 'search-form-' ) ); ?>" placeholder="<?php echo esc_attr_x( 'Search Now...', 'placeholder', 'opemia' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>