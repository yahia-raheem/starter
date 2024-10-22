<?php

/**
 * Widget API: WP_Widget_Categories class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class My_Widget_Custom_Categories extends WP_Widget
{

    /**
     * Sets up a new Categories widget instance.
     *
     * @since 2.8.0
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'widget_custom_categories',
            'description'                 => __('A list or dropdown of a custom category'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('custom_categories', __('Custom Categories'), $widget_ops);
    }

    /**
     * Outputs the content for the current Categories widget instance.
     *
     * @since 2.8.0
     * @since 4.2.0 Creates a unique HTML ID for the `<select>` element
     *              if more than one instance is displayed on the page.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Categories widget instance.
     */
    public function widget($args, $instance)
    {
        static $first_dropdown = true;

        $default_title = __('Custom Categories');
        $title         = !empty($instance['title']) ? $instance['title'] : $default_title;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $count        = !empty($instance['count']) ? '1' : '0';
        $hierarchical = !empty($instance['hierarchical']) ? '1' : '0';
        $dropdown     = !empty($instance['dropdown']) ? '1' : '0';
        $taxonomy     = !empty($instance['taxonomy']) ? $instance['taxonomy'] : 'category';

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $cat_args = array(
            'orderby'      => 'name',
            'show_count'   => $count,
            'hierarchical' => $hierarchical,
            'taxonomy'     => $taxonomy
        );

        if ($dropdown) {
            printf('<form action="%s" method="get">', esc_url(home_url()));
            $dropdown_id    = ($first_dropdown) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
            $first_dropdown = false;

            echo '<label class="screen-reader-text" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

            $cat_args['show_option_none'] = __('Select Category');
            $cat_args['id']               = $dropdown_id;

            /**
             * Filters the arguments for the Categories widget drop-down.
             *
             * @since 2.8.0
             * @since 4.9.0 Added the `$instance` parameter.
             *
             * @see wp_dropdown_categories()
             *
             * @param array $cat_args An array of Categories widget drop-down arguments.
             * @param array $instance Array of settings for the current widget.
             */
            wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args, $instance));
            echo '</form>';

            $type_attr = current_theme_supports('html5', 'script') ? '' : ' type="text/javascript"';
?>

            <script<?php echo $type_attr; ?>>
                /*
                <![CDATA[ */
(function() {
	var dropdown = document.getElementById( "<?php echo esc_js($dropdown_id); ?>" );
	function onCatChange() {
		if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
			dropdown.parentNode.submit();
		}
	}
	dropdown.onchange = onCatChange;
})();
/* ]]> */
                </script>

            <?php
        } else {
            $format = current_theme_supports('html5', 'navigation-widgets') ? 'html5' : 'xhtml';

            /** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
            $format = apply_filters('navigation_widgets_format', $format);

            if ('html5' === $format) {
                // The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
                $title      = trim(strip_tags($title));
                $aria_label = $title ? $title : $default_title;
                echo '<nav role="navigation" aria-label="' . esc_attr($aria_label) . '">';
            }
            ?>

                <ul>
                    <?php
                    $cat_args['title_li'] = '';

                    /**
                     * Filters the arguments for the Categories widget.
                     *
                     * @since 2.8.0
                     * @since 4.9.0 Added the `$instance` parameter.
                     *
                     * @param array $cat_args An array of Categories widget options.
                     * @param array $instance Array of settings for the current widget.
                     */
                    wp_list_categories(apply_filters('widget_categories_args', $cat_args, $instance));
                    ?>
                </ul>

            <?php
            if ('html5' === $format) {
                echo '</nav>';
            }
        }

        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Categories widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance                 = $old_instance;
        $instance['title']        = sanitize_text_field($new_instance['title']);
        $instance['count']        = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown']     = !empty($new_instance['dropdown']) ? 1 : 0;
        $instance['taxonomy']     = !empty($new_instance['taxonomy']) ? $new_instance['taxonomy'] : 'category';

        return $instance;
    }

    /**
     * Outputs the settings form for the Categories widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        // Defaults.
        $instance     = wp_parse_args((array) $instance, array('title' => ''));
        $count        = isset($instance['count']) ? (bool) $instance['count'] : false;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : false;
        $dropdown     = isset($instance['dropdown']) ? (bool) $instance['dropdown'] : false;
        $taxonomy     = isset($instance['taxonomy']) ? $instance['taxonomy'] : 'category';
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" type="text" value="<?php echo esc_attr($taxonomy); ?>" />
            </p>

            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" <?php checked($dropdown); ?> />
                <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label>
                <br />

                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" <?php checked($count); ?> />
                <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
                <br />

                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>" <?php checked($hierarchical); ?> />
                <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e('Show hierarchy'); ?></label>
            </p>
    <?php
    }
}
