<?php
//create the directory if doesn't exists (should have write permissons)
if(!is_dir("./files")) mkdir("./files", 0755); 
//move the uploaded file

if(strpos($_FILES['Filedata']['tmp_name'], '.jpg') > 0)
	$image = imagecreatefromjpeg($_FILES['Filedata']['tmp_name']);
elseif(strpos($_FILES['Filedata']['tmp_name'], '.gif') > 0)
	$image = imagecreatefromgif($_FILES['Filedata']['tmp_name']);
elseif(strpos($_FILES['Filedata']['tmp_name'], '.png') > 0)
	$image = imagecreatefrompng($_FILES['Filedata']['tmp_name']);

if($image){

	if(strrpos($_FILES['Filedata']['name'], ".jpeg"))
		$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -5).".png";
	else 
		$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -4).".png";

	imagepng($image, "./files/".$_FILES['Filedata']['name'], 1);

} else {
	$_FILES['Filedata']['name'] = substr($_FILES['Filedata']['name'], 0, -4).".png";

	




	move_uploaded_file($_FILES['Filedata']['tmp_name'], "./files/".$_FILES['Filedata']['name']);
}


chmod("./files/".$_FILES['Filedata']['name'], 0777);
?>