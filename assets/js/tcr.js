
function fTCR(duration){	                                                 
    var timer = duration, days, hours, minutes, seconds;
    var dias;
    setInterval(function() {
    	
    	days = parseInt(timer / 86400, 10);
    	hours = parseInt(timer / 3600, 10);
	    minutes = parseInt(timer / 60, 10);
	    seconds = parseInt(timer % 60, 10);
	    
	    days   = days < 10 ? "0" + days : (days > 59 ? "00" : days);
	    dias = (days > 1 ? days % 60 + " dias : " : (days == 1 ? "1 dia : " : ""));
	    hours   = hours % 24;
	    minutes = minutes % 60;
	    seconds = seconds < 10 ? "0" + seconds : (seconds > 59 ? "00" : seconds);
	    
	    $('.time-remaining').html(dias + (hours < 10 ? "0" + hours : hours) + " : " + (minutes < 10 ? "0" + minutes : minutes) + " : " + seconds);
	    
	    if (timer == 0){
	    	location.href = "home";
	    }
	    
	    if (--timer < 0){
	    	timer = duration;
	    }
	    
    }, 1000);
}

jQuery(document).ready(function ($) {
	var remaining = ($s) + ($i * 60) + ($h * 60 * 60) + ($d * 60 * 60 * 24) + ($m * 60 * 60 * 24 * 30);
	fTCR(remaining);
});