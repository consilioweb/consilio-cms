;(function($){
	function previewSWF() {

		$('.input-file').change(function (){

			fileInput = $(this);
			extension = fileInput.val().split('.').pop();

		});

	}
	new previewSWF();
}(jQuery));

;(function($){
	function dataPickerRun() {



		$( ".datepicker" ).datepicker({
			format: 'dd/mm/yyyy',
			locale: 'pt-br'
		});
	}

	new dataPickerRun();
}(jQuery)); 
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
//# sourceMappingURL=cms-adverts-create.js.map
