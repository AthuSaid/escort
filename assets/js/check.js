/**
 * 
 */
function fCheckPersonPayment(){	
    $.get($urlProj + "_actions/notify.php",{
            mtd: "pay"
        },          
        function(data){
            if(data.ret == true){
            	location.href = $urlProj + "dashboard";
            }
        }, "json"
    );       
}

jQuery(document).ready(function ($) {
	fCheckPersonPayment();
	setInterval(function(){ fCheckPersonPayment(); }, 30000);
});