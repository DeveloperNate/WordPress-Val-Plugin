jQuery(document).ready(function($) {  // must use the JQuery instead of $. Once document is load, execute the code 
    var heart = $.getHeart(); // call GetHeart function to get number of hearts to display  

})

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
