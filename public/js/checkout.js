Stripe.setPublishableKey('pk_test_P0Oggvx0EU38wOHKwNGahcsF');


var form = $('#cc-form');
var errorDiv = $('.checkout-error');

form.submit(function(event){
	event.preventDefault();
	$('.checkout-error').addClass('hidden');
	form.find('.submit-button').prop('disable',true);
	Stripe.card.createToken({
		number: $('#card-number').val(),
		cvc: $('#card-cvc').val(),
		exp_month: $('#card-expiry-month').val(),
		exp_year: $('#card-expiry-year').val(),
		name: $('#card-name').val()
	}, stripeResponseHandler);
	return false;

});

function stripeResponseHandler(status, res){

	if(res.error){
		errorDiv.text(res.error.message);
		errorDiv.removeClass('hidden');
		form.find('.submit-button').prop('disable',true);
	}else{
		var token = res.id;

		form.append($('<input type="hidden" name="stripeToken" />').val(token));
		form.get(0).submit();
	}

	


}


