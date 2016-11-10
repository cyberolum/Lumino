<?php
session_start();
if (isset($_SESSION['loginned'])) {
  unset($_SESSION['loginned']);
  header("Location: login.php");
}
?>
