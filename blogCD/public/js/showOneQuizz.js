
$('.sidebar-overlay').click(() => {
  $('.sidebar-wrapper').toggleClass('hide');
  $('.sidebar-overlay').toggleClass('hide');
  setTimeout(() => {
    $('.sidebar-overlay').toggleClass('none');
  }, 400);
});

$('#showNav').click(() => {
  $('.sidebar-wrapper').toggleClass('hide');
  $('.sidebar-overlay').toggleClass('none');
  setTimeout(() => {
    $('.sidebar-overlay').toggleClass('hide');
  }, 50);
});

$('#sidebar-allQst').click(() => {
  $('#sidebar-allQst').addClass('active'); //permet d'afficher les nav
  $('#sidebar-unansweredQst').removeClass('active');
  $('#sidebar-answerQst').removeClass('active');

  $('#allQst').removeClass('none');
  $('#answerQst').addClass('none');
  $('#unansweredQst').addClass('none');
});

$('#sidebar-unansweredQst').click(() => {
  $('#sidebar-unansweredQst').addClass('active');
  $('#sidebar-allQst').removeClass('active');
  $('#sidebar-answerQst').removeClass('active');

  $('#unansweredQst').removeClass('none');
  $('#answerQst').addClass('none');
  $('#allQst').addClass('none');

});

$('#sidebar-answerQst').click(() => {
  $('#sidebar-answerQst').addClass('active');
  $('#sidebar-allQst').removeClass('active');
  $('#sidebar-unansweredQst').removeClass('active');

  $('#answerQst').removeClass('none');
  $('#allQst').addClass('none');
  $('#unansweredQst').addClass('none');
});
