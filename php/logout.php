<?php
    session_start();
    unset($_SESSION['loggedin']['duration']);
    unset($_SESSION['loggedin']['start']);
    unset($_SESSION['loggedin']);
    unset($_SESSION['name']);
    echo "<script>alert ('You have successfully logged out'); window.location='../index.html'</script>";
    exit();
?>