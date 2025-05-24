<?php

class AlepropertyFiltersWidget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'aleproperty_filters_widget', 
			'Aleproperty Filters',
			[ 'description' => 'Add Aleproperty Filters to find your property' ]
		);
	}

  public function register() {
	  register_widget($this);
  }
 
	/*
	 * Frontend
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
 
		echo $args['before_widget'];
 
    if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
    }
 
    do_shortcode('[aleproperty_filters field_location="1" field_type="1" field_min_price="0" field_max_price="0"]');
 
		echo $args['after_widget'];
	}
 
	/*
	 * backend
	 */
	public function form( $instance ) {
      if (isset($instance['title'])) {
        $title = $instance['title'];
      }
		?>
		<p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'alerproperty') ?></label> 
      <input 
        id="<?php echo $this->get_field_id( 'title' ); ?>" 
        name="<?php echo $this->get_field_name( 'title' ); ?>" 
        value="<?php esc_attr_e($title) ?>"
      />
		</p>
		<?php 
	}
 
	/*
	 * save widget settings
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = [];
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}
}
 
