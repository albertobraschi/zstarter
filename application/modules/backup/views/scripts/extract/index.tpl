<div class="header"><h3>Backup</h3></div>
<?php if (isset($this->message)) { ?><div class="message"><?php print $this->message; ?></div><?php } ?>
<?php $files = $this->backups; ?>
Pleace, select a site archive to extract:<br/><br/>
<form action="<?php print $this->formaction; ?>" name="f_extract" method="post">
<?php foreach ($files as $file): ?>
<input type="radio" name="s_backups[<?php print $file['filename']; ?>]"/>&nbsp;<?php print $file['filename']; ?>&nbsp;&nbsp;(<?php print $file['filesize']; ?>&nbsp;Mb)<br/>
<?php endforeach; ?><br/>
<input type="submit" name="f_extract_submit" value="next">
</form>