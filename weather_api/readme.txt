List of possible API calls:

date format: YYYY-MM-DD

*Read all records:
weather_api.php?controller=readTemp&action=read

*Read records 'from - to' date:
weather_api.php?controller=readTemp&action=read&from=2019-01-20&to=2019-10-01

*Add current temperature (taken live from third party API, London Celcius):
weather_api.php?controller=readTemp&action=createCurrent

*Add new temperature:
weather_api.php?controller=readTemp&action=create&measureDate=2019-04-02&temperature=12

*if a record exists, an update form pops up

*To import a csv file go to import.php, select a csv file and a number of rows you would like to upload (from top to bottom)