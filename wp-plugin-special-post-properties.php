<?php

/*

Plugin Name: Special Post Properties
Plugin URI: http://dennishoppe.de/wordpress-plugins/special-post-properties
Description: Adds some special properties to your posts. 
Version: 1.1.4
Author: Dennis Hoppe
Author URI: http://DennisHoppe.de

*/


If (!Class_Exists('wp_plugin_special_post_properties')){
Class wp_plugin_special_post_properties {
  var $text_domain;
  
  Function __construct(){
    // Get ready to translate
    $this->Load_TextDomain();
    
    // Add MetaBox and Set Action to save it
    Add_Action( 'admin_menu', Array($this, 'Add_Meta_Box') );
    Add_Action( 'save_post', Array($this, 'Save_Meta_Box_Inputs') );
    
    // Add post classes
    Add_Action( 'post_class', Array($this, 'post_class') );

    // Include Widgets
    Include_Once DirName(__FILE__) . '/special-post-properties-widget.php';
    Include_Once DirName(__FILE__) . '/widget_featured_posts/widget.php';
    Include_Once DirName(__FILE__) . '/widget_gallery_posts/widget.php';
    Include_Once DirName(__FILE__) . '/widget_random_images/widget.php';
    Include_Once DirName(__FILE__) . '/widget_portfolio_items/widget.php';
    
  }
  
  Function Load_TextDomain(){
    $this->text_domain = get_class($this);
    load_textdomain ($this->text_domain, DirName(__FILE__).'/language/'.get_locale().'.mo');
  }
  
  Function t ($text, $context = ''){
    // Translates the string $text with context $context
    If ($context == '')
      return __($text, $this->text_domain);
    Else
      return _x($text, $context, $this->text_domain);
  }
  
  Function Add_Meta_Box(){
    Add_Meta_Box( 'post_special_properties',
                  $this->t('Special properties of this post'),
                  Array($this, 'print_meta_box'),
                  'post',
                  'side',
                  'low' );
  }
  
  Function Print_Meta_Box(){
    ?>
    <p>
      <small><?php Echo $this->t('Here you can select additional special properties of this post.') ?></small>
    </p>
    
    <p>
      <input type="checkbox" name="<?php Echo self::Meta_Key() ?>[is_featured]" value="yes" <?php Checked ($this->is_featured()) ?> />
      <?php Echo $this->t('Featured post') ?>
    </p>

    <p>
      <input type="checkbox" name="<?php Echo self::Meta_Key() ?>[is_gallery]" value="yes" <?php Checked ($this->is_gallery()) ?> />
      <?php Echo $this->t('Gallery post') ?>
    </p>

    <p>
      <input type="checkbox" name="<?php Echo self::Meta_Key() ?>[is_portfolio_item]" value="yes" <?php Checked ($this->is_portfolio_item()) ?> />
      <?php Echo $this->t('Portfolio item') ?>
    </p>
    <?php
  }
  
  Function Meta_Key(){
    // This is the meta key base for all values
    return '_' . __CLASS__;
  }
  
  Function Save_Meta_Box_Inputs($post_id){
    // If this is an autosave we dont care
    If ( Defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return False;
    
    // Get the meta key base
    $meta_key = $this->meta_key();
    
    // Delete all old meta field
    $arr_custom_field = get_post_custom_keys($post_id);
    If (Is_Array($arr_custom_field)){
      ForEach ($arr_custom_field AS $key)
        If (SubStr($key, 0, StrLen($meta_key)) == $meta_key)
          delete_post_meta($post_id, $key);
    }
    
    // if there are no values of our form we dont care
    If (!IsSet ($_REQUEST[$meta_key])) return False;

    // Save as meta data in the post
    ForEach ($_REQUEST[$meta_key] AS $key => $property)
      update_post_meta ($post_id, $meta_key.'_'.$key, $property);
  }
  
  Function post_class ($arr_class){
    // Read Post id
    $post_id = get_the_id();
    
    // check the class Array
    If (!Is_Array($arr_class)) $arr_class = Array();
    
    // Check if the post has any properties
    If ($this->is_featured()) $arr_class[] = 'featured-post';
    If ($this->is_gallery()) $arr_class[] = 'gallery-post';
    If ($this->is_portfolio_item()) $arr_class[] = 'portfolio-item';
    
    // return the classes
    return $arr_class;
  }
  
  Function CheckForMeta ($meta_key, $post_id = Null){
    If ($post_id == Null){
      Global $post;
      $post_id = $post->ID;
    }
    Else $post_id = IntVal ($post_id);

    If (get_post_meta($post_id, self::meta_key().'_'.$meta_key, True))
      return True;
    Else
      return False;
  }
  
  Function get_query_by_meta_key($key, $limit = -1){
    $query = New WP_Query (Array(
      'meta_key' => self::meta_key() . '_' . $key,
      'posts_per_page' => $limit,
      'caller_get_posts' => 1 ));
    
    If ($query->have_posts())
      return $query;
    Else
      return False;
  }


  Function is_featured ($post_id = Null){
    return self::CheckForMeta('is_featured', $post_id);
  }
  
  Function is_gallery ($post_id = Null){
    return self::CheckForMeta('is_gallery', $post_id);
  }

  Function is_portfolio_item ($post_id = Null){
    return self::CheckForMeta('is_portfolio_item', $post_id);
  }
  
  
  Function get_featured_posts ($limit = -1){
    return self::get_query_by_meta_key('is_featured', $limit);
  }
  
  Function get_gallery_posts ($limit = -1){
    return self::get_query_by_meta_key('is_gallery', $limit);
  }
  
  Function get_portfolio_posts ($limit = -1){
    return self::get_query_by_meta_key('is_portfolio_item', $limit);
  }

  Function get_post_thumbnail($post_id = Null, $image_size = 'thumbnail'){
    /* Return Value: An array containing:
         $image[0] => attachment id
         $image[1] => url
         $image[2] => width
         $image[3] => height
    */
    If ($post_id == Null) $post_id = get_the_id();
    
    If (Function_Exists('get_post_thumbnail_id') && $thumb_id = get_post_thumbnail_id($post_id) )
      return Array_Merge ( Array($thumb_id), wp_get_attachment_image_src($thumb_id, $image_size) );
    ElseIf ($arr_thumb = self::get_post_attached_image($post_id, 1, 'rand', $image_size))
      return $arr_thumb[0];
    Else
      return False;
  }

  Function get_post_attached_image($post_id = Null, $number = 1, $orderby = 'rand', $image_size = 'thumbnail'){
    If ($post_id == Null) $post_id = get_the_id();
    $number = IntVal ($number);

    $arr_attachment = get_posts (Array( 'post_parent'    => $post_id,
                                        'post_type'      => 'attachment',
                                        'numberposts'    => $number,
                                        'post_mime_type' => 'image',
                                        'orderby'        => $orderby ));
    
    // Check if there are attachments
    If (Empty($arr_attachment)) return False;
    
    // Convert the attachment objects to urls
    ForEach ($arr_attachment AS $index => $attachment){
      $arr_attachment[$index] = Array_Merge ( Array($attachment->ID), wp_get_attachment_image_src ($attachment->ID, $image_size));
      /* Return Value: An array containing:
           $image[0] => attachment id
           $image[1] => url
           $image[2] => width
           $image[3] => height
      */
    }
    
    return $arr_attachment;
  }


} /* End of Class */
New wp_plugin_special_post_properties();
Require_Once DirName(__FILE__).'/contribution.php';
} /* End of If-Class-Exists-Condition */
/* End of File */