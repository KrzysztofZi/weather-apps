<?php
class readTemp {
    private $_params;
     
    public function __construct($params){
        $this->_params = $params;
    }
     
    public function createMeasurement(){
        if ($this->_params['measureDate'] && $this->_params['temperature']){
            $temp = new tempMeasure();
            $temp->measureDate = $this->_params['measureDate'];
            $temp->temperature = $this->_params['temperature'];
            $temp->save();
            return $temp->toArray();
        }
    }
    
    public function createCurrentMeasurement(){
        $temp = new tempMeasure();
        // grab current temperature for London from openweathermap.org 
        $oWKey = '50e68c770c9d5e56fc47f9cc4e0bb712';
        $today = date('Y-m-d');
        $currentTemp = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=London&units=metric&appid='.$oWKey);
        $currentTemp = json_decode($currentTemp);
        
        $temp->measureDate = $today;
        $temp->temperature = $currentTemp->main->temp;
        $temp->save();

        return $temp->toArray();
    }
     
    public function readMeasurement(){
        $temp = new tempMeasure();
        if ($this->_params['from'] && $this->_params['to']) {
            $temp->from = $this->_params['from'];
            $temp->to = $this->_params['to'];   
        }
        return $temp->read();
    }
     
    public function updateMeasurement()
    {
        if ($this->_params['measureDate'] && $this->_params['temperature']){
        $temp = new tempMeasure();
            $temp->measureDate = $this->_params['measureDate'];
            $temp->temperature = $this->_params['temperature'];
        } 
        $temp->update();
        return $temp->toArray();
    }
     
    public function deleteMeasurement()
    {

    }
}