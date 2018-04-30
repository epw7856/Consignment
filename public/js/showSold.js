function showSold(){

  if(document.getElementById('r1').checked)
 {
        document.getElementById('sold1').disabled = false;
        document.getElementById('salesid1').disabled = false;  
        document.getElementById('saleamt1').disabled = false;  
        document.getElementById('costs1').disabled = false;
        document.getElementById('pct1').disabled = false;  
   }else{
        document.getElementById('sold1').disabled = true;
        document.getElementById('salesid1').disabled = true;  
        document.getElementById('saleamt1').disabled = true;  
        document.getElementById('costs1').disabled = true;
        document.getElementById('pct1').disabled = true;  
   }
 }

 window.onload = showSold();