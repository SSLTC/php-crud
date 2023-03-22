<?php
$target_dir = "uploads/";
$imageFileType = substr($_FILES["fileToUpload"]["type"], 6);
$target_file = $target_dir . "collectionsCardID" . $_GET['id'] . "." . $imageFileType;
$uploadOk = 1;

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
  $uploadOk = 1;
} else {
  $errors[] = "File is not an image.";
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  //$errors[] = "File already exists.";
  //$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $errors[] = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
$imageFileTypes = array("jpg", "jpeg", "png", "gif");
if(!in_array($imageFileType, $imageFileTypes)) {
  $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $errors[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $errors[] = "Sorry, there was an error uploading your file.";
  }
}