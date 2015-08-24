<html>
<head>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.js" ></script>

<style>
/*
 * Zebra rows: When CSS3 is done we could simply use:
 *   tr :nth-child(odd) { background-color: #D0D0D0; }
 * but for now we use PHP and CSS
 */
 
table.db tr { background-color: #F0F0F0; }
table.db tr.odd { background-color: #D0D0D0; }
table.db th { color: #f0f0f0; background-color: #CCC; }

table.db tr:hover, table.db tr.odd:hover { background-color: #EBFFFF; }
 
</style>

<title></title>
<?php echo html::stylesheet(
    array
    (
        'media/css/table',
    ),
    array
    (
        'screen',
    )
);
?>

</head>
<body>

<form method="POST" action="<?php echo url::base() . url::current(); ?>">
	<table class="db" id="list" >
		<thead>
			<tr><th></th>
			<?php foreach ($fields as $index => $column):  ?>
				<th><a href="<?php echo url::base() . url::current(); ?>/?&order=<?php echo $column; ?>:<?php echo $this->order ?>" class="" ><?php  echo $column; ?></a></th>
			<?php endforeach ?>
			<th><input type="button" value="+" onclick="addRow()" id="add" /></th></tr>
			
			<tr><th></th>
			<?php foreach($fields as $column) :  //print_r($value?>
				<th><input type="text" name="filter[<?php echo $column; ?>]" /></th>
			<?php endforeach ?>
		<th><input type="submit" value="Filter" name="btnFilter" />
			<br/>
			<input type="button" value="Clear Filter" name="btnClearFilter" onclick="location.href='<?php echo url::site(url::current()); ?>'" /></th>

			</tr>
		</thead>	
		
		<tbody id="first">	
			<?php
				foreach ($result as $cell){
					echo "<tr". text::alternate( '', ' class="odd"' ). "><td><input type='checkbox' value={$cell->id} name='chk[{$cell->id}]' /></td>";
					for( $i = 0 ; $i< count($fields); $i++){
						$value = $fields[$i];
						echo "<td>{$cell->$value}</td>";
					}
					
					echo "<td><a href=". url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) ."/edit/".$cell->id.">Edit</a></td></tr>";
				}			
			?>
		</tbody>				
	</table>
	<?php echo( $pagination )?>
</form>

<!--
<script type="text/javascript">
function addRow(){
	html  = '<tbody id="add_row">';
	html += '<tr>'; 
	html += '<td></td>';
	<?php for ($i=0; $i<4; $i++){ ?>
	html += '<td><?php echo $i;?></td>';
	<?php } ?>
	html += '</tr>';	
    html += '</tbody>';			
	$('#list tbody#first').before(html);
	
	$('#add').hide();
	}
</script>
-->

</body>
</html>