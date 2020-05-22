<script type="text/javascript">
$(document).ready(function(){

	$("#menu").click(function(e){

		 e.preventDefault();
		
			$('.sidebar').toggle('slide', { direction: 'left' }, 500);
        $('.content').animate({
            'margin-left' : $('.content').css('margin-left') == '0px' ? '250px' : '0px'
        }, 500);



	});


	

});



</script>
