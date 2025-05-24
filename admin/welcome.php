<div class="wrap">

  <h1><?php esc_html_e('Welcome to Aleproperty', 'aleproperty') ?></h1>

  <?php settings_errors() ?>

  <form method="post" action="options.php" novalidate="novalidate">
    <?php 
      settings_fields('aleproperty_settings');
      do_settings_sections('aleproperty_settings');
      submit_button();
    ?>
  </form>
</div>
