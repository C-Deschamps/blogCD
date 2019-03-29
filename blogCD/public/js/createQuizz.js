
document.getElementsByName('numberQt')[0].onchange = function() {
 var nbrQt = this.value;
 var nbrTwo = nbrQt;
 nbrTwo ++;


 for (var j = nbrTwo; j <= 40; j++) {

   document.getElementById('question' + j).style.display = 'none';

}
for (var i = 1; i <= nbrQt; i++) {

   document.getElementById('question' + i).style.display = 'block';

document.getElementById(i + 'isPicture').onclick = function() { // Permet de gérer l'afichage ou non de la récurrence de l'événement
if (this.checked) {
   var name = this.name; //on recupère le nom qui contient l'id de la question

   var j = parseInt(name); // on extraid l'id

   document.getElementById('picture' + j).style.display = 'block';
}
else {
   var name = this.name;

   var j = parseInt(name);
   document.getElementById('picture' + j).style.display = 'none';
}
}

document.getElementById(i + 'typeQt').onchange = function() {
   var choix = this.value;
   var name = this.name;
   var j = parseInt(name);

   if (choix == 'QCM'){
      document.getElementById('simple' + j).style.display = 'none';
      document.getElementById('qcm' + j).style.display = 'block';
      document.getElementById('bool' + j).style.display = 'none';
   }
   else if (choix == 'Bool') {
      document.getElementById('simple' + j).style.display = 'none';
      document.getElementById('qcm' + j).style.display = 'none';
      document.getElementById('bool' + j).style.display = 'block';
   }
   else {
      document.getElementById('simple' + j).style.display = 'block';
      document.getElementById('qcm' + j).style.display = 'none';
      document.getElementById('bool' + j).style.display = 'none';
   }
}
document.getElementById(i + 'numberAnswer').onchange = function() {
   var nbrAnswer = this.value;
   var nbrPlus = nbrAnswer;
   nbrPlus ++;
   var name = this.name;

   var j = parseInt(name);

   for (var k = nbrPlus ; k <= 8; k++) {
      document.getElementById('qcmAnswer' + j + k).style.display = 'none';
   }

   for (var k = 1 ; k <= nbrAnswer; k++) {

      document.getElementById('qcmAnswer' + j + k).style.display = 'block';
   }

// fonction qui determine le max de reponses possible en fonction des possibilité
var rep2 = document.getElementById(j + 'numberRightAnswer');
rep2.setAttribute("max", nbrAnswer);

for (var l= 1; l<=8; l++) {

   p = document.getElementById(j + 'answerRightQcm' + l);

  p.setAttribute("max", nbrAnswer);
}

}

document.getElementById(i + 'numberRightAnswer').onchange = function() {
   var nbrAnswer = this.value;
   var nbrPlus = nbrAnswer;
   nbrPlus ++;
   var name = this.name;

   var j = parseInt(name);

   for (var k = nbrPlus ; k <= 8; k++) {
      document.getElementById('qcmRightAnswer' + j + k).style.display = 'none';
   }

   for (var k = 1 ; k <= nbrAnswer; k++) {

      document.getElementById('qcmRightAnswer' + j + k).style.display = 'block';
   }
}

}}
