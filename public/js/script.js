$(function(){

	$('.payment-radio input[name="payment-method"]').each(function(){
		paymentSelect($(this));
		$(this).change(function(){
			paymentSelect($(this));
		});
	});

	function paymentSelect(selector){
		if($(selector).is(':checked')){
			if($(selector).val()=='paypal'){
				$('.checkout-btn').css({'display':'none'});
				$('button.checkout-btn').css({'display':'block'});
			}else if($(selector).val()=='creditcard'){
				$('.checkout-btn').css({'display':'none'});
				$('a.checkout-btn').css({'display':'block'});
			}else{
				$('.checkout-btn').prop('disable',true);
			}
		}
	}

	

	


});