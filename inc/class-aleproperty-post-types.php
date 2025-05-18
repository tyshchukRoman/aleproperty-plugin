<?php

class AlepropertyPostTypes {

  /*
   * Main method
   */
  public function register() {
    $this->register_properties();
    $this->register_agents();
  }

  /*
   * Post Type "property"
   */
  private function register_properties() {
    register_post_type('property', [
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'properties'],
      'supports' => ['title', 'editor', 'thumbnail'],
      'label' => __('Properties', 'aleproperty'),
    ]);
  }

  /*
   * Post Type "agent"
   */
  private function register_agents() {
    register_post_type('agent', [
      'public' => true,
      'has_archive' => true,
      'rewrite' => ['slug' => 'agents'],
      'supports' => ['title', 'editor', 'thumbnail'],
      'label' => __('Agents', 'aleproperty'),
    ]);
  }

}
