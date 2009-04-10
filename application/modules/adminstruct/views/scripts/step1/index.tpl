<div class="header"><h3>Step #1: Select a table</h3></div>
<?php if (isset($this->message)) { ?><div class="message"><?php print $this->message; ?></div><?php } ?>
<b>tables:</b><br/><br/>
<?php foreach ($this->tables as $key => $table): ?>
<a href="../step2/<?php print $table['Tables_in_taryk']; ?>/"><?php print $table['Tables_in_taryk']; ?></a><br />
<?php endforeach; ?>