		$(document).ready(function(){
			
			var count=0;
		  $(".menu").click(function(){
			  count++;
			  if(count==1)
				{
					$("#wrapper").slideDown();
				}
			   if(count==2)
			   {
				   $("#wrapper").slideUp();
				   count=0;
				}
       });
	});	
