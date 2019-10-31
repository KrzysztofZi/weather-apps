<?php
require_once 'page_elements/header.php';
require_once 'required/constants.php';
require_once 'classes/call_api.php';
require_once 'functions.php';

//Record records via API
$callApi = new ApiCaller($apiUrl.'&action=read');
$temperatureRecords = $callApi->sendRequest();

// Display temperatures for the last seven days
require_once 'page_elements/display_last_seven.php';

// Update temperatures form
require_once 'page_elements/update_existing_records.php';