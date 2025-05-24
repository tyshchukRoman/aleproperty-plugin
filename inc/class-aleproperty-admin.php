<?php

class AlepropertyAdmin {
  public function register() {
    $this->add_admin_page();
  }

  public function add_admin_page() {
    add_menu_page(
      esc_html__('Aleproperty Settings Page', 'aleproperty'),
      esc_html__('Aleproperty', 'aleproperty'),
      'manage_options',
      'aleproperty_settings',
      [$this, 'admin_page_html'],
      'dashicons-admin-plugins',
      50
    );
  }

  public function admin_page_html() {
    require_once ALEPROPERTY_PATH . '/admin/welcome.php';
  }
}
