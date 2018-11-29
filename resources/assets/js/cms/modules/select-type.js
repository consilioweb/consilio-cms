;(function($){
	
	function selectType() {	

		alert("ALGO");

		$('.select-type').change(function(e){

			$(".type-div").hide();

			var type = $(this).attr('data-type');

			$("#" + type).show();



		});


	}
	
	new selectType();

}(jQuery));