<?php 
    session_start();
    unset($_SESSION['status']);
    unset($_SESSION['login_id']);
    unset($_SESSION['message']);
    unset($_SESSION['time']);
    unset($_SESSION['service']);
    unset($_SESSION['date']);
    unset($_SESSION['uc_id']);
    unset($_SESSION['price']);
    unset($_SESSION['staff']);

    header("Location: login.php");
; ?>