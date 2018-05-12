

// Toggle
$("body").on('load')
{
	$(".toggle-brand-new").show();
	$(".toggle-refill").hide();
}

$(".toggle-type").on('click', function(){
	$(".toggle-brand-new").toggle();
	$(".toggle-refill").toggle();
	$("span.toggle_type_info").toggle();
});

//Test
$(".touchable").hover(function(){
	var col = $(this).data('col');
	$("." + col).css('background-color', '#F2EDE5');
}, function(){
	var col = $(this).data('col');
	$("." + col).css('background-color', '#fff');
});


$("#delete_component_button").attr('disabled', 'disabled');



// First button interaction
$(".edit-mapping").on('click', function()
{
	var product_code = $(this).data('productCode');
	var mapping_type = $("#mapping-type-dropdown").val();
	$("#mapping-type-dropdown").attr('data-product-code', product_code);
	$("#overlay").css('display','block');
	$("#edit-mapping-container").css('display','block');	
	$("#data-catcher").attr('data-product-code', product_code);
	$("#data-catcher").attr('data-mapping-type', mapping_type);
});

$(".add-mapping").on('click', function()
{
	var product_code = $(this).data('productCode');
	$("#add-mapping-container").load('/mapping/add/' + product_code);
	$("#overlay").css('display','block');
	$("#add-mapping-container").css('display','block');
});

$(".remove-mapping").on('click', function()
{
	var product_code = $(this).data('productCode');
	$("#remove-mapping-container").load('/mapping/remove/' + product_code);
	$("#overlay").css('display','block');
	$("#remove-mapping-container").css('display','block');
});





// Main containers X button
/*
 | ----------------------------------------------------------------------------
 | @resource TITLE
 | ----------------------------------------------------------------------------
 | 
 | @author <denmarkamanodaya@gmail.com>
 | @date 
 |
 | @description
 |
 |
   $("#edit-mapping-container").css('display','none');
   $("#mapping-edit-container").css('display','none');
   $("#add-mapping-container").css('display','none');
   $("#remove-mapping-container").css('display','none');
   #tracking-content-container
 */
$("#edit-mapping-container-button, #mapping-edit-container-button, #add-mapping-container-x-button, #remove-mapping-container-x-button, #tracking-content-container-x-button, #create-product-component-container-x-button, #delete-product-component-container-x-button").on('click', function()
{
	redirectToHome();
});

$("#tracking-content-container-x2-button").on('click', function(){
	window.location.replace('http://192.168.1.100:8080/gui/buy-and-sell');
});





$(".buy-and-sell-button").on('click', function(){
	var product_code = $(this).data('code');
	$("#overlay").css('display','block');
	$(".tracking-bns-content-container").show();
	$(".tracking-bns-content-container").load('/gui/buy-and-sell/' + product_code);
});

$("#mapping-type-dropdown").change(function()
{
	var product_code = $(this).data('productCode');
	var mapping_type = $(this).val();
	// console.log(mapping_type);

	$("#data-catcher").attr('data-product-code', product_code);
	$("#data-catcher").attr('data-mapping-type', mapping_type);
});

$("#edit-mapping-proceed-button").on('click', function()
{
	$("#edit-mapping-container").css('display','none');	
	$("#overlay").css('display','block');
	$("#mapping-edit-container").css('display','block');

	var product_code = $("#data-catcher").data('productCode');
	var mapping_type = $("#data-catcher").data('mappingType');

	$("#mapping-edit-container").load('/mapping/edit/' + mapping_type + '/' + product_code);
});

$(".tracking-content-button").on('click', function(){
	var component_code = $(this).data('componentCode');
	$("#overlay").css('display','block');
	$(".tracking-content-container").show();
	$(".tracking-content-container").load('/gui/full/' + component_code);
});

$("#add-new-component, #add-new-product").on('click', function(){
	var type = $(this).data('type');
	$("#overlay").css('display','block');
	$(".create-component-product-container").html('');
	$(".create-component-product-container").css('display', 'block').load('/' + type + '/create');
});

$(".delete-component, .delete-product").on('click', function(){
	var type = $(this).data('type');
	var code = $(this).data('code');
	$("#overlay").css('display','block');
	$(".delete-component-product-container").html('');
	$(".delete-component-product-container").css('display', 'block').load('/delete/' + type + '/' + code);	
});

$("#delete_verification").change(function()
{
	var data = $(this).is(':checked', true);

	if(data === true)
	{
		$("#delete_component_button").removeAttr('disabled');
	}
	else
	{
		$("#delete_component_button").attr('disabled', 'disabled');
	}
});








function redirectToHome()
{
	window.location.replace('http://192.168.1.100:8080/gui/');
}










// Submit function
function submitEditMapping()
{
	$("#edit-mapping-form-id").submit();
}

function submitAddMapping()
{
	$("#add-mapping-form-id").submit();
}

function submitRemoveMapping()
{
	$("#remove-mapping-form-id").submit();
}

function saveCreatedComponent()
{
	$("#create-component-container").submit();
}

function saveCreatedProduct()
{
	$("#create-component-container").submit();
}

function finalDelete()
{
	$("#delete-form-id").submit();
}