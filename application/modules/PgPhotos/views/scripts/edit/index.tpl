<?php if (!isset($this->error)): ?>
<?php $item=$this->item; ?>
<div class="header"><h3>Edit item "<?php print $item['ID'] ?>"</h3></div>
<form action="<?php print $this->form_action; ?>" name="f_update" method="post">
<table border="0" cellspacing="0" cellspading="0">
<tr><td class="meta">ID</td><td><?php print $item['ID'] ?><input type='hidden' name='s_ID' value='<?php print $item['ID'] ?>'></td></tr>
<tr><td class="meta">Filename</td><td><input type='text' name='s_Filename' value='<?php print $item['Filename'] ?>'></td></tr>
<tr><td class="meta">Description</td><td><textarea name='s_Description'><?php print $item['Description'] ?></textarea></td></tr>
<tr><td class="meta">Date_creation</td><td><input type='text' name='s_Date_creation' value='<?php print $item['Date_creation'] ?>'></td></tr>
<tr><td class="meta">Date_modification</td><td><input type='text' name='s_Date_modification' value='<?php print $item['Date_modification'] ?>'></td></tr>
<tr><td class="meta">Raiting</td><td><input type='text' name='s_Raiting' value='<?php print $item['Raiting'] ?>'></td></tr>
<tr><td class="meta">Gallery_id</td><td>
            <select name='s_Gallery_id'>
            <?php foreach($this->options_Gallery_id as $option): ?>
                <option value='<?php print $option['ID']; ?>'><?php print $option['Description']; ?></option>
            <?php endforeach; ?>
            </select></td></tr>
<tr><td class="meta">Hidden</td><td><input type='checkbox' name='s_Hidden' <?php print $item['Hidden'] ?>></td></tr>
<tr><td class="meta">Comments</td><td><input type='checkbox' name='s_Comments' <?php print $item['Comments'] ?>></td></tr>
<tr><td class="meta">Tags</td><td><input type='checkbox' name='s_Tags' <?php print $item['Tags'] ?>></td></tr>

<tr><td></td><td><br/><input type="submit" name="f_update_submit" value="Save"/><input type="button" name="f_delete" value="Delete"/></td></tr>
</form>
</table>
<?php else: ?>
<?php print $this->error; ?>
<?php endif; ?>