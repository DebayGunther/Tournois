<html>
        <script>
    var $jq = jQuery.noConflict();
    $jq(document).ready( function () {
            //Si on sélectionne un indicateur dans ISS
            $jq('#jeu').change(function() {
                        var jeu = $jq('#jeu').val();
                        if(jeu !== ''){
                               $jq.ajax({
				url: location.pathname,
				dataType: 'json',
				data: {
					ajax_mode: 'jeu',
                                        theme_id: jeu
				},
				success: function(data) {
                                      $jq('#jeu').html(data.jeu)
},
				error: function (){
					alert('ERROR_AJAX');
				}
                                });
                                return false;
                       }
                       else{
                            $jq('#jeu').html('')
                       }
			
             });
             

                    
    })
</script>
