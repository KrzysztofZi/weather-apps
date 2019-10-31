<?php 
$temp = new tempMeasure();
$csvRecords = $temp->read();
echo 'Record for date: '.$result['existingDate'].' already exists. Would you like to update the temperature?'; 
if (isset($_POST['temperature'])) {
    $tempValue = $_POST['temperature'];
} else {
    $tempValue = $csvRecords[$result['existingDate']];
}
?>
<form method="post" action="">
    <input type="hidden" value="<?=$result['existingDate']?>" name="measurementDate" >
    <input name="temperature" type="number" value="<?=$tempValue;?>"></input>
    <input type="submit" value="Update">
</form>
<?php

if ($_POST['temperature'] && $_POST['measurementDate']) {
    $handle = fopen(DATA_PATH."/temperature_records.csv", "r");
    $tempTable = fopen(DATA_PATH.'/table_temp.csv','w'); 
    
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0]!==$_POST['measurementDate']) {
                $tRecord = array($data[0],$data[1]);
                fputcsv($tempTable, $tRecord);
            }
        }
        $tRecord = array($_POST['measurementDate'],$_POST['temperature']);
        fputcsv($tempTable, $tRecord);
        fclose($handle); 
        fclose($tempTable);
        rename(DATA_PATH.'/table_temp.csv',DATA_PATH.'/temperature_records.csv');
    }
}