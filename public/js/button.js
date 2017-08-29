/**
 * Created by inet2005 on 1/30/17.
 */
$(document).on('click','.value-control',function(){
    var action = $(this).attr('data-action')
    var target = $(this).attr('data-target')
    var value  = parseFloat($('[id="'+target+'"]').val());
    if ( action == "plus" ) {
        value++;
    }
    if ( action == "minus" ) {
        value--;
    }
    $('[id="'+target+'"]').val(value)
})