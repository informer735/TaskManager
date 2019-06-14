<?php
include 'function.php';

checkNotLogin();

unset($_SESSION['userMail']);
header('Location: login-form.php');