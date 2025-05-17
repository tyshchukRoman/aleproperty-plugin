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
  static function activation() {
    flush_rewrite_rules();
  }

  static function deactivation() {
    flush_rewrite_rules();
  }
}

if(class_exists('Aleproperty')) {
  $aleproperty = new Aleproperty();
}

register_activation_hook(__FILE__, [$aleproperty, 'activation']);
register_deactivation_hook(__FILE__, [$aleproperty, 'deactivation']);
