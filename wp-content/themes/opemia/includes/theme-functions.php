<?php

if ( ! function_exists( 'opemia_breadcrumbs' ) ) :
    function opemia_breadcrumbs() {
        echo Opemia_Breadcrumbs_Class::instance()->display_items(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'opemia_posts_pagination' ) ) :
    function opemia_posts_pagination( $query = null ) {

        $classes = [];

        if ( empty( $query ) ) {
            $query = $GLOBALS['wp_query'];
        }

        if ( empty( $query->max_num_pages ) 
                || ! is_numeric( $query->max_num_pages )
                || $query->max_num_pages < 2 ) {
            return;
        }

        $paged = get_query_var( 'paged' );

        if ( ! $paged && is_front_page() && ! is_home() ) {
            $paged = get_query_var( 'page' );
        }

        $paged = $paged ? intval( $paged ) : 1;

        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $html_prev = '<i class="fa fa-angle-double-left"></i> Prev';
        $html_next = 'Next <i class="fa fa-angle-double-right"></i>';
        $links = paginate_links( array(
            'base'      => $pagenum_link,
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 1,
            'add_args'  => array_map( 'urlencode', $query_args ),
            'prev_text' => $html_prev,
            'next_text' => $html_next,
            'type'      => 'array',
        ) );

        if ( is_array( $links ) ) {
            $r = '<div class="serity-pagination"><nav aria-label="Page navigation example">';
            $r .= "<ul class='pagination'>\n\t<li class='page-item'>";
            $r .= str_replace( 'page-numbers', 'page-link', join( "</li>\n\t<li class='page-item'>", $links ) );
            $r .= "</li>\n</ul>\n";
            $r .= "</nav></div>";

            printf( $r ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
endif;

if ( ! function_exists( 'opemia_posts_nav' ) ) :
    function opemia_posts_nav() {
        global $post;

        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
        <div class="posts-control">

            <?php if ( $previous ) : ?>
                <div class="nc-post <?php if ( ! has_post_thumbnail( $previous ) ) : ?>wihout-thumb<?php endif; ?>">
                    <?php opemia_get_previous_post( $previous ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $next ) : ?>
                <div class="nc-post <?php if ( ! has_post_thumbnail( $next ) ) : ?>wihout-thumb<?php endif; ?>">
                    <?php opemia_get_next_post( $next ); ?>
                </div>
            <?php endif; ?>
        </div><!-- .nav-links -->
        <?php
    }
endif;

function opemia_get_previous_post( $post ) {
    $title = $post->post_title;

    if ( empty( $post->post_title ) ) {
        $title = esc_html__( 'Previous Post', 'opemia' );
    }

    $title = apply_filters( 'the_title', $title, $post->ID );
    $rel  = 'prev';

    $output = '';

    if ( has_post_thumbnail( $post ) ) :
        $output .= '<div class="nc-post-thumbnail">'. get_the_post_thumbnail( $post, 'serity-post-nav' ) .'</div>';
    endif;

    $output .= '<div class="nc-post-info">
        <h3><a href="' . get_permalink( $post ) . '" rel="' . $rel . '">'. $title .'</a></h3>
        <a href="' . get_permalink( $post ) . '">'. esc_html__( 'Previous', 'opemia' ) .'</a>
    </div>';

    echo wp_kses_post( $output );
}

function opemia_get_next_post( $post ) {
    $title = $post->post_title;

    if ( empty( $post->post_title ) ) {
        $title = esc_html__( 'Next Post', 'opemia' );
    }

    $title = apply_filters( 'the_title', $title, $post->ID );
    $rel  = 'next';

    $output = '';
    
    if ( has_post_thumbnail( $post ) ) :
        $output .= '<div class="nc-post-thumbnail">'. get_the_post_thumbnail( $post, 'opemia-post-nav' ) .'</div>';
    endif;

    $output .= '<div class="nc-post-info">
        <h3><a href="' . get_permalink( $post ) . '" rel="' . $rel . '">'. $title .'</a></h3>
        <a href="' . get_permalink( $post ) . '">'. esc_html__( 'Next', 'opemia' ) .'</a>
    </div>';

    echo wp_kses_post( $output );
}