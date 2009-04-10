<?php foreach ( $this->options as $option ): ?>
<option
    value="<?php print $option['Field']; ?>"
    <?php if ($option['Field']==$this->stype): ?>
    selected="selected"
    <?php endif; ?>
><?php print $option['Field']; ?></option>
<?php endforeach; ?>