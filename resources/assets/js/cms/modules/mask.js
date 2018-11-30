;(function($){
	function Mask() {


		var SPMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
		spOptions = {
			onKeyPress: function(val, e, field, options) {
				field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};

		var optionsCpfCnpj = {
			onKeyPress : function(cpfcnpj, e, field, options) {
				var masks = ['000.000.000-000', '00.000.000/0000-00'];
				var mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
				$('.cpfcnpj').mask(mask, options);
			}
		};

		$('.cpfcnpj-mask').mask('000.000.000-00', optionsCpfCnpj);
		$('.cellphone-mask').mask(SPMaskBehavior, spOptions);
		$('.ip_address').mask('099.099.099.099');
		$('.cpf-mask').mask('000.000.000-00', {reverse: true});
		$('.cnpj-mask').mask('00.000.000/0000-00', {reverse: true});
		$('.date-mask').mask('00/00/0000');
		$('.cep-mask').mask('00000-000');
		$('.cnp-maskj').mask('00.000.000/0000-00', {reverse: true});
		$('.cpf-mask').mask('000.000.000-00', {reverse: true});
		$('.money-mask').mask('000.000.000.000.000,00', {reverse: true});
		$('.phone-mask').mask('0000-0000');

	}
	new Mask();
}(jQuery)); 