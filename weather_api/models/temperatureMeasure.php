<?php 

class tempMeasure {

    
// --------------- SAVE
    public function save(){
        $tempArray = $this->toArray();
        $checkRecords = $this->read();
        $handle = fopen(DATA_PATH."/temperature_records.csv", "a");
        if ($handle && !$checkRecords[$tempArray['date']]){
            $tempMeasureUpdate = fputcsv($handle, $tempArray);
        } else {
            throw new Exception($tempArray['date']);
        }
        fclose($handle); 

        if ($tempMeasureUpdate === false ) {
            throw new Exception('Failed to save measurement');
        }
        return $tempArray;
    }
    
    
// --------------- READ   
    public function read(){
        if (($handle = fopen(DATA_PATH."/temperature_records.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($this->from && $this->to) {
                    if ($data[0] >= $this->from && $data[0] <= $this->to) {
                        $temperatureRecords[$data[0]]=$data[1];
                    }
                } else {
                    $temperatureRecords[$data[0]]=$data[1];   
                }
            }
            fclose($handle);
            ksort($temperatureRecords);
        }
        return $temperatureRecords;
    }
    
    
// --------------- UPDATE     
    public function update() {
        $tempArray = $this->toArray();
        $handle = fopen(DATA_PATH."/temperature_records.csv", "r");
        $tempTable = fopen(DATA_PATH.'/table_temp.csv','w'); 
    
        if ($handle !== FALSE && $tempArray['date'] && $tempArray['temperature']) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($data[0]!==$tempArray['date']) {
                    $tRecord = array($data[0],$data[1]);
                    fputcsv($tempTable, $tRecord);
                }
            }
            $tRecord = array($tempArray['date'],$tempArray['temperature']);
            fputcsv($tempTable, $tRecord);
            fclose($handle); 
            fclose($tempTable);
            rename(DATA_PATH.'/table_temp.csv',DATA_PATH.'/temperature_records.csv');
        }
    }
    
// --------------- TO ARRAY      
    public function toArray(){
        return array(
            'date' => $this->measureDate,
            'temperature' => $this->temperature,
        );
    }
}