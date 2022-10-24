const infoMessage = document.getElementsByClassName("info-message");

setTimeout(function(){
  for (let i = 0; i < infoMessage.length; i++){
    infoMessage[i].style.display = 'none';
  } }, 3000);
