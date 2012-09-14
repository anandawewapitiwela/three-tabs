<?php
/**
 * Plugin Name      : AW Three Tabs Widget
 * Plugin URI       : http://ananda-wewapitiwela.blogspot.com/
 * Description      : Adds a configurable three tabs widget for your site. By default three tabs are
 *                       --'Recent'
 *                       --'Popular'
 *                       --'Tags'
 * Version          : 1.0
 * Author           : Ananda Wewapitiwela
 * Author URI       : http://ananda-wewapitiwela.blogspot.com/
 */

class three_tabs_widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'aw_three_tabs_widget', // Base ID
			'AW Three Tabs Widget', // Name
			array( 'description' => __( 'Widget with three tabs to display Recent Popular and Tags tabs', 'text_domain' ), ) // Args
		);
	}

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
    /** This function will output the widget to the User Interface - Ananda Wewapitiwela */    
                extract( $args );
                
                $title              = apply_filters('widget_title', $instance['title']);
		$tab1               = $instance['tab1'];
		$tab2               = $instance['tab2'];
		$tab3               = $instance['tab3'];
		$tab_count          = $instance['tab_count'];               
                
                /** Uncomment the following to see the incoming $instance variables */
                //echo "<pre>";
                //print_r($instance);
                //echo "<pre>";
                
              ?>

              <?php require_once 'three-tabs-display.php'; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title']              = strip_tags($new_instance['title']);                
		$instance['tab1']               = strip_tags($new_instance['tab1']);
		$instance['tab2']               = strip_tags($new_instance['tab2']);
		$instance['tab3']               = strip_tags($new_instance['tab3']);
		$instance['tab_count']          = strip_tags($new_instance['tab_count']);               
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
        
        /* Set up some default widget settings. */
        $defaults = array( 
            'title'             => 'Three Tabs', 
            'tab1'              => 'Recent',
            'tab2'              => 'Popular',
            'tab3'              => 'Tags',
            'tab_count'         => '3',         
            );
        $instance = wp_parse_args( (array) $instance, $defaults );      
        
        $title              = esc_attr($instance['title']           );
        $tab1               = esc_attr($instance['tab1']   );
	$tab2               = esc_attr($instance['tab2']    );
        $tab3               = esc_attr($instance['tab3']    );
	$tab_count          = esc_attr($instance['tab_count']     );   
        $tab_options            = array(
                                    'aw_ananda'     => 'Three Tabs',
                                    'aw_recent'     => 'Recent',
                                    'aw_popular'    => 'Popular',
                                    'aw_tags'       => 'Tags',        
                                    );
		
        ?>

        <?php
        /*
         * Gets the Title of the widget from the admin interface
         */
        ?>
        <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label> 
         <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <?php
        /*
         * Gets the first tab contents of the widget from the admin interface
         */
        ?>        
	<p>
            <label for="<?php echo $this->get_field_id('tab1'); ?>"><?php _e('First tab of Three Tabs'); ?></label>             
            <select style="width:225px;"
                    id="<?php echo $this->get_field_id('tab1'); ?>" 
                    name="<?php echo $this->get_field_name('tab1'); ?>" 

                    <?php foreach ((array)$tab_options as $_value => $_name): ?>
                    <?php $_value = !is_int($_value)?$_value:$_name; ?>
                    <option 
                            value="<?php echo $_value; ?>"
                            <?php echo $tab1 == $_value?' selected="selected"' :''; ?>
                            ><?php echo $_name; ?>
                    </option>                    
                    <?php endforeach; ?>
            </select>            
        </p>

        <?php
        /*
         * Gets the second tab contents of the widget from the admin interface
         */
        ?>         
	<p>
            <label for="<?php echo $this->get_field_id('tab2'); ?>"><?php _e('Second tab of Three Tabs'); ?></label>             
            <select style="width:225px;"
                    id="<?php echo $this->get_field_id('tab2'); ?>" 
                    name="<?php echo $this->get_field_name('tab2'); ?>" 

                    <?php foreach ((array)$tab_options as $_value => $_name): ?>
                    <?php $_value = !is_int($_value)?$_value:$_name; ?>
                    <option 
                            value="<?php echo $_value; ?>"
                            <?php echo $tab2 == $_value?' selected="selected"' :''; ?>
                            ><?php echo $_name; ?>
                    </option>                    
                    <?php endforeach; ?>
            </select>            
        </p>
        
        <?php
        /*
         * Gets the third tab contents of the widget from the admin interface
         */
        ?>         
	<p>
            <label for="<?php echo $this->get_field_id('tab3'); ?>"><?php _e('Third tab of Three Tabs'); ?></label>             
            <select style="width:225px;" 
                    id="<?php echo $this->get_field_id('tab3'); ?>" 
                    name="<?php echo $this->get_field_name('tab3'); ?>" 

                    <?php foreach ((array)$tab_options as $_value => $_name): ?>
                    <?php $_value = !is_int($_value)?$_value:$_name; ?>
                    <option 
                            value="<?php echo $_value; ?>"
                            <?php echo $tab3 == $_value?' selected="selected"' :''; ?>
                            ><?php echo $_name; ?>
                    </option>                    
                    <?php endforeach; ?>
            </select>            
        </p>        

        <?php
        /*
         * Gets the no of posts per tab to display from the admin interface
         */
        ?>         
        <p>
         <label for="<?php echo $this->get_field_id('tab_count'); ?>"><?php _e('No of posts to show'); ?></label> 
         <input id="<?php echo $this->get_field_id('tab_count'); ?>" name="<?php echo $this->get_field_name('tab_count'); ?>" type="text" value="<?php echo $tab_count; ?>" />
        </p>             
         
        <?php 
    }
} 
/**
 * Add The Three Tabs Widget to the widgets_init hook. 
 */
add_action( 'widgets_init', 'three_tabs_widget_init' );

/** 
 * Function that registers our widget. 
 */
function three_tabs_widget_init() {
	register_widget( 'three_tabs_widget' );
}
?>