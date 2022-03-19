$(function(){

   $('.dropend').hover(function() {
        $('#content').toggleClass('overlay_page');
   })
    $('.login_dropdown .dropdown-menu').hover(function() {
        $('#content').toggleClass('overlay_page');
    })
    // Barre de triage des items fixé au top lors d'un scroll vers le bas
    $('#content').scroll(function() {
        if($('#content').scrollTop() != 0) {
            //l'utilisateur n'est pas en haut du contenu de la page
            $('.sort_item_toolbar').addClass('sort_item_toolbar_top');
        } else {
            // l'user est en haut de la page
            $('.sort_item_toolbar').removeClass('sort_item_toolbar_top');
        }
    });





 })//JQuery