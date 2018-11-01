;(function($){
	function ckEditor() {

		var app_url = $("#app_url").val();

		CKEDITOR.replace( 'content' );
	}

	new ckEditor();
}(jQuery)); 