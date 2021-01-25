<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatibe" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Upload File</title>
</head>

<body>
  <div class="input_container">
    <ul>
      <!--input feilds-->
      <li><input class="input_feild" type="text" placeholder="First name"></li>
      <li><input class="input_feild" type="text" placeholder="Last name"></li>
      <li><input class="input_feild" type="date"></li>

      <form action="index.php" method="POST" enctype="multipart/form-data">
        <li><input class="input_feild" type="file" name="file"></li>
        <!--submit button-->
        <li><button class="input_feild" type="submit" name="submit">Submit</button>
      </form>

    </ul>
  </div>


  <?php
  //When user clickes on the submit button php will start running this code
  if (isset($_POST['submit'])) {
    //get file information
    $file = $_FILES['file'];


    //extract file information
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['Size'];
    $fileError = $_FILES['file']['error'];


    //split file name
    $fileExt = explode('.', $fileName);
    //convert file name to lowercase letters
    $fileActualExt = strtolower(end($fileExt));
    //these are the only type of files allowed to be uplaoded
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    //check if this file type is allowed
    if (in_array($fileActualExt, $allowed)) {
      //check if there is an error
     if($fileError === 0){
       //make sure file is not too big
       if ($fileSize < 100000000) {
         //give file name an unique id with time_date
         $fileNameNew = date('hms_mdY').".".$fileActualExt;
         //upload file to uploads folder
         $fileDestination = 'uploads/'.$fileNameNew;
         move_uploaded_file($fileTmpName, $fileDestination);
         header("location: index.php?uploadsuccess");
       }else{
         echo "Your file is too big!";
       }
     }else {
       echo "There was an error uploading your file";
     }
    }else {
      echo "You can not upload this type of file!";
    }
  }
  ?>
</body>

</html>
