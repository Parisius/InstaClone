// console.log('hello world');

////////////////////////////////
// make heart red and         //
// increase or decrease likes //
////////////////////////////////

// initiate a click event
$('.fa-heart').click(function() {
  // create variable to store parent of clicked heart icon
  var parent = $(this).parent('.likes');

  // create variable to store span that is child of parent element
  var countText = parent.find('span');

  // create variable to store integer version of text inside span
  var count = parseInt(countText.text());

  // toggle red class on heart icon
  $(this).toggleClass('red');

  // if icon has red class, add 1 to count total and display that on page
  if( $(this).hasClass('red') ) {
    count += 1;
    countText.text(' ' + count);
  // otherwise remove one from count total and display that info on page
  } else {
    count -= 1;
    countText.text(' ' + count);
  }
});
