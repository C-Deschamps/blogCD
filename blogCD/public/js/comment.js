
var divFormu = document.getElementById("newComment");
divFormu.style.display = 'none';

function newComment(){

   if($('#newComment').css("display") == "block") {
      $('#newComment').css("display", "none");
   }
   else {
      $('#newComment').css("display", "block");
   }

}

function showMore(id) {
  var tagNameAll = '.all' + id;
  var tagNameDebut = '.debut' + id;
  if($(tagNameAll).css("display") == "block") {
      $(tagNameAll).css("display", "none");
      $(tagNameDebut).css("display", "block");
   }
   else {
      $(tagNameAll).css("display", "block");
      $(tagNameDebut).css("display", "none");
   }
}
function answerComment(){

   if($('#answerComment').css("display") == "block") {
      $('#answerComment').css("display", "none");

   }
   else {
      $('#answerComment').css("display", "block");
      $('#commentBtn').css("display", "none"); //On enlève le btn commenter
   }

}

$('#newComment').on('keyup',function()
{
   var maxlen = $(this).attr('maxlength');

  var length = $(this).val().length;
  var rest = maxlen - length;

  if(length > (maxlen-10) ){
    $('#textarea_message').text('Il vous reste '+ rest +' charactères !').css('color', 'red');
  }
  else if (length > maxlen-500)
    {
      $('#textarea_message').text(length + '/' + maxlen).css('color', 'black');
    }
  else {
    $('#textarea_message').text('2000 charactères maximum').css('color', 'black');
  }
});

$('#answer').on('keyup',function()
{
  var maxlen = $(this).attr('maxlength');
  var length = $(this).val().length;
  var rest = maxlen - length;

  if(length > (maxlen-10) ){
    $('#textarea_messag').text('Il vous reste '+ rest +' charactères !').css('color', 'red')
  }
  else if (length > maxlen-500)
    {
      $('#textarea_message').text(length + '/' + maxlen).css('color', 'black');
    }
  else {
    $('#textarea_message').text('2000 charactères maximum').css('color', 'black');
  }
});

//$(".card-text").css("width",$("composantBlanc").width() - 100 + "px") Permet de trouver la taille d'une box et d'adapter la box dedans
