<?php 
	echo html::script(array (url::base().'media/js/ui.datepicker.js'), FALSE);
	$statuses = $this->db->select('id, status_name')->from('order_statuses')->orderby('id')->get();
	$sites = ORM::factory('site')->find_all();
?>
<form method="POST">
<table>
<tr><td>Start date</td><td>End date</td><td>Group by</td><td>Status</td><td>Sites</td><td></td></tr>
<tr>
	<td><input type="text" name="date_from" id="date_from" value="<? echo $this->values['date_from'];?>"></td>
	<td><input type="text" name="date_till" id="date_till" value="<? echo $this->values['date_till'];?>"></td>
	<td>
		<select name="group">
<?php
	foreach ($this->groups as $index=>$group){
		$selected = ($this->values['group']==$index) ? ' SELECTED' : '';
		echo "<option value=\"$index\"$selected>$group</option>";
	}
?>	
		</select>
	</td>
	<td>
		<select name="status">
		<option value="0">All</option>
		
<?php
	$s = array();
	foreach ($statuses as $status){
		$selected = ($this->values['status']==$status->id) ? ' SELECTED' : '';
		echo "<option value=\"$status->id\"$selected>$status->status_name</option>";
		$s[$status->id] = $status->status_name;
	}
?>	
		</select>
	</td>
	<td>
		<select name="site">
		<option value="0">All</option>
		
<?php
	$s = array();
	foreach ($sites as $site){
		$selected = ($this->values['site']==$site->id) ? ' SELECTED' : '';
		echo "<option value=\"$site->id\"$selected>$site->name</option>";
		$s[$site->id] = $site->name;
	}
?>	
		</select>
	</td>
	<td><input type="submit" value="Filter" name="filter"></td>
</tr>
</table><br/><br/>
<?php
	if (isset($this->rows)){
		if (count($this->rows) > 0){
?>
<style>
	table#main td { border:1px solid black; padding:2px;}
	table#main { border-collapse:collapse;}
</style>
	<table border="0" width="100%" id="main">
<?php
	echo '<tr>';
	foreach ($this->header as $field){
		echo '<td>'.$field.'</td>';
	}
	echo '</tr>';
	foreach ($this->rows as $row){
		echo '<tr>';
		foreach ($this->header as $key=>$value){
			echo '<td>'.$row[$key].'</td>';
		}
		echo '</tr>';
	}
?>		
	</table><br/>
<div style="float:right;">
	<select name="export" onChange="submit();">
		<option value="">Export to</option>
		<option value="xml">Excel</option>
		<option value="csv">CSV</option>
	</select>
</div>
<?php		
		}
	}
?>	

</form>
<script>
$( 
function(){
	$('#date_from').datepicker({dateFormat: 'yy-mm-dd'});
	$('#date_till').datepicker({dateFormat: 'yy-mm-dd'});	
}
);
</script>