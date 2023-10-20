<?php
require_once '../../config/config.php';
// FUNÇÃO PARA LIMPAR A SESSÃO TOKEN E REDIRECIONAR PARA TELA DE LOGIN
unset($_SESSION['token']);
header('Location: ../views/adm/login.php');
exit;