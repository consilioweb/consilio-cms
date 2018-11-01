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
//# sourceMappingURL=cms-categories-create.js.map
