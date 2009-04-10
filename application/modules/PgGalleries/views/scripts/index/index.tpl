<div class="header"><h3>PgGalleries</h3></div>
<?php if (isset($this->message)) { ?><div class="message"><?php print $this->message; ?></div><?php } ?>
<?php $table_view=$this->table_view; ?>
<form action="<?php print $this->form_action; ?>" name="frm_adminstruct_view" method="post">
<table border="0" cellspacing="0" cellspadding="0" class="t_view">
<thead>
<tr>
<th>&nbsp;</th>
<?php foreach ($table_view[0] as $key => $value): ?>
<th><?php print $key; ?></th>
<?php endforeach; ?>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach ($table_view as $item): ?>
<tr class="str">
<td><input type="checkbox" name="cks[<?php print $item['ID']; ?>]" /></td>
<?php foreach ($item as $col => $row): ?>
<td><?php print $row; ?></td>
<?php endforeach; ?>
<td><a href="edit/<?php print $item["ID"]; ?>"/><img border="0" src="http://taryk/admin/public/design/img/b_edit.png" alt="DELETE"/></a></td>
<td><a href="delete/<?php print $item["ID"]; ?>"/><img border="0" src="http://taryk/admin/public/design/img/b_drop.png" alt="DELETE"/></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table><br/><br/>

With a checked <input type="submit" name="submit_form_delete" value="Delete">
</form>

<a href="add/">Add new</a><br/>