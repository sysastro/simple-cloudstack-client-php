<?php
/*
 * This file is main class of the Simple CloudStack Client PHP.
 * (c) sysastro <sysastro@gmail.com>
 * Fill free for this code to copyright, license and modification.
 * Created base on ApacheCloudstack API Document : http://cloudstack.apache.org/api/apidocs-4.5/TOC_User.html
 * Version : 1.0
 */

class CloudstackApi
{
    /*
     * In this function we set the credentials for access cloudstack api
     * We need main information cloudstack api like END POINT URL, API KEY and SECRET KEY
     * END POINT = The URL for curl url param
     * API KEY = Required param for post field
     * SECRET KEY = Key for create signature value as required params for post field
     */
    public function __construct()
    {
        $this->end_point = 'https://xxxxxxxxxxxxxx';
        $this->api_key = 'xxxxxxxxxxxxxxxxxxxxxxxx';
        $this->secret_key = 'xxxxxxxxxxxxxxxxxxxxx';
    }

    /*
     * Main function for send and request data to cloudstack api
     * @param string $command = required param post field for create many function cloudstack api like deployVirtualMachine, listTemplates, etc
     * @param array $dataParams = all data params that need to send as post fields
     */
    public function _getRest($command, $dataParams = array())
    {
        /* create empty array for store the data params */
        $params = array();

        /* build paramaters from passed arguments */
        foreach ($dataParams as $key => $value) {
            $pvalue = strval($value);
            if (strlen($pvalue)) {
                $params[strtolower($key)] = $pvalue;
            }
        }

        /* merge sanitized paramaters */
        $params = array_merge($params, array(
            'apikey' => $this->api_key,
            'command' => $command,
            'response' => 'json'
        ));

        /* sort the params for create signature */
        ksort($params);

        /* create signature for required param post field */
        $signature = $this->__generateSignature($params);

        /* add signature required param post field */
        $params['signature'] = $signature;

        /* initialization curl */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->end_point);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        /* add headers for http header curl */
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        /* run exec curl and decode the result into json */
        $result = curl_exec($ch);
        $result = json_decode($result, true);

        /* check the result for add error information */
        if (empty($result)) {
            $allInfo = curl_getinfo($ch);
            $code = $allInfo['http_code'];
            $message = curl_error($ch);
            $result[0]['code'] = $code;
            $result[0]['message'] = 'Error : ' . $message;
        }
        curl_close($ch);
        return $result;
    }

    /*
     * Generate signature for required param
     * @param array $queryString = all data params that need to send as post fields to create signature
     */
    public function __generateSignature($queryString)
    {
        /*  http build query from data params */
        $result = http_build_query($queryString, '', '&', PHP_QUERY_RFC3986);
        /* hash the data with the secret key */
        $hash = @hash_hmac('SHA1', strtolower($result), $this->secret_key, true);
        /* encode hash with base64 */
        $signature = base64_encode($hash);
        return $signature;
    }

}