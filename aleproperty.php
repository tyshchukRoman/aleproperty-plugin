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
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-shortcodes.php';
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-filters-widget.php';
require_once ALEPROPERTY_PATH . '/inc/class-aleproperty-admin.php';

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
  private AlepropertyShortcodes $shortcodes;
  private AlepropertyFiltersWidget $filtersWidget;
  private AlepropertyAdmin $admin;

  public function __construct(){
    $this->post_types = new AlepropertyPostTypes();
    $this->taxonomies = new AlepropertyTaxonomies();
    $this->metaboxes = new AlepropertyMetaboxes();
    $this->assets = new AlepropertyAssets();
    $this->templateLoader = new AlepropertyTemplateLoader();
    $this->shortcodes = new AlepropertyShortcodes(new AlepropertyTemplateLoader());
    $this->filtersWidget = new AlepropertyFiltersWidget;
    $this->admin = new AlepropertyAdmin;
  }

  public function run() {
    $this->actions();
    $this->filters();
    $this->hooks();
  }

  private function actions() {
    add_action('init', [$this->post_types, 'register']);
    add_action('init', [$this->taxonomies, 'register']);
    add_action('init', [$this->metaboxes, 'register']);
    add_action('init', [$this->assets, 'register']);
    add_action('init', [$this->templateLoader, 'register']);
    add_action('init', [$this->shortcodes, 'register']);
    add_action('admin_menu', [$this->admin, 'register']);
    add_action('widgets_init', [$this->filtersWidget, 'register']);
    add_action('plugins_loaded', [$this, 'load_text_domain']);
  }

  private function filters() {
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'add_plugin_settings_link']);
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

  public function templateLoader(): AlepropertyTemplateLoader {
    return $this->templateLoader;
  }

  public function add_plugin_settings_link($link) {
    $settings_link = '<a href="admin.php?page=aleproperty_settings">' . esc_html__('Settings', 'aleproperty') . '</a>';
    $link[] = $settings_link;
    return $link;
  }
}

if(class_exists('Aleproperty')) {

  $aleproperty = new Aleproperty();
  $aleproperty->run();
  
}
