<?php $csvArray=array();?>

<table >
    <form action="" method="post" enctype="multipart/form-data">
    <tr>
        <td width="20%">Select file</td>
        <td width="80%"><input type="file" name="fileToUpload" id="fileToUpload" /></td>
    </tr>    
    <tr>    
        <td width="20%">How many rows would you like to upload?</td>
        <td width="80%"><input type="number" min="0" value="1" name="rows" id="rows"/></td>     
    </tr>
    <tr>
        <td>Submit</td>
        <td><input type="submit" name="submit" /></td>
    </tr>
    </form>
</table>
</br>
<?php 
define('DATA_PATH', realpath(dirname(__FILE__).'/data'));

if ( isset($_POST["submit"]) ) {
    $noOfRows = $_POST["rows"];
    $target_dir = DATA_PATH."/upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "csv") {
    echo "Sorry, only csv files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        if (($handle = fopen(DATA_PATH.'/upload/'.$_FILES["fileToUpload"]["name"], "r")) !== FALSE) {
            $counter=1;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($counter<=$noOfRows) {
                $csvArray[$data[0]] = $data[1];
                $counter++;    
            }
        }
        fclose($handle);
        } else {
            echo 'Cannot open the file';
        }
        unlink(DATA_PATH.'/upload/'.$_FILES["fileToUpload"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

foreach ($csvArray as $date => $temp) {
    
    $handle = fopen(DATA_PATH."/temperature_records.csv", "r");
    $tempTable = fopen(DATA_PATH.'/table_temp.csv','w'); 
    
    if ($handle !== FALSE && $csvArray){
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0]!==$date) {
                $tRecord = array($data[0],$data[1]);
                fputcsv($tempTable, $tRecord);
            }
        }
        $tRecord = array($date,$temp);
        fputcsv($tempTable, $tRecord);
        fclose($handle); 
        fclose($tempTable);
        rename(DATA_PATH.'/table_temp.csv',DATA_PATH.'/temperature_records.csv');
        }
}
        echo '</br></br>Temperatures Updated';