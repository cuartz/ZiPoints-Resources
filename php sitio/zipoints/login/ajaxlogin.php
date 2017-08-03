<?php
require_once('include/Config.inc.php');
require_once('include/Session.class.php');
require_once('include/Database.class.php');
if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $usuario = $db->getEscaped($_POST['usuario']);
    $password_hashed = sha1($_POST['pass']);
    $db->setQuery("SET NAMES utf8");
    $db->query();
    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password_hashed' AND estatus=1";
    $db->setQuery($query);
    $db->query();
    $usr = $db->loadObject();
    if(!$usr) {
        $data['message'] = 'Usuario/Contraseña incorrectos';
        usleep(1500000);
    }
    else {
        if (!$session = new Session()) { $data['message'] = 'Error interno iniciando sesión'; }
        else {
            $session->data['usuario'] = $usr;
            $session->data['logged_in'] = true;
            if (!$session->save()) {
                $data['success'] = false;
                $data['message'] = "Error interno iniciando sesión";
            } else {
                usleep(1500000);
                $data['success'] = true;
            }
        }
    }
}
else {
    $data['success'] = false;
    $data['message'] = "Error interno iniciando sesión";
}
$data['redirect'] = 'panel_principal.php';
echo json_encode($data);