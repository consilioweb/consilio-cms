;(function($){
	function previewSWF() {

		$('.input-file').change(function (){

			fileInput = $(this);
			extension = fileInput.val().split('.').pop();

		});

	}
	new previewSWF();
}(jQuery));