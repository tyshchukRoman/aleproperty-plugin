<?php

class AlepropertyMetaboxes {

  /*
   * Main method
   */
  public function register() {
    add_action('add_meta_boxes', [$this, 'add_property_settings']);
    add_action('save_post', [$this, 'save_property_settings'], 10, 2);
  }

  public function add_property_settings() {
    add_meta_box(
      'aleproperty_property_settings',
      'Property Settings',
      [$this, 'property_settings_html'],
      'property',
      'normal',
      'default'
    );
  }

  public function property_settings_html($post) {
    $price = get_post_meta($post->ID, 'aleproperty_price', true);
    $period = get_post_meta($post->ID, 'aleproperty_period', true);
    $type = get_post_meta($post->ID, 'aleproperty_type', true);
    $agent_id = get_post_meta($post->ID, 'aleproperty_agent', true);

    $agents = get_posts([
      'post_type' => 'agent',
      'numberposts' => -1
    ]); 

    /*
     * Display Metaboxes HTML
     */
    ?>
      <?php echo wp_nonce_field('aleproperty_field_nonce', '_aleproperty'); ?>

      <p>
        <label for="aleproperty_price"><?php _e('Price', 'aleproperty') ?></label>
        <input type="number" id="aleproperty_price" name="aleproperty_price" value="<?php echo $price ?>" />
      </p>

      <p>
        <label for="aleproperty_period"><?php _e('Period', 'aleproperty') ?></label>
        <input type="text" id="aleproperty_period" name="aleproperty_period" value="<?php echo $period ?>" />
      </p>

      <p>
        <label for="aleproperty_type"><?php _e('Type', 'aleproperty') ?></label>
        <select id="aleproperty_type" name="aleproperty_type">
          <option value=""><?php _e('Select Type', 'aleproperty') ?></option>
          <option value="sale" <?php selected('sale', $type) ?>><?php _e('For Sale', 'aleproperty') ?></option>
          <option value="rent" <?php selected('rent', $type) ?>><?php _e('For Rent', 'aleproperty') ?></option>
          <option value="sold" <?php selected('sold', $type) ?>><?php _e('Sold', 'aleproperty') ?></option>
        </select>
      </p>

      <p>
        <label for="aleproperty_agent"><?php _e('Agent', 'aleproperty') ?></label>
        <select id="aleproperty_agent" name="aleproperty_agent">
          <option value=""><?php _e('Select Agent', 'aleproperty') ?></option>
          <?php foreach($agents as $agent): ?>
            <option value="<?php echo $agent->ID ?>" <?php selected($agent->ID, $agent_id) ?>>
              <?php echo $agent->post_title ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
    <?php
  }

  public function save_property_settings($post_id, $post) {
    $this->check_nonce_field($post_id);
    $this->check_doing_autosave($post_id);
    $this->check_post_type($post_id, $post, 'property');
    $this->check_user_permission($post_id, $post);
    $this->save_meta_boxes($post_id);
  }
  
  public function check_nonce_field($post_id) {
    if(!isset($_POST['_aleproperty']) || !wp_verify_nonce($_POST['_aleproperty'], 'aleproperty_field_nonce')) {
      return $post_id;
    }
  }

  public function check_doing_autosave($post_id) {
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
    }
  }

  public function check_post_type($post_id, $post, $post_type) {
    if($post->post_type !== $post_type) {
      return $post_id;
    }
  }

  public function check_user_permission($post_id, $post) {
    $post_type = get_post_type_object($post->post_type);

    if(!current_user_can($post_type->cap->edit_post, $post_id)) {
      return $post_id;
    }
  }

  public function save_meta_boxes($post_id) {
    $metaboxes = [
      'aleproperty_price',
      'aleproperty_period',
      'aleproperty_type',
      'aleproperty_agent',
    ];

    foreach($metaboxes as $metabox) {
      $metabox_value = isset($_POST[$metabox]) ? sanitize_text_field($_POST[$metabox]) : null;

      is_null($metabox_value)
        ? delete_post_meta($post_id, $metabox)
        : update_post_meta($post_id, $metabox, $metabox_value);
    }

    return $post_id;
  }
}
