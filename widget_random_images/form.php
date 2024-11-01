<p>
  <?php Echo $this->t('Title') ?>:
  <input type="text" name="<?php Echo $this->get_field_name('title') ?>" value="<?php Echo $this->get_option('title') ?>" />
</p>

<p>
  <?php Echo $this->t('Number of images') ?>:
  <input type="text" name="<?php Echo $this->get_field_name('limit') ?>" value="<?php Echo $this->get_option('limit') ?>" size="4" />
</p>
