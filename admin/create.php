<?php
include 'config.php';

if (isset($_POST['submit'])) {

$createnewstitle = $_POST['createnewstitle'];
$createnewstext = $_POST['createnewstext'];
$photo = $_FILES['createnewsphoto']['name'];
$createnewsselect = $_POST['createnewstype'];
session_start();


  switch ($_FILES['createnewsphoto']['error']) {
    case 1:
      $_SESSION['err'] = 'File is large';
      header('Location: add.php');
      break;

    case 4:
      $_SESSION['err'] = 'File not choosen';
      header('Location: add.php');
      break;
  }

  $target_dir = '../uploads/';
  $target_file = $target_dir.basename($_FILES['createnewsphoto']['name']);
  $imgType = pathinfo($target_file, PATHINFO_EXTENSION);

if (!empty($createnewstitle) && !empty($createnewstext)) {
  if ($imgType == 'jpg' || $imgType == 'png' || $imgType == 'gif') {
    if ($_FILES['createnewsphoto']['size'] >= 700) {
      $img_upload = move_uploaded_file($_FILES['createnewsphoto']['tmp_name'], $target_file);
      // var_dump($img_upload);
      if ($img_upload) {
        $query = "INSERT INTO news(newstitle, newstext, newsphoto, category_id) VALUES ('$createnewstitle', '$createnewstext', '$photo', '$createnewsselect')";
        $sendtosql = mysqli_query($connection, $query);
        $_SESSION['err'] = 'File uploaded';
        $_SESSION['errsucces'] = "success";
        header('Location: allnews.php');
      }else {
        $_SESSION['err'] = 'Occured some problems';
        header('Location: add.php');
      }
    }else {
      $_SESSION['err'] = 'Photo must be max 700kib';
      header('Location: add.php');
    }
  }else {
    $_SESSION['err'] = 'Photo extension must be JPG, PNG or GIF';
    header('Location: add.php');
  }
}else {
  $_SESSION['err'] = 'Fill all boxes';
  header('Location: add.php');
}

}else {
  header('Location:add.php');
}
//
// }else {
//   header('Location: add.php');
// }
?>
