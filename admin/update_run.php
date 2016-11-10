<?php
if (isset($_POST['submit'])) {


  if ($_GET['id']) {
    $id= $_GET['id'];
    $createnewstitle = $_POST['createnewstitle'];
    $createnewstext = $_POST['createnewstext'];
    $createnewstype = $_POST['createnewstype'];
    $photo = $_FILES['createnewsphoto']['name'];

    switch ($_FILES['createnewsphoto']['error']) {
      case 1:
        $_SESSION['err'] = 'File is large';
        header('Location: update.php');
        break;

      case 4:
        $_SESSION['err'] = 'File not choosen';
        header('Location: update.php');
        break;
    }


    include 'config.php';
    session_start();


      $target_dir = '../uploads/';
      $target_file = $target_dir.basename($_FILES['createnewsphoto']['name']);
      $imgType = pathinfo($target_file, PATHINFO_EXTENSION);

    if (!empty($createnewstitle) && !empty($createnewstext)) {
      if ($imgType == 'jpg' || $imgType == 'png' || $imgType == 'gif') {
        if ($_FILES['createnewsphoto']['size'] >= 700) {
          $img_upload = move_uploaded_file($_FILES['createnewsphoto']['tmp_name'], $target_file);
          // var_dump($img_upload);
          if ($img_upload) {
            $query = "UPDATE news INNER JOIN category ON news.category_id = category.id SET  news.newstitle = '$createnewstitle', news.newstext = '$createnewstext', news.newsphoto = '$photo', news.category_id = '$createnewstype' WHERE news.id = '$id' ";
            // $query = "UPDATE `news` SET `newstitle`='$createnewstitle',`newstext`='$createnewstext',`newsphoto`='$photo' `category_id` = 'createnewstype' WHERE id = '$id'";
            $sendtosql = mysqli_query($connection, $query);
            $_SESSION['err'] = 'File updated';
            $_SESSION['errsucces'] = "success";
            header('Location: allnews.php');
          }else {
            $_SESSION['err'] = 'Occured some problems';
            header('Location: update.php');
          }
        }else {
          $_SESSION['err'] = 'Photo must be max 700kib';
          header('Location: update.php');
        }
      }else {
        $_SESSION['err'] = 'Photo extension must be JPG, PNG or GIF';
        header('Location: update.php');
      }
    }else {
      $_SESSION['err'] = 'Fill all boxes';
      header('Location: update.php');
    }

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

  }else {
    header("Location: update.php");
  }

  }else {
    header("Location: login.php");
  }

?>
