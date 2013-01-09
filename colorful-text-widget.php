<?php
/*
Plugin Name: Colorful Text Widgets
Plugin URI: http://iniyan.in/plugins/colorful-text-widget/
Description: Colorful text widget 
Author: iniyan
Version: 1.0.0
Author URI: http://iniyan.in
*/

//** Adding stylsheet **//
 add_action( 'wp_enqueue_scripts', 'ctw_add_stylesheet' );
    /**
     * Add stylesheet to the page
     */
    function ctw_add_stylesheet() {
        wp_enqueue_style( 'ctw-style', plugins_url('/css/colorful-text-widget-style.css', __FILE__) );
    }

 
    class colorful_text_widget extends WP_Widget {
        function colorful_text_widget() {
            parent::WP_Widget('colorful_text_widget', $name = 'Colorful Text Widget');
        }
 
        function widget($args, $instance) {
            extract($args);
            $title          = apply_filters('widget_title', $instance['title']);
            $widgetstyle    = apply_filters('widget_title', $instance['widgetstyle']);
            $text           = $instance['text'];
 
            echo '<div class="'.$widgetstyle.'">'."\n";
            echo    $before_widget;
            echo    $before_title.$title.$after_title;
            echo    $text;
            echo    $after_widget;
            echo '</div>'."\n";
        }
 
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']          = strip_tags($new_instance['title']);
            $instance['widgetstyle']    = strip_tags($new_instance['widgetstyle']);
            $instance['text']           = $new_instance['text'];
            return $instance;
        }
 
        function form($instance) {
            if($instance) {
                $title          = esc_attr($instance['title']);
                $widgetstyle    = esc_attr($instance['widgetstyle']);
                $text           = esc_attr($instance['text']);
            } else {
                $title          = __('', 'text_domain');
                $widgetstyle    = __('', 'text_domain');
                $text           = __('', 'text_domain');
            }
 
            echo '<p><label for="'.$this->get_field_id('title').'">'._e('Title:').'</label>';
            echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></p>';

            echo '<p><label for="'.$this->get_field_id('text').'">'._e('Text:').'</label>';
            echo '<textarea class="widefat" id="'.$this->get_field_id('text').'" name="'.$this->get_field_name('text').'" rows="20">'.$text.'</textarea></p>';


            echo '<p><label for="'.$this->get_field_id('widgetstyle').'">'._e('Widget Style:').'</label>';
            echo '<input class="widefat" id="'.$this->get_field_id('widgetstyle').'" name="'.$this->get_field_name('widgetstyle').'" type="text" 
value="'.$widgetstyle.'" /></p>';
				echo 'You can use these default styles:<p style="color:#d43;">ctw-blue, ctw-gray, ctw-green, ctw-purple, ctw-red, ctw-yellow</p> OR define some class and style it on your own.<br/><br/>';
				echo 'Check the <a href="http://iniyan.in/plugins/colorful-text-widget/#demo">colorful text widget</a> demo here'; 
        }
    }
 
    add_action('widgets_init', create_function('', 'return register_widget("colorful_text_widget");'));
?>
