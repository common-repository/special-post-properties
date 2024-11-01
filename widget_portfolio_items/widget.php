<?php

If (!Class_Exists('wp_widget_portfolio_items')){
Class wp_widget_portfolio_items Extends wp_widget_special_post_properties {


  Function Init_Parameters(){
    $this->base_dir = DirName(__FILE__);
    $this->base_url = $this->base_url . '/' . BaseName($this->base_dir);
    
    $this->widget_name = $this->t('Portfolio items');
    $this->widget_description = $this->t('Shows the Portfolio items in your sidebar.');
    
    $this->widget_title = $this->t('Portfolio items');

    $this->default_settings = Array(
      'title' => $this->t('Portfolio'),
      'limit' => 5
    );
    
    $this->default_style_sheet_file = 'portfolio-items-widget.css';
    $this->default_style_sheet_filter = 'portfolio_items_widget_style_sheet';
    
    $this->post_query_function = 'get_portfolio_posts';
    
    $this->default_template_file = 'portfolio-items-widget.php';
    $this->default_template_filter = 'portfolio_items_widget_template';
  }

  
} /* End of Class */
Add_Action ('widgets_init', Create_Function ('','Register_Widget(\'wp_widget_portfolio_items\');'));
} /* End of If-Class-Exists-Condition */
/* End of File */
