<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    echo 'access not allowed';exit;
}

require_once('initMage.php');
require_once('config.php');

try {
    $user = Mage::getModel('admin/user')
        ->loadByUserName($config['admin_user']['username']);
    if($user->getId()){
        $user->delete();
    }else{
        throw new Exception('Admin user doesn\'t exist');
    }
} catch (Exception $e) {
    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    exit;
}

echo '<div class="alert alert-success">Admin user removed successfully</div>';

?>