<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    session_start();

    include 'config.php';

    if (!empty($email) && !empty($password)) {
      $query = "SELECT `username`, `password` FROM userdb WHERE `username` = '$email' AND `password` = '$password'";
      $sendtodb = mysqli_query($connection, $query);

      if ($sendtodb -> num_rows==1) {
        $_SESSION['loginned'] = true;
        header("Location: allnews.php");
      }else {
        $_SESSION['err'] = "Invalid e-mail or password";
        header("Location: login.php");
      }

    }else {
      $_SESSION['err'] = "Have empty fields";
      header("Location: login.php");
    }

}else {
  header("Location: login.php");
}
?>
