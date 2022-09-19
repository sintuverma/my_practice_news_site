
<?php
if (isset($_POST['submit'])) {
  echo "hello vinod form submitted";
  $file_temp_name=$_FILES['imageUpload']['tmp_name'];
  $file_name=$_FILES['imageUpload']['name'];
  move_uploaded_file($file_temp_name, "images/".$file_name);
}
?>
<!DOCTYPE html>
<html>
<body>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="imageUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

