<?php get_header(); ?>

<div class="container single-agent">

  <?php if(have_posts()) : ?>

    <?php while (have_posts()): the_post(); ?>

      <article id="agent-<?php the_ID() ?>" <?php post_class('agent stack') ?>>
        <?php if(has_post_thumbnail()): ?>
          <?php the_post_thumbnail() ?>
        <?php endif; ?>

        <?php if(get_the_title()): ?>
          <a href="<?php the_permalink() ?>">
            <h3>
              <?php the_title() ?>
            </h3>
          </a>
        <?php endif; ?>

        <?php if(get_the_content()): ?>
          <div class="agent__description">
            <?php the_content() ?>
          </div>
        <?php endif; ?>
      </article>

    <?php endwhile; ?>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
