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
$listVms = $cloudstack->_getRest('listVirtualMachines');

/* loop data list virtual machine response if exist */
if(isset($listVms['listvirtualmachinesresponse']['virtualmachine']))
{
    foreach($listVms['listvirtualmachinesresponse']['virtualmachine'] as $listVm)
    {
        echo $listVm['name'].'<br>';
        echo $listVm['displayname'].'<br>';
        echo $listVm['templatename'].'<br>';
        echo $listVm['serviceofferingname'].'<br>';
        echo '============================================ <br>';
    }
}
?>