<?php

If (!Class_Exists('wp_widget_random_images')){
Class wp_widget_random_images Extends wp_widget_special_post_properties {


  Function Init_Parameters(){
    $this->base_dir = DirName(__FILE__);
    $this->base_url = $this->base_url . '/' . BaseName($this->base_dir);
    
    $this->widget_name = $this->t('Random images');
    $this->widget_description = $this->t('Shows random images on your sidebar.');
    
    $this->widget_title = $this->t('Random images');

    $this->default_settings = Array(
      'title' => $this->t('Random images'),
      'limit' => 4
    );
    
    $this->default_style_sheet_file = 'random-images-widget.css';
    $this->default_style_sheet_filter = 'random_images_widget_style_sheet';
    
    $this->post_query_function = 'get_random_images';
    
    $this->default_template_file = 'random-images-widget.php';
    $this->default_template_filter = 'random_images_widget_template';
  }

  Function get_random_images($limit){
    $func = Array('wp_plugin_special_post_properties', 'get_gallery_post');
    $gallery_query = Call_User_Func(Array('wp_plugin_special_post_properties', 'get_gallery_posts'));
    $arr_gallery_post = (Array) $gallery_query->posts;
    
    // Get random images
    $arr_image = Array();
    ForEach ($arr_gallery_post AS $gallery_post){
      $arr_attached_image = (Array) Call_User_Func(Array('wp_plugin_special_post_properties', 'get_post_attached_image'), $gallery_post->ID, Ceil($limit / Count($arr_gallery_post)));
      ForEach ($arr_attached_image AS $attached_image){
        If (!Empty($attached_image))
          $arr_image[] = Array ($gallery_post, $attached_image);
      }
    }
    
    // Randomize items
    Shuffle ($arr_image);
    
    // Crop to the limit
    List($arr_image) = Array_Chunk ($arr_image, $limit);
    
    // return
    return $arr_image;
  }
  
} /* End of Class */
Add_Action ('widgets_init', Create_Function ('','Register_Widget(\'wp_widget_random_images\');'));
} /* End of If-Class-Exists-Condition */
/* End of File */
