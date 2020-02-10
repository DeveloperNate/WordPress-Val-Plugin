<?php
 

class Val_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'Val_widget', // Base ID
            esc_html__( 'Val Widget', 'val_domain' ), // Name
            array( 'description' => __( 'This is a widget that will display Hearts', 'val_domain' ), ) // Args
        );
    }
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        
        echo $before_widget;
       
        
        echo $after_widget;
    }
 

 
} // class Foo_Widget
 
?>