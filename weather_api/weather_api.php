<?php

define('DATA_PATH', realpath(dirname(__FILE__).'/data'));
define('VIEW_PATH', realpath(dirname(__FILE__).'/view'));

require_once 'models/temperatureMeasure.php';
 
try {
    $params = $_REQUEST;
    
    $controller = ucfirst(strtolower($params['controller']));
     
    $action = strtolower($params['action']).'Measurement';
 
    if( file_exists("../weather_api/controllers/{$controller}.php") ) {
        include_once "../weather_api/controllers/{$controller}.php";
    } else {
        throw new Exception('Controller is invalid.');
    }

    $controller = new $controller($params);

    if( method_exists($controller, $action) === false ) {
        throw new Exception('Action is invalid.');
    }

    $result = array();
    $result['data'] = $controller->$action();
    $result['success'] = true;
    $result['action'] = $params['action'];
     
} catch( Exception $e ) {
    $result = array();
    $result['success'] = false;
    $result['action'] = $params['action'];
    $result['existingDate'] = $e->getMessage();
}

//require_once 'page_elements/weather_api_response.php';
echo json_encode($result); 
if ($result['success']==false && ($result['action']=='create' || $result['action']=='createCurrent')) {
    include_once dirname(__FILE__)."/view/update.php";
} else {
    exit();
}
