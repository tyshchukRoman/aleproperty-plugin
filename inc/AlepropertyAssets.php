<?php

class AlepropertyAssets {

  /*
   * Main method
   */
  public function register() {
    add_action('admin_enqueue_scripts', [$this, 'register_admin_assets']);
    add_action('wp_enqueue_scripts', [$this, 'register_front_assets']);
  }

  /*
   * Register Styles
   */
  public function register_admin_assets() {
    wp_enqueue_style('aleproperty-admin-style', ALEPROPERTY_URI . 'assets/css/admin/style.css');
    wp_enqueue_script('aleproperty-admin-main', ALEPROPERTY_URI . 'assets/js/admin/main.js', ['jquery'], '1.0', true);
  }

  /*
   * Register Scripts
   */
  public function register_front_assets() {
    wp_enqueue_style('aleproperty-front-style', ALEPROPERTY_URI . 'assets/css/front/style.css');
    wp_enqueue_script('aleproperty-front-main', ALEPROPERTY_URI . 'assets/js/front/main.js', ['jquery'], '1.0', true);
  }

}
