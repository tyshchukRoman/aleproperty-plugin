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

if(!defined('ALEPROPERTY_PATH')) {
  define('ALEPROPERTY_PATH', plugin_dir_path(__FILE__));
}

require_once ALEPROPERTY_PATH . '/inc/AlepropertyPostTypes.php';
require_once ALEPROPERTY_PATH . '/inc/AlepropertyTaxonomies.php';
require_once ALEPROPERTY_PATH . '/inc/AlepropertyMetaboxes.php';


class Aleproperty {
  private AlepropertyPostTypes $post_types;
  private AlepropertyTaxonomies $taxonomies;
  private AlepropertyMetaboxes $metaboxes;

  public function __construct(){
    $this->post_types = new AlepropertyPostTypes();
    $this->taxonomies = new AlepropertyTaxonomies();
    $this->metaboxes = new AlepropertyMetaboxes();
  }

  public function run() {
    $this->actions();
    $this->hooks();
  }

  private function actions() {
    add_action('init', [$this->post_types, 'register']);
    add_action('init', [$this->taxonomies, 'register']);
    add_action('init', [$this->metaboxes, 'register']);
  }

  private function hooks() {
    register_activation_hook(__FILE__, [$this, 'activation']);
    register_deactivation_hook(__FILE__, [$this, 'deactivation']);
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
  $aleproperty->run();
  
}
