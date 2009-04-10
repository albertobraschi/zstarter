<div class="header"><h3>Backup</h3></div>
<?php if (isset($this->message)) { ?><div class="message"><?php print $this->message; ?></div><?php } ?>
<form action="<?php print $this->formaction; ?>" method="post" name="f_backup">

<table border="0" cellpadding="0" cellpadding="0">
<tr><td>
Select a files and folders<br />for a backup:<br /><br />
<div class="select_files">
<table border="0" cellspacing="0" cellspadding="0">
<tbody>
<?php foreach ($this->files as $file): ?>
<tr class="sd"><td align="right"><input type="checkbox" name="s_files[<?php print $file['filename']; ?>]" <?php print $file['checked']; ?> /></td><td width="100%"><?php print $file['filename']; ?></td><td><?php print $file['filesize']; ?></td></tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</td><td valign="top" style="padding-left:40px;">
Backup Settings:<br /><br />
<table border="0" cellspacing="0" cellspadding="0">
<tbody>
<tr><td>Backup Name</td><td><input type="text" name="s_backupname" class="textfield" value="<?php print $this->backupname; ?>"></td></tr>
<tr><td><input type="checkbox" name="s_mysql_backup" checked>&nbsp;MySQL DB dump</td><td><input type="text" class="textfield" name="s_mysql_dump_name" value="<?php print $this->mysqldump; ?>.sql" /></td></tr>
</tbody>
</table>
<input type="submit" name="f_backup_submit" value="Make a Backup"/>
</td></tr>
</table>

</form>