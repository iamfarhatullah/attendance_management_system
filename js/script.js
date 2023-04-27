$("#menu-toggle").click( function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("menuDisplayed");
});

$(document).ready(function(){
    $("#title").blur(function(){
        hide("#display_info");
    });
});

function confirmDelete() {
  return confirm("Are you sure?");
}





