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

        $widgetOptions = get_option('optionName'); // gets data from the setting page 

        $title = ! empty( $widgetOptions['title_string'] ) ? $widgetOptions['title_string'] : 'Heart';
		$animation = ! empty( $widgetOptions['animation_string'] ) ? $widgetOptions['animation_string'] : 'fading';
		$heart = ! empty( $widgetOptions['heart_string'] ) ? $widgetOptions['heart_string'] : 'normal'; // if statments to add default values if no value is found
        
        echo $before_widget;

       echo '<div class="textcontainer">
				<span class="hearts '.$animation.'" data-number-hearts='.$heart.' >'.$title.'</span>
		  	</div>';// add my containers and span tag
        
        echo $after_widget;
    }
 

 
} // class Foo_Widget
 
?>