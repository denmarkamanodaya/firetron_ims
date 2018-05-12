$(".edit-mapping").on('click', function()
{
// console.log($(this).data());
var product_code = $(this).data('productCode');
var mapping_type = $("#mapping-type-dropdown").val();
 
$("#mapping-type-dropdown").attr('data-product-code', product_code);
 
$("#mapping-container").css('display','block');
// $("#mapping-container-link").html('<a href="/mapping/edit/' + mapping_type + '/' + product_code + '">Proceed</a>');
 
$("#data-catcher").attr('data-product-code', product_code);
$("#data-catcher").attr('data-mapping-type', mapping_type);
});
 
 
$("#mapping-container-button").on('click', function(){
$("#mapping-container").css('display','none');
});
 
$("#mapping-edit-container-button").on('click', function(){
$("#mapping-edit-container").css('display','none');
});
 
$("#mapping-type-dropdown").change(function()
{
var product_code = $(this).data('productCode');
var mapping_type = $(this).val();
// console.log(mapping_type);
 
$("#data-catcher").attr('data-product-code', product_code);
$("#data-catcher").attr('data-mapping-type', mapping_type);
 
// $("#mapping-container-link").html('<a href="/mapping/edit/' + mapping_type + '/' + product_code + '">Proceed</a>');
});
 
$("#mapping-proceed-button").on('click', function()
{
$("#mapping-container").css('display','none');
$("#mapping-edit-container").css('display','block');
 
var product_code = $("#data-catcher").data('productCode');
var mapping_type = $("#data-catcher").data('mappingType');
 
$("#mapping-edit-container").load('/mapping/edit/' + mapping_type + '/' + product_code);
});
 
 
function submitEditMapping()
{
$("#edit-mapping-form-id").submit();
}
 
