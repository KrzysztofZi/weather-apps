
<h2 style="margin-top: 40px; margin-bottom: 10px;">
    Update an existing temperature reading:
</h2>

<div id="updateTemperature" >
    <form method="post" action="" class="grid-container-two" style="margin-left: 10px;">
        <input type="hidden" value="" id="selectedDate" name="selectedDate">
        <select id="dates" name='date' onchange="showTemperature()" class="grid-item fullWidth">
            <option selected value=""></option>
        <?php foreach ($temperatureRecords as $date => $value){
            echo '<option value="'.$value.'" >'.$date.'</option>';
        } ?>
        </select>
        <input class="grid-item fullWidth" id="tempInput" value='' type="number" step=".01" name="temp">
        <input class="grid-item fullWidth" type="submit" value="Update">
    </form>
</div>

<?php
//Check if current date exists, if not grab it from 
$currentDate=false;
foreach ($temperatureRecords as $date => $value){
    if ($date==$today){
       $currentDate=true; 
    }
}
if ($currentDate==false) {
    $callApi = new ApiCaller($apiUrl.'&action=createCurrent');
    $sendRequest = $callApi->sendRequest();  
    if ($sendRequest) {
        header("Refresh:0");
    }
}
//Check $_POST for update, if so send update API request
if (isset($_POST['selectedDate']) && isset($_POST['temp'])){
   $callApi = new ApiCaller(
       $apiUrl.'&action=update&measureDate='.$_POST['selectedDate'].'&temperature='.$_POST['temp']
   );
   $sendRequest = $callApi->sendRequest();
   header("Refresh:0");    
}
?>