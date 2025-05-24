<?php get_header(); ?>

<div class="container archive-property">
  <?php $aleproperty->templateLoader()->get_template_part('parts/property-filters'); ?>

  <div class="grid">

    <?php 
      /*
       * Filtered Query
       */
      if(!empty($_GET['submit'])) {

        $args = [
          'post_type' => 'property',
          'posts_per_page' => -1,
          'meta_query' => ['relation' => 'AND'],
          'tax_query' => ['relation' => 'AND'],
        ];

        $meta_fields = [
          [
            'name' => 'type',
            'key' => 'aleproperty_type',
            'value' => isset($_GET['type']) ? sanitize_text_field($_GET['type']) : null,
            'compare' => '=',
            'type' => 'CHAR'
          ],
          [
            'name' => 'min_price',
            'key' => 'aleproperty_price',
            'value' => isset($_GET['min_price']) ? sanitize_text_field($_GET['min_price']) : null,
            'compare' => '>=',
            'type' => 'NUMERIC'
          ],
          [
            'name' => 'max_price',
            'key' => 'aleproperty_price',
            'value' => isset($_GET['max_price']) ? sanitize_text_field($_GET['max_price']) : null,
            'compare' => '<=',
            'type' => 'NUMERIC'
          ],
        ];
        
        $tax_fields = [
          [
            'name' => 'location',
            'taxonomy' => 'location',
            'field' => 'slug',
            'terms' => isset($_GET['location']) ? sanitize_text_field($_GET['location']) : null,
          ]
        ];

        foreach ($meta_fields as $field) {
          if(!empty($_GET[$field['name']])) {
            $args['meta_query'][] = [
              'name' => $field['name'],
              'key' => $field['key'],
              'value' => $field['value'],
              'compare' => $field['compare'],
              'type' => $field['type']
            ];
          }
        }

        foreach ($tax_fields as $field) {
          if(!empty($_GET[$field['name']])) {
            $args['tax_query'][] = [
              'taxonomy' => $field['taxonomy'],
              'field' => $field['field'],
              'terms' => $field['terms']
            ];
          }
        }

        $properties = new WP_Query($args);

        if($properties->have_posts()) {
          while ($properties->have_posts()) {
            $properties->the_post();
            $aleproperty->templateLoader()->get_template_part('parts/property-card');
          }
        } else {
          _e('No posts found', 'aleproperty');
        }
      } 

      /*
       * Initial Query
       */
      else if(have_posts()) {
        while (have_posts()) {
          the_post();
          $aleproperty->templateLoader()->get_template_part('parts/property-card');
        } 
      } else {
        _e('No posts found', 'aleproperty');
      }
    ?>

  </div>
</div>

<?php get_footer(); ?>
