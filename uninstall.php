<?php

class AlepropertyUninstall {
  public function run() {
    $this->delete_posts();
  }

  private function delete_posts() {
    $properties = get_posts(
      'post_type' => 'property',
      'numberposts' => -1
    );

    foreach ($properties as $property) {
      wp_delete_post($property->ID, true);
    }
  }
}

$aleproperty_uninstall = new AlepropertyUninstall();

$aleproperty_uninstall->run();
