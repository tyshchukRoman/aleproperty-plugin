<?php

class AlepropertyTemplateLoader extends Gamajo_Template_Loader  {

	protected $filter_prefix = 'aleproperty';

	protected $theme_template_directory = 'aleproperty/templates';

	protected $plugin_directory = ALEPROPERTY_PATH;

	protected $plugin_template_directory = 'templates';

  public function register() {
    add_filter('template_include', [$this, 'aleproperty_templates']);
  }

  public function aleproperty_templates($template) {
    foreach (['property', 'agent'] as $post_type) {
      if(is_post_type_archive($post_type)) {
        return $this->archive_template($post_type);
      }

      if(is_single() && get_post_type() === $post_type) {
        return $this->single_template($post_type);
      }
    }

    return $template;
  }

  private function archive_template(string $post_type) {
    $theme_files = ["archive-$post_type.php", "aleproperty/archive-$post_type.php"];

    $exist = locate_template($theme_files, false);

    return $exist != '' ? $exist : ALEPROPERTY_PATH . "templates/archive-$post_type.php";
  }

  private function single_template(string $post_type) {
    $theme_files = ["single-$post_type.php", "aleproperty/single-$post_type.php"];

    $exist = locate_template($theme_files, false);

    return $exist != '' ? $exist : ALEPROPERTY_PATH . "templates/single-$post_type.php";
  }
}
