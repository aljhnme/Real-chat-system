<?php

   session_start();
   session_unset();
   setcookie('user_id',"");
   header('location:sign-in.php');
?>