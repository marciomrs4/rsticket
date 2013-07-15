/*
<!-- 
   função para ativar a funcionalide
   das tabs.
 -->
<script>


  $(function() {
    $( "#tabs" ).tabs();
    $(".campoData").mask("99/99/9999");
  });
</script>
*/

var $tab = jQuery.noConflict();

$tab(function() {
	$tab( "#tabs" ).tabs();
  })(jQuery);