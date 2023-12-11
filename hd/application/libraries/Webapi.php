<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Webapi {

    
    var $CI;
    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('curl');
    }

    function post2($url="",$data=array(), $is_json=true)
    {
        $this->CI->curl->create(URL_API.$url);
        $this->CI->curl->post(array("param"=>format_request($data)));
        $result = $this->CI->curl->execute();
        if($is_json)
        {
            return $result;
        }
        else
        {
            return json_decode($result);
        }
    }

    function post($url, $data, $json=true){
        $url        = URL_API.$url;
        $ch         = curl_init();

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("param"=>format_request($data)));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $output =   curl_exec($ch);
                    curl_close($ch);

        if($json)
            return $output;
        else
            return json_decode($output);
        
    }

    function get($url)
    {
        $data=$this->CI->curl->simple_get($url);
        $result = $data;
        return $result;
    }

}