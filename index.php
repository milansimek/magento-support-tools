<?php
require_once('initMage.php');
require_once('config.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Support Tools</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.com/jquery.form.js"></script>
</head>
<body>
<?php
$pass = isset($_POST['passwd']) ? $_POST['passwd'] : '';
if ($pass != $config['password']) { ?>
<div class="container">
    <form class="form-horizontal well col-sm-3 col-sm-offset-4" method="post" name="pwd">
        <label>Log in</label>
        <input class="form-control" name="passwd" type="password">
        <button style="margin-top:10px" class="form-control btn btn-primary" type="submit" name="submit_pwd">Login</button>
    </form>
    <?php if ($pass){ ?>
        <div class="col-sm-offset-4 col-sm-3 alert alert-danger">Password incorrect</div>
    <?php } ?>
</div>
</body>
</html>
<?php exit;} ?>
<?php
session_start();
$_SESSION['logged_in'] = true;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Support panel <?php echo $config['company']; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h4>Create Admin User</h4>
            <div class="well">
                <form id="createAdmin" class="form-horizontal" action="createadmin.php" method="post">
                    <h5>Admin Role</h5>
                    <select name="role_id" class="form-control">
                        <?php
                            $roles = Mage::getModel('admin/roles')->getCollection();
                            foreach($roles as $role){ ?>
                                <option value="<?php echo $role->getId(); ?>">
                                    <?php echo $role->getRoleName();?>
                                </option>
                        <?php } ?>
                    </select>
                    <button type="submit" style="margin-top:10px;" class="btn btn-primary form-control">Create</button>
                </form>
                <form id="removeAdmin" class="form-horizontal" action="removeadmin.php" method="post">
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger form-control">Remove</button>
                </form>
            </div>
            <div id="createAdminResult"></div>
        </div>
        <div class="col-sm-6">
            <h4>Tools</h4>
            <ul class="list-group">
                <a target="_blank" href="adminer.php"
                    <li class="list-group-item">Adminer</li>
                </a>
                <a target="_blank" href="phpterm/index.php">
                    <li class="list-group-item">Terminal</li>
                </a>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h4>DB information</h4>
            <?php
            $config  = Mage::getConfig()->getResourceConnectionConfig('default_setup');
            $dbinfo = array('host' => $config->host,
                'user' => $config->username,
                'pass' => $config->password,
                'dbname' => $config->dbname
            );
            $hostname = $dbinfo['host'];
            $user = $dbinfo['user'];
            $password = $dbinfo['pass'];
            $dbname = $dbinfo['dbname'];
            ?>
            <ul class="list-group">
                <li class="list-group-item"><?php echo $hostname; ?></li>
                <li class="list-group-item"><?php echo $user; ?></li>
                <li class="list-group-item"><?php echo $password; ?></li>
                <li class="list-group-item"><?php echo $dbname; ?></li>
            </ul>
        </div>
        <div class="col-sm-6">
            <h4>Store Links</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a target="_blank" href="<?php echo Mage::getBaseUrl() . Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName'); ?>">
                        Admin
                    </a>
                </li>
                <?php foreach(Mage::app()->getStores() as $store){ ?>

                    <li class="list-group-item">
                        <a target="_blank" href="<?php echo $store->getBaseUrl(); ?>">
                            <?php echo $store->getName(); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script>
    // wait for the DOM to be loaded
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('#createAdmin').ajaxForm({
            target: '#createAdminResult'
        });
        $('#removeAdmin').ajaxForm({
            target: '#createAdminResult'
        });
    });
</script>

<?php phpinfo(); ?>
</body>
</html>
