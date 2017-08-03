<?php
require_once('include/Session.class.php');
global $session;
if(!$session = new Session(true, 'index.php')) {
    die('Hay problemas con la sesion');
}