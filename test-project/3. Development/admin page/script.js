

$(document).ready(function(){
    //alert("Hello");
    //Add restaurant Button
    $(".addRestaurantButton").click(function(){
        //alert("Add");
        $("#removeRestaurant").css("visibility", "hidden");
        $("#listRestaurant").css("visibility", "hidden");
        $("#addRestaurant").css("visibility", "visible");
        $("#addRestaurant").fadeIn("fast");
    });
    //Remove restaurant button
    $(".removeRestaurantButton").click(function(){
        //alert("remove");
        
        $("#addRestaurant").css("visibility", "hidden");
        $("#listRestaurant").css("visibility", "hidden");
        $("#addRestaurant").hide();
        $("#removeRestaurant").css("visibility", "visible");
        $("#removeRestaurant").fadeIn("fast");
        
    });
    // List restaurant button
    $(".listRestaurantButton").click(function(){
        //alert("list");
        $("#removeRestaurant").css("visibility", "hidden");
        $("#addRestaurant").css("visibility", "hidden");
        $("#addRestaurant").hide();
        $("#removeRestaurant").hide();
        $("#listRestaurant").css("visibility", "visible");
        $("#listRestaurant").fadeIn("fast");
        
	});

});