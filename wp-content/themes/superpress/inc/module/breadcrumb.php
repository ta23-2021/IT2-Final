<?php 
if(!function_exists('superpress_breadcrumbs')){
function superpress_breadcrumbs(){

    global $post;
    $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '<span class="delimiter">'.esc_html(get_theme_mod('superpress_breadcrumb_separator','/')).'</span>';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1){
            $title =  get_option('page_for_posts');
            if($title){
                $current = '<span class="current">'.  wp_kses_post(get_the_title($title)).'</span>' ;
            }else{
                $current = '<span class="current">'.esc_html__('Blog','superpress').'</span>';
            }
            echo '<div id="superpress-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr__('Home', 'superpress') . '</a> ' .wp_kses_post($delimiter).' '. wp_kses_post($current) . '</div>';
        }
    } else {
        echo '<div id="superpress-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr__('Home', 'superpress') . '</a> ' . wp_kses_post($delimiter) . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo wp_kses_post(get_category_parents($thisCat->parent, TRUE, ' ' . wp_kses_post($delimiter) . ' '));
            echo '<span class="current">' . esc_html__('Archive by category','superpress').' "' . single_cat_title('', false) . '"' . '</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','superpress'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . wp_kses_post($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a> ' . wp_kses_post($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . wp_kses_post($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_html(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_attr($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . wp_kses_post($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . wp_kses_post($delimiter) . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo wp_kses_post($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $obj = get_queried_object();
            if(isset($obj->label)){
                echo '<span class="current">' . esc_attr($obj->label) . '</span>';
            }
            if(isset($obj->term_id)){
                echo '<span class="current">' . esc_attr($obj->name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo superpress_sanitize_breadcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . wp_kses_post($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . wp_kses_post($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_attr__('Posts tagged','superpress').' "' . single_tag_title('', false) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','superpress'). esc_attr($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' .esc_html__( 'Error 404','superpress') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'superpress') . ' ' . esc_html(get_query_var('paged'));
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}
}

function superpress_sanitize_breadcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        ),
        'span' => array()
     );
    return wp_kses($input,$all_tags);
}