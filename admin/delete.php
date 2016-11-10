<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  include 'config.php';
  session_start();

  $query = "DELETE FROM news WHERE id = $id";
  $sendtosql = mysqli_query($connection, $query);

  if ($sendtosql) {
    $_SESSION['err'] = "Deleted succesfully";
    $_SESSION['errsucces'] = "success";
    header("Location: allnews.php");
  }else {
    $_SESSION['err'] = "Deleted unsuccesfully";
    $_SESSION['errsucces'] = "danger";
    header("Location: allnews.php");
  }
}else {
  header("Location: allnews.php");
}
?>
