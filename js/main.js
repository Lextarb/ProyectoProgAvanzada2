var root = document.getElementsByTagName('html')[0];
const btnSwitch = document.querySelector('#switch');
var miCookie = readCookie("Tema");


function readCookie(name) {

  var nameEQ = name + "="; 
  var ca = document.cookie.split(';');

  for(var i=0;i < ca.length;i++) {

    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) {
      return decodeURIComponent( c.substring(nameEQ.length,c.length) );
    }

  }

  return null;

}

    btnSwitch.addEventListener('click',() => {
        root.classList.toggle('dark');
        btnSwitch.classList.toggle('active');
        if(miCookie=="oscuro"){
          document.cookie = "Tema=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        }
        else{
            document.cookie ="Tema=oscuro";
            

        }
    });


if(miCookie=="oscuro"){
    
        root.classList.toggle('dark');
        btnSwitch.classList.toggle('active');
        document.cookie ="Tema=oscuro";
    
}
