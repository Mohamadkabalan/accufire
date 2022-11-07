// TODO: convert to jQuery
// TODO: Create webpack config or task runner to mini/uglify this.
jQuery(document).ready(function ($) {
	var ccNumber = '';
	var ccInputId = paymentgateway_data.id + '_card_number';
	var ccInputIdSelector = '#' + ccInputId;
	var savedMethodsRadiosSelector = 'input[name="wc-' + paymentgateway_data.id + '-payment-token"]'
	var $savedMethods = $(savedMethodsRadiosSelector);
	var selectedVal = $savedMethods.filter(':checked').val();
	$(document).on('change', ccInputIdSelector, function (e) {
		var $this = $(this);
		if (ccNumber !== $this.val()) {
			ccNumber = $this.val();
			if (ccNumber.replace(/\s+/g, '').length > 5) {
				surcharge(ccNumber);
			}
		}
	});
	$(document).on('change', savedMethodsRadiosSelector, function (e) {
		var newVal = $(savedMethodsRadiosSelector).filter(':checked').val();
		if (selectedVal !== newVal) {
			selectedVal = newVal;
			if (selectedVal !== 'new') {
				// TODO: DEV-764
				surcharge('');
			}
		}
	});
	$(document).on('change', 'input[name="payment_method"]', function () {
		surcharge('');
	});

	function surcharge(ccNumber) {
		blockCheckout();
		$.post(paymentgateway_data.ajax_url, {
			nonce: paymentgateway_data.nonce,
			action: paymentgateway_data.action,
			[ccInputId]: ccNumber,
		}, function (response) {
			var $root = $('#' + paymentgateway_data.id + '_cc_form');
			var surchargeId = paymentgateway_data.id + '_surcharge_wrapper';
			$root.find($('#' + surchargeId)).remove();
			if (response) {
				$root.prepend('<div id="' + surchargeId + '">' + response + '</div><br>');
			}
			unBlockCheckout();
			$('body').trigger('update_checkout');
		});
	}

	function blockCheckout() {
		$('.woocommerce-checkout-payment, .woocommerce-checkout-review-order-table').addClass('processing').block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
	}

	function unBlockCheckout() {
		$('.woocommerce-checkout-payment, .woocommerce-checkout-review-order-table').addClass('processing').block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
	}
});