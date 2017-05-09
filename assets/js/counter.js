/**
 * 
 */
function fCountHomeResume(){	
    $.get($urlProj + "_actions/notify.php",{
            mtd: "ntf"
        },          
        function(data){
            if($.trim(data.ret) == false){                       
                alert("erro");
            }else{                                             
                $('.pc').html("<em>" + data.pc + "</em>");
                $('.mo').html("<em>" + data.mo + "</em>");
                $('.pr').html("<em>" + data.pr + "</em>");
                $('.ac').html("<em>" + data.ac + "</em>");
                $('.statistic-counter').counterUp({
                    delay: 10,
                    time: 2000
                });
            }
        }, "json"
    );       
}

function fCountNavMenu(){	
    $.get($urlProj + "_actions/notify.php",{
            mtd: "nav"
        },          
        function(data){
            if(data.ret == true){
            	$('.notify-html').removeClass('hidden');
                $('.counter-notify').html(data.counter);
                $('.notify-html').html(data.html);
            }else{
            	$('.notify-html').addClass('hidden');
            }
        }, "json"
    );       
}


jQuery(document).ready(function ($) {
	fCountHomeResume();
	fCountNavMenu();
	setInterval(function(){ fCountHomeResume(); fCountNavMenu(); }, 60000);
});