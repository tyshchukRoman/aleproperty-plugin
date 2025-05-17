<?php

class AlepropertyUninstall {
  public function run() {
    $this->delete_posts('property');
    $this->delete_posts('agent');
  }

  private function delete_posts(string $post_type) {
    $posts = get_posts([
      'post_type' => $post_type,
      'numberposts' => -1
    ]);

    foreach ($posts as $post) {
      wp_delete_post($post->ID, true);
    }
  }
}

$aleproperty_uninstall = new AlepropertyUninstall();

$aleproperty_uninstall->run();
