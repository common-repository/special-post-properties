<?php

If (!Class_Exists('wp_widget_special_post_properties')){
Class wp_widget_special_post_properties Extends WP_Widget {
  var $text_domain;
  var $arr_option;
  
  var $base_dir;
  var $base_url;

  var $widget_name;
  var $widget_description;

  var $widget_title;
  
  var $default_settings;

  var $default_style_sheet_file;
  var $default_style_sheet_filter;
  
  var $post_query_function;

  var $default_template_file;
  var $default_template_filter;
  
  Function __construct(){
    // Get ready to translate
    $this->Load_TextDomain();
    
    // Base Dir, Url
    $this->base_dir = DirName(__FILE__);
    $this->base_url = get_bloginfo('wpurl').'/'.Str_Replace("\\", '/', SubStr(RealPath(DirName(__FILE__)), Strlen(ABSPATH)));
    
    // Load Instance params
    $this->Init_Parameters();

    // Setup the Widget data
    parent::__construct (
      False,
      $this->widget_name,
      Array('description' => $this->widget_description)
    );
    
    // Hooks
    Add_Action('wp_head', Array($this, 'print_header'));
  }
  
  Function Init_Parameters(){
    // Should be overwritten by the instance
  }
  
  Function Load_TextDomain(){
    $this->text_domain = get_class($this);
    load_textdomain ($this->text_domain, DirName(__FILE__).'/language/'.get_locale().'.mo');
  }
  
  Function t ($text, $context = ''){
    // Translates the string $text with context $context
    If ($context == '')
      return __ ($text, $this->text_domain);
    Else
      return _x ($text, $context, $this->text_domain);
  }

  Function load_options($options){
    $options = (ARRAY) $options;
    
    // Delete empty values
    ForEach ($options AS $key => $value)
      If (!$value) Unset($options[$key]);
    
    // Load options
    $this->arr_option = Array_Merge ( (Array) $this->default_settings, $options);
  }
  
  Function get_option($key, $default = False){
    If (IsSet($this->arr_option[$key]) && $this->arr_option[$key])
      return $this->arr_option[$key];
    Else
      return $default;
  }
  
  Function set_option($key, $value){
    $this->arr_option[$key] = $value;
  }

  Function print_header(){
    If (Is_File(get_stylesheet_directory() . '/' . $this->default_style_sheet_file ))
      $style_sheet = get_stylesheet_directory_uri() . '/' . $this->default_style_sheet_file;
    ElseIf (Is_File($this->base_dir . '/' . $this->default_style_sheet_file))
      $style_sheet = $this->base_url . '/' . $this->default_style_sheet_file;
    
    // run the filter for the template file
    $style_sheet = Apply_Filters($this->default_style_sheet_filter, $style_sheet);
    
    // Print the stylesheet link
    If ($style_sheet) : ?>
    <link rel="stylesheet" href="<?php Echo HTMLSpecialChars($style_sheet) ?>" type="text/css" />
    <?php EndIf;
  }
  
  Function get_post_query($limit = -1){
    $func = Array('wp_plugin_special_post_properties', $this->post_query_function);
    If (is_callable($func)){
      $query = call_user_func($func, $limit);
      If ($query && Is_Object($query) && $query->have_posts())
        return $query;
      Else
        return False;
    }
    Else
      return False;
  }
 
  Function widget ($args, $settings){
    // Load options
    $this->load_options ($settings); Unset ($settings);

    // Build Widget title
    $this->set_option('widget_title', $args['before_title'] . $this->get_option('title') . $args['after_title']  );

    // Look for the template file
    $template_file = Get_Query_Template(BaseName($this->default_template_file, '.php'));
    If (!Is_File($template_file) && Is_File($this->base_dir . '/' . $this->default_template_file))
      $template_file = $this->base_dir . '/' . $this->default_template_file;
    
    // run the filter for the template file
    $template_file = Apply_Filters($this->default_template_filter, $template_file);

    // Print the widet
    Echo $args['before_widget'];
    Include $template_file;      
    Echo $args['after_widget'];
    
    // Reset the post data after using the WP_Query
    WP_Reset_Postdata();
  }
 
  Function form ($settings){
    // Load options
    $this->load_options ($settings); Unset ($settings);
    
    // Show Form
    Include $this->base_dir . '/form.php';
  }
 
  Function update ($new_settings, $old_settings){
    return $new_settings;
  }
  
  Function get_post_thumbnail($post_id = Null, $image_size = 'thumbnail'){
    $func = Array('wp_plugin_special_post_properties', 'get_post_thumbnail');
    If (is_callable($func)){
      return Call_User_Func($func, $post_id, $image_size);
    }
    Else
      return False;
  }

  Function get_post_attached_image($post_id = Null, $number = 1, $orderby = 'rand', $image_size = 'thumbnail'){
    $func = Array('wp_plugin_special_post_properties', 'get_post_attached_image');
    If (is_callable($func)){
      return Call_User_Func($func, $post_id, $number, $orderby, $image_size);
    }
    Else
      return False;
  }

} /* End of Class */
} /* End of If-Class-Exists-Condition */
/* End of File */