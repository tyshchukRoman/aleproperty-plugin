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
 * Domain Path: /lang
 */

if(!defined('ABSPATH')) {
  die;
}

if(!defined('ALEPROPERTY_PATH')) {
  define('ALEPROPERTY_PATH', plugin_dir_path(__FILE__));
}

if(!defined('ALEPROPERTY_URI')) {
  define('ALEPROPERTY_URI', plugins_url('/', __FILE__));
}

require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-post-types.php';
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-taxonomies.php';
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-metaboxes.php';
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-assets.php';

// template loader
if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
  require_once ALEPROPERTY_PATH . '/inc/class-gamajo-template-loader.php';
}
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-template-loader.php';

class Aleproperty {
  private AlepropertyPostTypes $post_types;
  private AlepropertyTaxonomies $taxonomies;
  private AlepropertyMetaboxes $metaboxes;
  private AlepropertyAssets $assets;
  private AlepropertyTemplateLoader $templateLoader;

  public function __construct(){
    $this->post_types = new AlepropertyPostTypes();
    $this->taxonomies = new AlepropertyTaxonomies();
    $this->metaboxes = new AlepropertyMetaboxes();
    $this->assets = new AlepropertyAssets();
    $this->templateLoader = new AlepropertyTemplateLoader();
  }

  public function run() {
    $this->actions();
    $this->hooks();
  }

  public function templateLoader(): AlepropertyTemplateLoader {
    return $this->templateLoader;
  }

  private function actions() {
    add_action('init', [$this->post_types, 'register']);
    add_action('init', [$this->taxonomies, 'register']);
    add_action('init', [$this->metaboxes, 'register']);
    add_action('init', [$this->assets, 'register']);
    add_action('init', [$this->templateLoader, 'register']);

    add_action('plugins_loaded', [$this, 'load_text_domain']);
  }

  private function hooks() {
    register_activation_hook(__FILE__, [$this, 'activation']);
    register_deactivation_hook(__FILE__, [$this, 'deactivation']);
  }

  public function load_text_domain() {
    load_plugin_textdomain('aleproperty', false, dirname(plugin_basename(__FILE__)) . '/lang');
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
