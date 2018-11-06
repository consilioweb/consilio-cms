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