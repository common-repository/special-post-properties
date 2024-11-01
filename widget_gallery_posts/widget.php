<?php

If (!Class_Exists('wp_widget_gallery_posts')){
Class wp_widget_gallery_posts Extends wp_widget_special_post_properties {


  Function Init_Parameters(){
    $this->base_dir = DirName(__FILE__);
    $this->base_url = $this->base_url . '/' . BaseName($this->base_dir);
    
    $this->widget_name = $this->t('Galleries');
    $this->widget_description = $this->t('Shows galleries on your sidebar.');
    
    $this->widget_title = $this->t('Galleries');
    
    $this->default_settings = Array(
      'title' => $this->t('Galleries'),
      'limit' => 5
    );
    
    $this->default_style_sheet_file = 'gallery-posts-widget.css';
    $this->default_style_sheet_filter = 'gallery_posts_widget_style_sheet';
    
    $this->post_query_function = 'get_gallery_posts';
    
    $this->default_template_file = 'gallery-posts-widget.php';
    $this->default_template_filter = 'gallery_posts_widget_template';
  }

  
} /* End of Class */
Add_Action ('widgets_init', Create_Function ('','Register_Widget(\'wp_widget_gallery_posts\');'));
} /* End of If-Class-Exists-Condition */
/* End of File */
