<html>
<head>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.js" ></script> -->

<title></title>
<?php echo html::stylesheet(
    array
    (
        'media/css/table',
		'media/css/site',
		'media/css/ui-lightness/jquery.ui.all'
	  ),
    array
    (
        'screen',
		'screen',
		'screen'
    )
);
?>
</head>
<body>

<form method="POST" action="">
	<table class="db" id="list" >
		<thead>
			<tr>
				<th> </th>
				<?php echo $table_headings ?>
				<th>
					<input type="button" value="+" onclick="window.location='<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) ?>add/new'" id="add" />
					<a href="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) ?>add/new">Add</a>			
				</th>
				
			</tr>
			
			<tr class="filter">
				<th></th>	
				<?php echo $table_filter;?>
				<th><input type="submit" value="Filter" name="btnFilter" />
					<br/>
					<input type="submit" value="Clear Filter" name="btnClearFilter" />
				</th>
			</tr>
		</thead>	
		
		<tbody id="first">	
			<?php	

				foreach ($result as $cell) {
					$id = $cell[ $fields['0'] ];
					echo "<tr". text::alternate( '', ' class="odd"' ) .">";

					echo "<td><input type='checkbox' value={$id} name='chk[{$id}]' /></td>";
					
					for ($i = 0 ; $i< count($fields); $i++){
						$value = $fields[$i];

						
						//if no alignment is specified, align the contents of the <td> in the center
						$alignment = (array_key_exists($value, $align))? $align[$value] : 'center';						
						echo "<td align='". $alignment ."'>{$cell[ $value ]}</td>";
					}	
					/*
					if($category){			 
						echo '<td>';
							$cat =  getProductCategories($cell->$fields['0']);
							echo $cat;
						echo  '</td>';
					}
					*/
													
					echo "<td align='center'><a href=". url::base() .$this->uri->segment(1). '/' . $this->uri->segment(2)."/edit/".$id.">Edit</a></td>";
					echo "</tr>";
				}			
			?>
		</tbody>				
	</table>
	
	
	
	
	<?php 	
		foreach ($actions as $action => $call_back){
			echo '<input type="submit" name="action['.$action.']" value="'.$action.'" />';
		}
			
			
			
		//echo $pagination; 
	?>
</form>



<?php
echo html::script(array('media/js/ui.datepicker'),FALSE);
?>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>

</body>
</html>