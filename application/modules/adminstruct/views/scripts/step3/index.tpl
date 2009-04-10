<!--
<pre><?php
$types=$this->types;
var_dump($types);
?></pre>
<?php print $this->ajaxLink("Show me something",
        "/admin/adminstruct/step3/ajaxtest/",
        array('update' => '#dv', "method"=>"post"),
        array('notemplate' => 'yes')); ?>
<div id="dv"></div>
-->
<div class="header"><h3>Step #3: Scaffold</h3></div>

<form action="<?php print $this->fullurl; ?>adminstruct/step4/" name="f_step3" method="post">

<table border="0" cellspacing="0" cellspadding="10" class="s3table">
<thead>
<tr>
<th>View<br/>Page</th>
<th>Field Name</th>
<th>CSS</th>
<th>Initial</th>
<th>Search</th>
</tr>
</thead>
<tbody>
<?php
    for ($row=0; $row<count($this->columns); $row++):
         $columns=$this->columns[$row];
         $initial_val=$this->initial_val;
         $class_rules=$this->class_rules;
?>
<tr class="str">
<td>
<input type="hidden" name="row_type[]" value="<?php print $types[$row]; ?>" />
<input type="checkbox" name="cb_view[]" checked="true" /></td>
<td>
Field name: <b><?php print $columns['Field'] ?></b>&nbsp;&nbsp;(<span id="tmblr<?php print $row; ?>" class="link" onclick='showNewName(<?php print $row; ?>)'>↓</span>)<br/>
<div id='newname<?php print $row; ?>' style="display:none;">New name: <input type="text" name="fieldname[]" value="<?php print $columns['Field'] ?>" /></div>
</td>
<td>CSS Class <input type="text" name="cssclass[]" value="" /><br /><br />
<?php print !empty($class_rules[$row])?$class_rules[$row]:""; ?>
</td>
<td>
<!--Initial value <input type="text" name="initialvalue[]" value="" />-->
<?php print !empty($initial_val[$row])?$initial_val[$row]."<br /><br />":""; ?>
Validate: <select name="validate[]">
<option value="0">None</option>
<?php foreach ($this->adminvalidators as $validators): ?>
<option value="<?php print $validators['ID'] ?>"><?php print $validators['ValidatorName'] ?></option>
<?php endforeach; ?>
</select>

</td>
<td><input type="checkbox" name="search[]" checked="true" /></td>
</tr>
<?php endfor; ?>
</tbody>

</table>
<br /><br />
<input type="hidden" name="tablename" value="<?php print $this->tablename; ?>" />
<input type="submit" value=">> Step 4 >>" name="s_submit" />

</form>
