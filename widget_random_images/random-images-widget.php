<?php If (!$arr_random_image = $this->get_random_images($this->get_option('limit'))) return False; ?>

<?php Echo $this->get_option('widget_title') ?>
<div class="random-images">

<?php ForEach ($arr_random_image AS $image) : List($gallery_post, $attached_image) = $image; ?>
  <div class="thumb-frame">
    <a href="<?php Echo get_permalink($gallery_post->ID) ?>" title="<?php Echo HTMLSpecialChars($gallery_post->post_title) ?>">
      <img src="<?php Echo $attached_image[1] ?>" width="<?php Echo $attached_image[2] ?>" height="<?php Echo $attached_image[3] ?>" alt="" />
    </a>
  </div>
<?php EndForEach; ?>

</div>
