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

    if(is_post_type_archive('property')) {
      return $this->property_archive();
    }

    return $template;
  }

  private function property_archive() {
    $theme_files = ['archive-property.php', 'aleproperty/archive-property.php'];

    $exist = locate_template($theme_files, false);

    return $exist != '' ? $exist : ALEPROPERTY_PATH.'templates/archive-property.php';
  }
}
