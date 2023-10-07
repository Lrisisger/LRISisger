<?php
require_once '../../private/config.php';

unset($_SESSION['token']);
header('Location: ../views/adm/pages/login.php');
exit;