
var $submit = jQuery.noConflict();

$submit(function() 
{
	
	$submit("form").submit(function() 
	{
//Se validate estiver ativo
	        if (validate() == true) 
	        {
// ReadOnly em todos os inputs
	        	$submit("input", this).attr("readonly", true);		
// Desabilita os submits
	        	$submit("input[type='submit'],input[type='image']", this).attr("disabled", true);			
			            return true;
			 }else 
			 {
			 return false;
			 }
			
	});		
})(jQuery);
