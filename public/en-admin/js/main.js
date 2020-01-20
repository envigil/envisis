(function($) {
  //Sidbar hover
  $(".clicker").hover(function() {
    var clickers = $(".clicker");
    var dropmenu = $(".dropmenu");
    var thisClass = $(this).children(".hide");
    for (var i = 0; i < clickers.length; i++) {
      $(dropmenu[i]).addClass("hide");
    }
    $(thisClass).removeClass("hide");
  });

  //slide in and Out the sidebar
  $(".ToggleExpand").click(function() {
    $(".expandicon").removeClass("expand");
    $(".expandicon").addClass("compress");
    $(".page-wrapper").css("margin-left", "200px");

    $(".left-sidebar").css("left", "0px");
    var left = $(".left-sidebar").css("left");
    if (left === "0px") {
      $(".page-wrapper").css("margin-left", "60px");
      $(".expandicon").addClass("expand");
      $(".expandicon").removeClass("compress");
      $(".left-sidebar").css("left", "");
    }
  });

  //Listing

  $(".en-click-list-pages").on("click");
})(jQuery);
