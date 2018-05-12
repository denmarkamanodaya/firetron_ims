$(document).ready(function()
{




	/*
	 | ----------------------------------------------------------------
	 | Variable Declaration
	 | ----------------------------------------------------------------
	 |
	 | 
	 |
	 */
	var discountRouteUrl	= "/compute-discount";
	var netPaymentRouteUrl 	= "/compute-net-payment";

	var depositAmount 	= $("#deposit_amount");
	var promoCode 		= $("#promo_code");
	var fees 			= $("#fees");
	var discount 		= $("#discount");
	var netPayment 		= $("#net_payment");



	/*
	 | ----------------------------------------------------------------
	 | Check Required Values
	 | ----------------------------------------------------------------
	 |
	 | This basically checks if data is returned from a response
	 | if returning data already exists, try jumping to computation.
	 | Otherwise, clear and disable input data
	 |
	 |
	 */
	checkRequiredValues();



	/*
	 | ----------------------------------------------------------------
	 | On-keyup Event
	 | ----------------------------------------------------------------
	 |
	 | For deposit_amount & feees
	 |
	 |
	 */
	$("#deposit_amount, #fees").on('keyup', function()
	{
		clearData();
		checkRequiredValues();
	});



	/*
	 | ----------------------------------------------------------------
	 | On-key up Event
	 | ----------------------------------------------------------------
	 |
	 | For promo_code 
	 |
	 |
	 */
	promoCode.on('keyup', function()
	{	
		proceedComputation();
	});



	/*
	 | ----------------------------------------------------------------
	 | Main Computation
	 | ----------------------------------------------------------------
	 |
	 | Responsible for discount & net_payment computation
	 |
	 |
	 */
	function proceedComputation()
	{
		// Double check deposit amount and fees
		if( depositAmount.val() != "" && fees.val() != "" && promoCode.val() != "") 
		{
			// Compute for discount
			discountUrl 	= discountRouteUrl + '/' + promoCode.val() + '/' + depositAmount.val() + '/' + fees.val();
			$.get(discountUrl, function (discountData) 
			{
				// console.log(data);
				discount.val(discountData);

				// Compute for net payment
				netPaymentUrl 	= netPaymentRouteUrl + '/' + depositAmount.val() + '/' + fees.val() + '/' + discountData;
				$.get(netPaymentUrl, function (netPaymentData)
				{
					netPayment.val(netPaymentData);
				});
			});
		}
		else
		{
			clearData();
		}
	}



	/*
	 | ----------------------------------------------------------------
	 | 
	 | ----------------------------------------------------------------
	 |
	 | 
	 |
	 */
	function checkRequiredValues()
	{
		if( depositAmount.val() != "" && fees.val()  != "" )
		{
			promoCode.prop('disabled', false);
			proceedComputation();
		}
		else
		{
			promoCode.prop('disabled', true);
			clearData();
		}
	}



	/*
	 | ----------------------------------------------------------------
	 | 
	 | ----------------------------------------------------------------
	 |
	 | 
	 |
	 */
	function clearData()
	{
		discount.val("");
		netPayment.val("");
	}

});

