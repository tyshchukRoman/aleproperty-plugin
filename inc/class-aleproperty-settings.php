<?php

class AlepropertySettings {
  public function register() {
    $this->settings_init();
  }

  public function settings_init() {
    register_setting('aleproperty_settings', 'aleproperty_settings_options');

    add_settings_section(
      'aleproperty_settings_section', 
      esc_html__('Settings', 'aleproperty'), 
      [$this, 'settings_section_html'], 
      'aleproperty_settings'
    );

    add_settings_field(
      'filter_title',
      esc_html__('Title for Filter', 'aleproperty'),
      [$this, 'filter_title_html'],
      'aleproperty_settings',
      'aleproperty_settings_section'
    );
  }

  public function settings_section_html() {
    esc_html_e('Section description', 'aleproperty');
  }

  public function filter_title_html() {
    $options = get_option('aleproperty_settings_options');
    $filter_title_value = isset($options['filter_title']) ? $options['filter_title'] : '';
    ?>
      <input type="text" name="aleproperty_settings_options[filter_title]" value="<?php echo esc_attr($filter_title_value); ?>" />
    <?php
  }
}
