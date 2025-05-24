<?php

$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : null;
$min_price = isset($_GET['min_price']) ? sanitize_text_field($_GET['min_price']) : null;
$max_price = isset($_GET['max_price']) ? sanitize_text_field($_GET['max_price']) : null;

?>

<div class="property-filters">
  <form method="GET" action="<?php echo get_post_type_archive_link('property') ?>" class="cluster">

    <p>
      <label for="type"><?php _e('Type', 'aleproperty') ?></label>
      <select id="type" name="type">
        <option value=""><?php _e('Select Type', 'aleproperty') ?></option>
        <option value="sale" <?php selected('sale', $type) ?>><?php _e('For Sale', 'aleproperty') ?></option>
        <option value="rent" <?php selected('rent', $type) ?>><?php _e('For Rent', 'aleproperty') ?></option>
        <option value="sold" <?php selected('sold', $type) ?>><?php _e('Sold', 'aleproperty') ?></option>
      </select>
    </p>

    <p>
      <label for="min_price"><?php _e('Min Price', 'aleproperty') ?></label>
      <input type="number" id="min_price" name="min_price" value="<?php echo esc_attr($min_price) ?>" />
    </p>

    <p>
      <label for="max_price"><?php _e('Max Price', 'aleproperty') ?></label>
      <input type="number" id="max_price" name="max_price" value="<?php echo esc_attr($max_price) ?>" />
    </p>

    <p>
      <input type="submit" name="submit" value="Filter" />
    </p>

  </form>
</div>
