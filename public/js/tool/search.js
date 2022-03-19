$(function(){

    $('.boxSelectObject').click(function() {
        $('.actionSelectedObjects a').toggleClass('disabled')

    })

    $('.boxSelectObject').click(function() {
        if (!this.checked) {
            $('.actionSelectedObjects a').toggleClass('disabled')
        }
    })

})//JQuery