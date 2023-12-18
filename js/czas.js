function aktualizujDate() {
    var elementCzasu = document.getElementById('czas');
    var aktualnaData = new Date();
  
    var dzien = aktualnaData.getDate();
    var miesiac = aktualnaData.getMonth() + 1;
    var rok = aktualnaData.getFullYear();
    var godzina = aktualnaData.getHours();
    var minuta = aktualnaData.getMinutes();
    var sekunda = aktualnaData.getSeconds();
  
    var tekstCzasu = '&nbsp;  ' + dzien + ' . ' + miesiac + ' . ' + rok + ' GODZINA ' + godzina + ':' + minuta + ':' + sekunda;
  
    elementCzasu.innerHTML = tekstCzasu;
  
    // Przewiń stronę do elementu o id "czas"
    elementCzasu.scrollIntoView();
  }
  
  setInterval(aktualizujDate, 1000);