;(function($){
	function dropzone() {
		Dropzone.autoDiscover = false;
		$(document).ready(function(){
			$(".dropzone").dropzone({ url: "/file/post" });			
		});
	}
	new dropzone();
}(jQuery));