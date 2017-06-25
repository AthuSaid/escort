// =========================================
//  Portfolio Isotop with Infinity Scroll
// =========================================   

$(function () {
	
	// Initialize Infinity Scroll
	var win = $(window);
	var scrollEnd = false;
	
    win.scroll(function() {
		// End of the document reached?    	
		if ($(document).height() - win.height() == win.scrollTop()) {
			if (scrollEnd == false) {
				$("#loading").fadeIn(500);
				$.ajax({
					url: $urlProj + '_actions/paging.php',
					dataType: 'html',
					success: function( html ) {
						if (html == '')
							scrollEnd = true;
						var $container = $(".infinity");
						var $elem = $(html);
						$container.append( $elem ).isotope( 'appended', $elem );			
			            setTimeout(function () {
			            	$("#loading").fadeOut(500);
			            }, 500);
					}
				});
			}		
		}
	});
});