<?php

class AlepropertyTaxonomies {

  /*
   * Main method
   */
  public function register() {
    $this->register_location();
    $this->register_type();
  }

  /*
   * Taxonomy: 'location'
   */
  private function register_location() {
    register_taxonomy('location', 'property', [
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'show_admin_column' => true,
      'rewrite' => ['slug' => 'properties/location'],
      'label' => __('Location', 'aleproperty')
    ]);
  }

  /*
   * Taxonomy: 'property-type'
   */
  private function register_type() {
    register_taxonomy('property-type', 'property', [
      'hierarchical' => true,
      'show_ui' => true,
      'query_var' => true,
      'show_admin_column' => true,
      'rewrite' => ['slug' => 'properties/type'],
      'label' => __('Type', 'aleproperty')
    ]);
  }

}
