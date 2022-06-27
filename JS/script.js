$(document).ready(function(){
		var scroll_pos = 0;
		    $(document).scroll(function() {
		        scroll_pos = $(this).scrollTop();
		        if(scroll_pos > 10) {
		        	$(".menu").addClass("box-shadow");
		        }
		        else {
		            $(".menu").removeClass("box-shadow");
		        }
		    });
        $('.b-1').click(function(){
            window.scrollTo({
              top: 0,
              behavior: "smooth"
          });
    		});
        $('.b-2').click(function(){
            window.scrollTo({
            top: 955,
            behavior: "smooth"
          });
    		});
        $('.b-3').click(function(){
            window.scrollTo({
            top: 1700,
            behavior: "smooth"
          });
    		});
        $('.b-4').click(function(){
        		alert( 'Текущая прокрутка сверху: ' + window.pageYOffset );
    		});
});
