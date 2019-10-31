<?php

class ApiCaller
{
    private $_api_url;

    public function __construct($api_url){
        $this->_api_url = $api_url;
    }

    public function sendRequest(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($ch);
        $result = json_decode($result);

        if( $result == false || isset($result->success) == false ) {
            throw new Exception('Request was not correct');
        } else {
            $result = $result->data;
        }
        return $result;
    }
}