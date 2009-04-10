<div class="header"><h3>AdminStrunct</h3></div>

<?php if (isset($this->message)) { ?><div class="message"><?php print $this->message; ?></div><?php } ?>

<form action="<?php print $this->form_action; ?>" name="frm_adminstruct_view" method="post">
<table border="0" cellspacing="0" cellspadding="0" class="t_view">
<thead>
<tr>
<th></th>
<?php foreach ($this->site_structure[0] as $key => $value): ?>
<th><?php echo $key; ?></th>
<?php endforeach; ?>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach ($this->site_structure as $item): ?>
<tr class="str">
<td><input type="checkbox" name="cks[<?php echo $item['ID']; ?>]" /></td>
<td><input type="hidden" name="ids[]" value="<?php echo $item['ID']; ?>" /><?php echo $item['ID']; ?></td>
<td><?php echo $item['Path']; ?></td>
<td><?php echo $item['Name']; ?></td>
<td><?php echo $item['Description']; ?></td>
<td><?php echo $item['Alias']; ?></td>
<td><?php echo $item['Date_c']; ?>&nbsp;</td>
<td><?php echo $item['Date_m']; ?>&nbsp;</td>
<td><?php echo $item['Content']; ?></td>
<td><?php echo $item['Template']; ?></td>
<td><?php echo $item['Controller']; ?></td>
<td><?php echo $item['Hidden']; ?></td>
<td><?php if ($item['Regen']==1) { ?><a href="<?php echo $this->regenurl.$item['ID']; ?>/">RE</a><?php } else { ?>no<?php } ?></td>
<td><a href="edit/<?php echo $item['ID']; ?>/"><img border="0" src="http://taryk/admin/public/design/img/b_edit.png" alt="DELETE"/></a></td>
<td><a href="delete/<?php echo $item['ID']; ?>/"><img border="0" src="http://taryk/admin/public/design/img/b_drop.png" alt="DELETE"/></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table><br/><br/>

With a checked <input type="submit" name="submit_form_delete" value="Delete">
</form>
<a href="step1/">Add new</a><br/>
