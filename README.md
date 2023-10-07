Sisger.org!!

Sistema de gerenciamento de equipes que visa auxiliar o administrador no melhor manejo de seu time


password_hash($senha, PASSWORD_DEFAULT);

password_verify($senha, $hash); -> TRUE/FALSE

function token($tamanho=10, $id="", $up=false) {
  $characters = $id.'abcdefghijklmnopqrstuvwxyz0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $tamanho; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
}