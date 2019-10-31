<?php 
$lastSeven = datesToDays($temperatureRecords,'6',1);
?>
<h2>Last seven days:</h2>
<div id="lastSeven" class="grid-container">
    <?php 
    foreach ($lastSeven as $day => $temp){
    ?>
        <div class="grid-item">
            <ul>
                <li><?=$day?></li>
                <li><?=$temp?></li>
            </ul>
        </div>    
    <?php 
    }
    ?>  
</div>     