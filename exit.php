<?php
session_start();

unset($_SESSION['userMail']);
header('Location: login-form.php');