<?php

class AlepropertyShortcodes {
  private AlepropertyTemplateLoader $templateLoader;

  public function __construct($templateLoader) {
    $this->templateLoader = $templateLoader;
  }

  /*
   * Main method
   */
  public function register() {
    add_shortcode('aleproperty_filters', [$this, 'property_filters_shortcode']);
  }

  /*
   * Property Filters
   */
  public function property_filters_shortcode($atts = [], $content = null) {
    extract(shortcode_atts([
      'field_location' => '1',
      'field_type' => '1',
      'field_min_price' => '1',
      'field_max_price' => '1',
    ], $atts));

    $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : null;
    $min_price = isset($_GET['min_price']) ? sanitize_text_field($_GET['min_price']) : null;
    $max_price = isset($_GET['max_price']) ? sanitize_text_field($_GET['max_price']) : null;
    $location = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : null;

    $parent_locations = get_terms(['taxonomy' => 'location', 'hide_empty' => false, 'parent' => 0]);

    ?>

    <p class="property-filters">
      <form method="GET" action="<?php echo get_post_type_archive_link('property') ?>" class="cluster">

        <?php if($field_location): ?>
          <p>
            <label for="location"><?php _e('Location', 'aleproperty') ?></label>
            <select id="location" name="location">
              <option value=""><?php _e('Select Location', 'aleproperty') ?></option>
              <?php foreach ($parent_locations as $parent_location): ?>
                <option value="<?php esc_attr_e($parent_location->slug) ?>" <?php selected($parent_location->slug, $location) ?>>
                  <?php esc_html_e($parent_location->name) ?>
                </option>

                <?php 
                $child_locations = get_terms(['taxonomy' => 'location', 'hide_empty' => false, 'parent' => $parent_location->term_id]);

                foreach ($child_locations as $child_location): ?>
                  <option value="<?php esc_attr_e($child_location->slug) ?>" <?php selected($child_location->slug, $location) ?>>
                    <?php echo '- ' . esc_html($child_location->name) ?>
                  </option>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </select>
          </p>
        <?php endif; ?>

        <?php if($field_type): ?>
          <p>
            <label for="type"><?php _e('Type', 'aleproperty') ?></label>
            <select id="type" name="type">
              <option value=""><?php _e('Select Type', 'aleproperty') ?></option>
              <option value="sale" <?php selected('sale', $type) ?>><?php _e('For Sale', 'aleproperty') ?></option>
              <option value="rent" <?php selected('rent', $type) ?>><?php _e('For Rent', 'aleproperty') ?></option>
              <option value="sold" <?php selected('sold', $type) ?>><?php _e('Sold', 'aleproperty') ?></option>
            </select>
          </p>
        <?php endif; ?>

          
        <?php if($field_min_price): ?>
          <p>
            <label for="min_price"><?php _e('Min Price', 'aleproperty') ?></label>
            <input type="number" id="min_price" name="min_price" value="<?php echo esc_attr($min_price) ?>" />
          </p>
        <?php endif; ?>

        <?php if($field_max_price): ?>
          <p>
            <label for="max_price"><?php _e('Max Price', 'aleproperty') ?></label>
            <input type="number" id="max_price" name="max_price" value="<?php echo esc_attr($max_price) ?>" />
          </p>
        <?php endif; ?>

        <p>
          <input type="submit" name="submit" value="Filter" />
        </p>
      </form>
    </p>
    <?php
  }

}
