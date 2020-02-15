jQuery(document).ready(function($) {  // must use the JQuery instead of $. Once document is load, execute the code 
    var heart = $.getHeart(); // call GetHeart function to get number of hearts to display  
    $(".hearts").each(function(){ // select each .heart class and execute the function below
      for(var i = 0; i <= heart; i++) { // make a new heart for each value in heart variable 
         var size = ($.random(5,35)); // gets a random size for our heart that we will apply for both height and width 
         $(this).append('<span class="particle" style="top:' + $.random(-200,200) + '%; left:' + $.random(-50,190) + '%;width:' + size + 'px; height:' + size + 'px;animation-delay: ' + ($.random(0,15)) + 's;"></span>');
         // randomly position the heart at the top, left and sets a delay on when it should start doing the animation
      }})});



jQuery.random = function(min,max) { // creates the random numbers needed for the code above
   min = parseInt(min);
   max = parseInt(max);
   return Math.floor( Math.random() * (max - min + 1) ) + min;
}

jQuery.getHeart = function(){
    var heartInput = jQuery(".hearts").data("number-hearts"); // get the information from the HTML data attributes 
    var heart= heartInput.toUpperCase(); // changes the information to Uppercases

    switch (heart) { 
        case 'FEW': 
           var numberHearts = 15;
           break;
        case 'NORMAL': 
           var numberHearts = 40;
           break;
        case 'MANY': 
         var numberHearts = 70;
           break;
        default :
        var numberHearts = 70;  // sets the number based on value from the setting page 
  }
     return numberHearts; // returns the number
  }
