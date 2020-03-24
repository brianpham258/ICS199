window.onload = function()
{
    if (window.jQuery)
    {
       // alert('jQuery is loaded');
    }
    else
    {
        alert('jQuery is not loaded');
    }
}
$("#table tr").click(function(){
   $(this).addClass('selected').siblings().removeClass('selected');    
   var value=$(this).find('td:first').html();
   document.getElementById("getOrderId").value = value;
   document.getElementById("getOrderId3").value = value;
   document.getElementById("getOrderId4").value = value;
//	alert(value);
});

