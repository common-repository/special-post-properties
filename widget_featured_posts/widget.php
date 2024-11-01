<?php

If (!Class_Exists('wp_widget_featured_posts')){
Class wp_widget_featured_posts Extends wp_widget_special_post_properties {


  Function Init_Parameters(){
    $this->base_dir = DirName(__FILE__);
    $this->base_url = $this->base_url . '/' . BaseName($this->base_dir);
    
    $this->widget_name = $this->t('Featured posts');
    $this->widget_description = $this->t('Shows featured posts in your sidebar.');
    
    $this->widget_title = $this->t('Featured posts');

    $this->default_settings = Array(
      'title' => $this->t('Featured posts'),
      'limit' => 5
    );
    
    $this->default_style_sheet_file = 'featured-posts-widget.css';
    $this->default_style_sheet_filter = 'featured_posts_widget_style_sheet';
    
    $this->post_query_function = 'get_featured_posts';
    
    $this->default_template_file = 'featured-posts-widget.php';
    $this->default_template_filter = 'featured_posts_widget_template';
  }

  
} /* End of Class */
Add_Action ('widgets_init', Create_Function ('','Register_Widget(\'wp_widget_featured_posts\');'));
} /* End of If-Class-Exists-Condition */
/* End of File */
