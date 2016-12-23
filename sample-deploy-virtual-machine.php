<?php
/*
 * This file is a part of the Simple CloudStack Client PHP.
 * (c) sysastro <sysastro@gmail.com>
 * Fill free for this code to copyright, license and modification.
 * Created base on ApacheCloudstack API Document : http://cloudstack.apache.org/api/apidocs-4.5/TOC_User.html
 * Version : 1.0
 */

/* require cloudstack class file */
require "cloudstack.php";

/* call CloudstackApi class */
$cloudstack = new CloudstackApi();

/* define params for deploy virtual machine */
$deployVMArgs = array(
    'serviceofferingid' => '123456789', // Required
    'templateid' => '123456789', // Required
    'zoneid' => '123456789', // Required
    'name' => 'abcdefghijk', // Optional
    'displayname' => 'abcdefghijk', // Optional
    'group' => 'abcdefghijk', // Optional
    'diskofferingid' => '123456789', // Optional
    'size' => '20' // Optional
);

$deploy = $cloudstack->_getRest('deployVirtualMachine', $deployVMArgs);
print_r($deploy);
?>