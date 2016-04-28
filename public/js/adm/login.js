$(document).ready(function(){

    $('#vcodeImg').click(function(){
        var $this = $(this);
        $this.attr('src', ($this.attr('src')+'1'));
    });

});