<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Opemia_Breadcrumbs_Class {

    private static $_instance = null;

    private $breadcrumbs = [];

    public $wrap_open = '<ul class="breadcrumb">';

    public $wrap_close = '</ul>';

    public $seperator = ' ';

    public $start_crumb_open = '<li class="home">';

    public $first_crumb_close = '</li>';

    public $crumb_open = '<li>';

    public $crumb_close = '</li>';

    public $last_crumb_open = '<li><span>';

    public $last_crumb_close = '</span></li>';

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        $this->generate_html();
    }

    // @TODO: update the class properties with arguments values
    public function display_items() {

        if ( empty( $this->breadcrumbs ) ) {
            return false;
        }

        $crumbs = [];
        $count = count( $this->breadcrumbs ) - 1;
        $is_first = false;

        foreach ( $this->breadcrumbs as $key => $crumb ) {

            if ( $is_first ) {
                $crumbs[] = $this->start_crumb_open . '<a href="' . esc_url( $crumb['url'] ) . '">' . $crumb['text'] . '</a>' . $this->first_crumb_close;
            } elseif ( $key != $count ) {
                $crumbs[] = $this->crumb_open . '<a href="' . esc_url( $crumb['url'] ) . '">' . $crumb['text'] . '</a>' . $this->crumb_close;
            } else {
                $crumbs[] = $this->last_crumb_open . $crumb['text'] . $this->last_crumb_close;
            }
        }

        return $this->wrap_open . implode( $this->seperator, $crumbs ) . $this->wrap_close;
    }

    private function generate_html() {
        global $post;

        $this->add_home_crumb();

        if ( is_singular( 'product' ) ) { 
            $this->breadcrumbs[] = array(
                'text'       => esc_html__( 'Product Details', 'opemia' ),
                'url'        => esc_url( '#' ),
                'allow_html' => false,
            );
        } elseif ( is_singular( 'post' ) ) {
            $this->breadcrumbs[] = array(
                'text'       => esc_html__( 'Latest News', 'opemia' ),
                'url'        => esc_url( '#' ),
                'allow_html' => false,
            );
        } elseif ( is_singular() ) {
            $link = get_post_type_archive_link( $post->post_type );

            if ( isset( $post->post_type ) && $link ) {
                $obj = get_post_type_object( $post->post_type );

                $this->push( $obj->labels->name, $link );
            } else {
                $this->add_ancestors_crumbs();
            }

            $this->push( esc_html( $post->post_title ) );
        } else {
            if ( is_post_type_archive() ) {
                $post_type = get_query_var('post_type');

                $obj = get_post_type_object( $post_type );
                $this->push( $obj->labels->name, get_post_type_archive_link( $post_type ) );
            } elseif ( is_tax() || is_tag() || is_category() ) {
                $this->add_taxonomy_crumbs();
            } elseif ( is_search() ) {
                $this->add_search_crumb();
            } elseif ( is_date() ) {
                if ( is_day() ) {
                    $this->add_date_crumb();
                } elseif ( is_month() ) {
                    $this->add_month_crumb();
                } elseif ( is_year() ) {
                    $this->add_year_crumb();
                }

            } elseif ( $custom_page = get_query_var('custom_page') ) {
                $this->push( $custom_page );

            } elseif ( is_404() ) {
                $this->push( 404 );
            } elseif ( is_home() ) {
                $this->push( esc_html__( 'Latest News', 'opemia' ) );
            }
        }
        
        $this->breadcrumbs = apply_filters( 'opemia_breadcrumb_links', $this->breadcrumbs );
    }

    private function add_ancestors_crumbs() {
        global $post;

        if ( isset( $post->ancestors ) ) {
            if ( is_array( $post->ancestors ) ) {
                $ancestors = array_values( $post->ancestors );
            } else {
                $ancestors = array( $post->ancestors );
            }

        } elseif ( isset( $post->post_parent ) ) {
            $ancestors = array( $post->post_parent );
        }

        foreach ( array_reverse( ( array ) $ancestors ) as $ancestor ) {
            if ( intval( $ancestor ) ) {
                $this->push( get_the_title( $ancestor ), get_the_permalink( $ancestor, $leavename = false ) );
            }
        }
    }

    private function add_search_crumb() {
        $this->push( ' "' . esc_html( get_search_query() ) . '"' );
    }
    
    private function add_year_crumb() {
        if ( $year = get_query_var('year') ) {
            $this->push( esc_html( $year ) );
        }
    }

    private function add_month_crumb() {
        global $wp_locale;

        $this->push( esc_html( single_month_title( ' ', false ) ) );
    }

    private function add_date_crumb( $date = null ) {
        if ( is_null( $date ) ) {
            $date = get_the_date();
        } else {
            $date = mysql2date( get_option( 'date_format' ), $date, true );
            $date = apply_filters( 'get_the_date', $date, '' );
        }

        $this->push( esc_html( $date ) );
    }

    private function add_taxonomy_crumbs() {
        global $wp_query;

        $org_term = $term = $wp_query->get_queried_object();

        while ( $term->parent != 0 ) {
            $term = get_term( $term->parent, $term->taxonomy );
            $this->push( $term->name, get_term_link( $term ) );
        }

        $this->push( $org_term->name, get_term_link( $org_term ) );
    }

    private function add_home_crumb() {
        $this->push( esc_html__('Home', 'opemia' ), get_home_url( '/' ), true );
    }

    private function push( $text, $url = '', $allow_html = true ) {
        $this->breadcrumbs[] = array(
            'text'       => esc_html( $text ),
            'url'        => esc_url( $url ),
            'allow_html' => $allow_html,
        );
    }
}