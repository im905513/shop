
function show_loading()
{
  $("#blackBG").fadeIn();
  $(".windows8").animate({
    "top": $(document).scrollTop() + ($(window).height()/2) - 100,
    "left": "50%",
    "opacity":"1"
  },100);
}

function hide_loading()
{
  $("#blackBG").fadeOut();
  $(".windows8").animate({ "opacity":"0"},100);
}
