<?php
/*
 * Plugin Name: Aleproperty
 * Plugin URI: #
 * Description: Aleproperty is a plugin for property menagement
 * Version: 1.0
 * Author: tyshchukRoman
 * Author URI: #
 * License: GPLv2 or later
 * Text Domain: aleproperty
 */

if(!defined('ABSPATH')) {
  die;
}

class Aleproperty {
  public function register() {
    add_action('init', [$this, 'custom_post_type']);
  }

  public function custom_post_type() {
    register_post_type('property', [
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'properties'],
      'supports' => ['title', 'editor', 'thumbnail'],
      'label' => 'Properties',
    ]);
  }

  public function activation() {
    flush_rewrite_rules();
  }

  public function deactivation() {
    flush_rewrite_rules();
  }
}

if(class_exists('Aleproperty')) {

  $aleproperty = new Aleproperty();

  $aleproperty->register();

  register_activation_hook(__FILE__, [$aleproperty, 'activation']);
  register_deactivation_hook(__FILE__, [$aleproperty, 'deactivation']);
}
