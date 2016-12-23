# Simple Cloudstack Client PHP

PHP client library for the CloudStack User API v4.5 (Reference : http://cloudstack.apache.org/api/apidocs-4.5/TOC_User.html)

### Installing

Just copy the project on your local machine and run it.

Change Cloudstack API Credentials

Change file cloudstack.php on __construct with the real value
```
$this->end_point = 'https://xxxxxxxxxxxxxx';
$this->api_key = 'xxxxxxxxxxxxxxxxxxxxxxxx';
$this->secret_key = 'xxxxxxxxxxxxxxxxxxxxx';
```

Sample List Virtual Machines

```
require "cloudstack.php";
$cloudstack = new CloudstackApi();
$listVms = $cloudstack->_getRest('listVirtualMachines');
```

Sample Deploy Virtual Machines

```
require "cloudstack.php";
$cloudstack = new CloudstackApi();
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
```
*Change the params value with the real value

## Versioning

1.0

## Authors

* **Siswanto** - [sysastro](http://sysastro.com)


## License

This project is licensed under the MIT License