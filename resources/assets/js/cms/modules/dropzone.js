;(function($){

	function dropzone() {

		var app_url = $("#app_url").val();
		var app_hash = $("#app_hash").val();

		var modules_id = $("#app_modules").val();
		var contents_id = $("#app_contents").val();

		var app_redirect = $("#app_redirect").val();
		
		Dropzone.autoDiscover = false;
		$("#files-upload").dropzone({

			uploadMultiple: true,
			parallelUploads: 10, 
			//maxFiles: 10,
			addRemoveLinks: true,
			dictRemoveFile: "Apagar Arquivo",
			removedfile: function(file) {
				var name = file.name; 

				swal({
					title: 'Apagar a Arquivo?',
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: 'Não',
					confirmButtonText: 'Sim'
				}).then((result) => {
					$.ajax({
						url: app_url + '/cms/'+app_redirect+'/'+modules_id+'/'+contents_id+'/remove/'+ name,
						type: 'get',
						data: {hash: app_hash},
						sucess: function(data){
							console.log('success: ' + data);
						}
					});
					var _ref;
					return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;


					swal(
						'Deleted!',
						'Your file has been deleted.',
						'success'
						)
				})

			},
			init: function() { 
				myDropzone = this;
				$.ajax({
					url: app_url + '/cms/'+app_redirect+'/'+modules_id+'/'+contents_id+'/show',
					type: 'get',
					data: {request: 2},
					dataType: 'json',
					success: function(response){

						$.each(response, function(key,value) {
							var mockFile = { name: value.name, size: value.size};

							myDropzone.emit("addedfile", mockFile);
							myDropzone.emit("thumbnail", mockFile, value.path);
							myDropzone.emit("complete", mockFile);

						});

					}
				});
			}
		});
		
	}

	new dropzone();
}(jQuery));