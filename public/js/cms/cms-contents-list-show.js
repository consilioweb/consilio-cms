;(function($){
	function previewFile() {

		$('.input-file').change(function (){

			if (typeof (FileReader) != "undefined") {

				var image_holder = $("#image-holder");
				image_holder.empty();

				var reader = new FileReader();
				reader.onload = function (e) {
					$("<img />", {
						"src": e.target.result,
						"class": "thumb-image"
					}).appendTo(image_holder);

				}
				image_holder.show();
				reader.readAsDataURL($(this)[0].files[0]);
			} else {
				alert("This browser does not support FileReader.");
			}

			
		});

	}
	new previewFile();
}(jQuery));
;(function($){
	function ckEditor() {

		var app_url = $("#app_url").val();

		//CKEDITOR.replace( 'content' );

		CKEDITOR.replace( 'content' ,{
			height: 380,
			filebrowserUploadUrl: app_url + "/api/upload/file",
		});
	}

	new ckEditor();
}(jQuery)); 
;(function($){
	function select2() {

		var placeholder = $(".select2").attr('data-placeholder');

		$(".select2").select2({
			placeholder: "Selecione "+placeholder,
			allowClear: true
		});
		$(".select2-default").select2();
	}

	new select2();
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
//# sourceMappingURL=cms-contents-list-show.js.map
