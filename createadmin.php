<?php
$roleId = intval($_POST['role_id']);
session_start();
if(!isset($_SESSION['logged_in'])){
    echo 'access not allowed';exit;
}

if(!$roleId){
    echo 'no role ID specified';exit;
}

require_once('initMage.php');
require_once('config.php');

try {
$user = Mage::getModel('admin/user')
->setData(
    $config['admin_user']
)->save();

} catch (Exception $e) {
echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
exit;
}

//Assign Role Id
try {
$user->setRoleIds(array(1))  //Administrator role id is 1 ,Here you can assign other roles ids
->setRoleUserId($user->getUserId())
->saveRelations();

} catch (Exception $e) {
echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
exit;
}

echo "<div class='alert alert-success'>User Created Successfully<br><br>
    Username:<br>
    {$config['admin_user']['username']}
    <br><br>Password:<br>
    {$config['admin_user']['password']}
    </div>";

?>