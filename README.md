# weather-apps
A weather web interface app and a web API bundle

# About 
Both applications have been written from scratch, without any frameworks in vanilla JavaScript, PHP, HTML and CSS. Weather Interface is a front-end app for displaying temperatures taken via API calls from weather_api application.

Note that both applications work without the need to connect to a database as the records are being saved and update directly onto the temperature_records.csv file. 

# Weather API
List of possible API calls:
(date format: YYYY-MM-DD)

*Read all records:
weather_api.php?controller=readTemp&action=read

*Read records 'from - to' date:
weather_api.php?controller=readTemp&action=read&from=2019-01-20&to=2019-10-01

*Add current temperature (taken live from third party API, London Celcius):
weather_api.php?controller=readTemp&action=createCurrent

*Add new temperature:
weather_api.php?controller=readTemp&action=create&measureDate=2019-04-02&temperature=12

*if a record exists, an update form pops up

*To import a csv file go to weather_api/import.php, select a csv file and a number of rows you would like to upload (from top to bottom)
