    
function showTemperature() {
 var selectedTemp = document.getElementById('dates');  
 var selectedD = selectedTemp.options[selectedTemp.selectedIndex].text;      
 var tempInput = document.getElementById('tempInput');    
 var selectedDate = document.getElementById('selectedDate');      
 tempInput.value = selectedTemp.value;
 selectedDate.value = selectedD; 
}