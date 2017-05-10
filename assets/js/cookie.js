var latitude;
var longitude;

function fSetCookieData() {
    var d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    var mygender = $("#myGender").val();
    var findgender = $("#findGender").val();
    var cvalue = mygender + "_" + findgender;
    document.cookie = "cUserDefinedData=" + cvalue + ";" + expires + ";path=/";
    location.href = 'index.php';
}

function fSetCookieLocation() {
	var cUserDefinedLocation = fGetCookie("cUserDefinedLocation");
    if (cUserDefinedLocation == "") {        
	    var d = new Date();
	    d.setTime(d.getTime() + (10*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    var cvalue = latitude + "_" + longitude;
	    document.cookie = "cUserDefinedLocation=" + cvalue + ";" + expires + ";path=/";
	    console.log("Your location was setted to " + cUserDefinedLocation);
    }else{
    	console.log("Your location is still " + cUserDefinedLocation + "! Wait for 10 seconds to renew");
    }
}

function fSetCookieAge() {
	var d = new Date();
	var month = $("#month").val();
    var year = $("#year").val();
	if (month == "" || year == "")
	{
		alert('Informe sua data de nascimento corretamente!');
	}else{
		if ((d.getFullYear() - year) < 18)
		{
			alert('Proibido para menores de 18 anos!');
			location.href = 'http://www.google.com';
		}else{
		    d.setTime(d.getTime() + (24*60*60*1000));
		    var expires = "expires="+ d.toUTCString();
		    
		    var cvalue = month + "/" + year;
		    document.cookie = "cUserAgeVerified=" + cvalue + ";" + expires + ";path=/";
		    location.href = 'index.php';
		}
	}    
}

function fGetCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function fDeleteCookie() {
    document.cookie = "cUserDefinedData=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    console.log("Your cookie was expired!");
    location.href = 'index.php';
}

function fCheckCookie() {
    var cUserDefinedData = fGetCookie("cUserDefinedData");
    if (cUserDefinedData != "") {
        console.log("Welcome again! Your data is " + cUserDefinedData);
    } else {
    	$("#divFirstAccess").modal({
	    	  escapeClose: false,
	    	  clickClose: false,
	    	  showClose: false
	    });
    }
}

function fCheckCookieAge() {
    var cUserAgeVerified = fGetCookie("cUserAgeVerified");
    if (cUserAgeVerified != "") {
        console.log("Welcome again! Your age confirmed is " + cUserAgeVerified);
        return true;
    } else {
    	$("#divDisclaimerAge").modal({
	    	  escapeClose: false,
	    	  clickClose: false,
	    	  showClose: false
	    });
    	return false;
    }
}

function fGetPosition(){
  // Verifica se o browser do usuario tem suporte a Geolocation
  if ( navigator.geolocation ){
    /*navigator.geolocation.getCurrentPosition( function( posicao ){
      console.log( posicao.coords.latitude, posicao.coords.longitude );
      latitude = posicao.coords.latitude;
      longitude = posicao.coords.longitude;
      fSetCookieLocation();
    });*/
	latitude = -23.6821604;
	longitude = -46.8754915;
	fSetCookieLocation();
	console.log('set user location');
  }
}


jQuery(document).ready(function ($) {
	fGetPosition();
	if (fCheckCookieAge()){
		fCheckCookie();	
	}
});