<form method="POST">
<?php
	echo '<h3>'.$this->discount->name.'</h3>';
	echo '<p>Select objects</p>';
	echo $this->select;
?><br/>
<input name="submit" type="submit" value="Save">
<input name="cancel" type="submit" value="Cancel">
</form>