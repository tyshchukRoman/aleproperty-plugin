<?php get_header(); ?>

<div class="container single-property">

  <?php if(have_posts()) : ?>

      <?php while (have_posts()): the_post(); ?>

        <article id="property-<?php the_ID() ?>" <?php post_class('property flow') ?>>
          <?php
            $price = esc_html(get_post_meta(get_the_ID(), 'aleproperty_price', true));
            $type = esc_html(get_post_meta(get_the_ID(), 'aleproperty_type', true));
            $agent = get_post(esc_html(get_post_meta(get_the_ID(), 'aleproperty_agent', true)))->post_title;

            $location_terms = get_terms('location');
            $locations = array_reduce($location_terms, fn($res, $location) => $res .= "$location->name, ", '');
            $locations = rtrim($locations, ', ');
          ?>

          <?php if(get_the_title()): ?>
            <h1>
              <?php the_title() ?>
            </h1>
          <?php endif; ?>

          <?php if(has_post_thumbnail()): ?>
            <?php the_post_thumbnail('large') ?>
          <?php endif; ?>

          <div class="property__info">
            <div class="property__price">
              <?php _e('Price:', 'aleproperty'); echo " $price$"; ?>
            </div>
            <div class="property__type">
              <?php _e('Type:', 'aleproperty'); echo " $type"; ?>
            </div>
            <div class="property__agent">
              <?php _e('Agent:', 'aleproperty'); echo " $agent"; ?>
            </div>
            <div class="property__location">
              <?php _e('Location:', 'aleproperty'); echo " $locations"; ?>
            </div>
          </div>

          <?php if(get_the_content()): ?>
            <div class="property__description">
              <?php the_content() ?>
            </div>
          <?php endif; ?>
        </article>

      <?php endwhile; ?>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
