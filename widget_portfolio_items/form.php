<p>
  <?php Echo $this->t('Title') ?>:
  <input type="text" name="<?php Echo $this->get_field_name('title') ?>" value="<?php Echo $this->get_option('title') ?>" />
</p>

<p>
  <?php Echo $this->t('Number of posts') ?>:
  <input type="text" name="<?php Echo $this->get_field_name('limit') ?>" value="<?php Echo $this->get_option('limit') ?>" size="4" />
</p>

<h3><?php Echo $this->t('Display'); ?></h3>

<p><small><?php Echo $this->t('Please select at least one of the following options. Otherwise the widget will be empty.'); ?></small><p>

<p>
  <input type="checkbox" name="<?php Echo $this->get_field_name('show_title') ?>" value="yes" <?php Checked($this->get_option('show_title'), 'yes') ?> />
  <?php Echo $this->t('Display post title'); ?>
</p>

<p>
  <input type="checkbox" name="<?php Echo $this->get_field_name('show_thumb') ?>" value="yes" <?php Checked($this->get_option('show_thumb'), 'yes') ?> />
  <?php Echo $this->t('Display thumbnail'); ?>
</p>

<p>
  <input type="checkbox" name="<?php Echo $this->get_field_name('show_excerpt') ?>" value="yes" <?php Checked($this->get_option('show_excerpt'), 'yes') ?> />
  <?php Echo $this->t('Display excerpt'); ?>
</p>