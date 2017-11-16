<?php
/**
 * Created by:  Milan Simek
 * Company:     Plugin Company
 *
 * LICENSE: http://plugin.company/docs/magento-extensions/magento-extension-license-agreement
 *
 * YOU WILL ALSO FIND A PDF COPY OF THE LICENSE IN THE DOWNLOADED ZIP FILE
 *
 * FOR QUESTIONS AND SUPPORT
 * PLEASE DON'T HESITATE TO CONTACT US AT:
 *
 * SUPPORT@PLUGIN.COMPANY
 */

$config = array();

//password for panel and terminal
$config['password'] = "SECRET_PASSWORD";

//company name shown in panel
$config['company'] = "";

//admin user details used when creating admin account
$config['admin_user'] = array(
    'username'  => 'YOUR_USERNAME',
    'firstname' => 'YOUR_FIRSTNAME',
    'lastname'  => 'YOUR_LASTNAME',
    'email'     => 'YOUR_EMAIL',
    'password'  => 'YOUR_PASSWORD',
    'is_active' => 1
);
