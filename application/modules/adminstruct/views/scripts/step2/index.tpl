<!--<pre><?php
var_dump($this->columns);
?></pre>-->

<div class="header">
<?php if (isset($this->error)): ?>
<h3>Step 2.</h3>
<h3><?php print $this->error; ?></h3>
<?php else: ?>
<h3>Step 2. Processed table '<?php print $this->tablename; ?>'</h3></div>

<form action="<?php print $this->fullurl; ?>adminstruct/step3/" name="f_step2" method="post">
<input type="hidden" name="tablename" value="<?php print $this->tablename; ?>"/>
<table border="0" cellpadding="5" cellspacing="0">
<thead>
<tr>
<th>Field</th>
<th>Admin Type</th>
<th>Field Type</th>
<th>Length</th>
<th>Signed</th>
<th>Null</th>
<th>Key</th>
<th>Default</th>
</tr>
</thead>
<tbody>
<?php foreach($this->columns as $column): ?>
<tr>
<td><h3><?php print $column['Field'] ?></h3></td>
<td>
<select name="type[]">
<?php foreach($column['Types'] as $types): ?>
<option value="<?php print $types['ID']; ?>" <?php print eregi($types['RegExp'],$column['Field'])?"selected":""; ?>><?php print $types['TypeName']; ?></option>
<?php endforeach; ?>
</select>
</td>
<td align="right"><?php print $column['Type'] ?></td>
<td>(<?php print $column['Length'] ?>)</td>

<td><?php print $column['Signed'] ?></td>
<td><?php print $column['Null'] ?></td>
<td><?php print $column['Key'] ?></td>
<td><?php print $column['Default'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<br/>

<input type="submit" name="step2_send" value=">> Step3 >>"/>
</form>
<?php endif; ?>