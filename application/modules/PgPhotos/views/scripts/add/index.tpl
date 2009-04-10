<?php if (!isset($this->error)): ?>
<div class="header"><h3>Add item</h3></div>
<form action="<?php print $this->form_action; ?>" name="f_insert" method="post">
<table border="0" cellspacing="0" cellspading="0">
<tr><td class="meta">Filename</td><td><input type='text' name='s_Filename' value=''></td></tr>
<tr><td class="meta">Description</td><td><textarea name='s_Description'></textarea></td></tr>
<tr><td class="meta">Date_creation</td><td><input type='text' name='s_Date_creation' value=''></td></tr>
<tr><td class="meta">Date_modification</td><td><input type='text' name='s_Date_modification' value=''></td></tr>
<tr><td class="meta">Raiting</td><td><input type='text' name='s_Raiting' value=''></td></tr>
<tr><td class="meta">Gallery_id</td><td>
            <select name='s_Gallery_id'>
            <?php foreach($this->options_Gallery_id as $option): ?>
                <option value='<?php print $option['ID']; ?>'><?php print $option['Description']; ?></option>
            <?php endforeach; ?>
            </select></td></tr>
<tr><td class="meta">Hidden</td><td><input type='checkbox' name='s_Hidden' ></td></tr>
<tr><td class="meta">Comments</td><td><input type='checkbox' name='s_Comments' ></td></tr>
<tr><td class="meta">Tags</td><td><input type='checkbox' name='s_Tags' ></td></tr>

<tr><td></td><td><br/><input type="submit" name="f_insert_submit" value="Insert"/></td></tr>
</form>
</table>
<?php else: ?>
<?php print $this->error; ?>
<?php endif; ?>