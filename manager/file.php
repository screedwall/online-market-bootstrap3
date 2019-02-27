<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 5000000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "$root/img/upload/".$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
$response["status"]="success";
$response["filename"]=$_FILES["file"]["name"];
echo json_encode($response);
}
}
}
else
{
$response["status"]="error";
echo json_encode($response);
}
}
?>