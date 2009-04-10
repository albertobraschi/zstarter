<?php if (!isset($this->error)): ?>
<?php $item=$this->item[0]; ?>
<h3>Edit item "<?php print $item['Name'] ?>"</h3>
<form action="<?php print $this->form_action; ?>" name="f_update" method="post">
<table border="0" cellspacing="0" cellspading="0">
<tr><td class="meta">ID</td><td><input type="hidden" name="s_ID" value="<?php print $item['ID']; ?>"/><?php print $item['ID']; ?></td></tr>
<!--<tr><td class="meta">Path</td><td><input name="s_Path" value="<?php print $item['Path'] ?>"/></td></tr>-->
<tr><td class="meta">Name</td><td><input name="s_Name" value="<?php print $item['Name'] ?>"/></td></tr>
<tr><td class="meta">Description</td><td><input name="s_Description" value="<?php print $item['Description'] ?>"/></td></tr>
<tr><td class="meta">Alias</td><td><input name="s_Alias" value="<?php print $item['Alias'] ?>"/></td></tr>
<tr><td class="meta">Date creation</td><td><input name="s_Date_creation" value="<?php print $item['Date_c'] ?>"/></td></tr>
<tr><td class="meta">Date modification</td><td><input name="s_Date_modification" value="<?php print $item['Date_m'] ?>"/></td></tr>
<tr><td class="meta">Content</td><td><input name="s_Content" value="<?php print $item['Content'] ?>"/></td></tr>
<tr><td class="meta">Template</td><td><input name="s_Template" value="<?php print $item['Template'] ?>"/></td></tr>
<tr><td class="meta">Controller</td><td><input name="s_Controller" value="<?php print $item['Controller'] ?>"/></td></tr>
<tr><td class="meta">Hidden</td><td><input name="s_Hidden" value="<?php print $item['Hidden'] ?>"/></td></tr>
<tr><td></td><td><br/><input type="submit" name="f_update_submit" value="Save"/><input type="button" name="f_delete" value="Delete"/></td></tr>
</form>
</table>
<?php else: ?>
<?php print $this->error; ?>
<?php endif; ?>