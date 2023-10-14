<?php
require_once '../../config/config.php';

unset($_SESSION['token']);
header('Location: ../views/adm/login.php');
exit;