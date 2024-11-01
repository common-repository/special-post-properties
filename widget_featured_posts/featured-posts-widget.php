<?php If (!$query = $this->get_post_query($this->get_option('limit'))) return False; ?>

<?php Echo $this->get_option('widget_title') ?>
<ul class="featured-posts">
  <?php While ($query->have_posts()) : $query->the_post(); ?>
    <li>
      
      <?php If ($this->get_option('show_title')) : ?>
      <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="post-title"><?php the_title() ?></a>
      <?php EndIf; ?>
      
      <?php If ($this->get_option('show_thumb') && $thumb = $this->get_post_thumbnail()) : ?>
        <div class="thumb-frame">
          <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
            <img src="<?php Echo $thumb[1] ?>" width="<?php Echo $thumb[2] ?>" height="<?php Echo $thumb[3] ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>" class="post-thumb" />
          </a>
        </div>
      <?php EndIf; ?>
      
      <?php If ($this->get_option('show_excerpt')) : ?>
        <div class="excerpt"><?php the_excerpt(); ?></div>
      <?php EndIf; ?>
      
    </li>
  <?php EndWhile; ?>  
</ul>
