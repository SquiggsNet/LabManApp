$(document).on('click','.value-control',function(){
    var action = $(this).attr('data-action');
    var target = $(this).attr('data-target');
    var value  = parseFloat($('[id="'+target+'"]').val());
    if(isNaN(value)){
        value = 0;
    }
    if ( action == "plus" && value != 99 ) {
        value++;
    }
    if ( action == "minus" && value != 0) {
        value--;
    }
    $('[id="'+target+'"]').val(value)
});

$(document).ready(function () {

    //colony index create mouse source display

    if($("#source").val() == "1"){
        $("#selectCage").show();
    }
    else{
        $("#selectCage").hide();
    }
    $("#source").change(function() {
        if($("#source").val() == "1"){
            $("#selectCage").show();
        }
        else{
            $("#selectCage").hide();
        }
    });

    //mouse table untagged checkbox display options
    $(".untaggedInput").hide();
    $(".untaggedChk").click(function(){
        if (this.checked) {
            $("#new_tag_"+this.id).show();
            $("#sex_"+this.id).show();
        } else {
            $("#new_tag_"+this.id).hide();
            $("#sex_"+this.id).hide();
        }

    });

    //select Euthanize options
    $("#euthPurpose").hide();
    $("#euthExperiment").hide();
    $("#euthStorage").hide();
    $("#submit_euthanize").hide();
    $("#btn_euthanize").click(function(){
        $("#euthStorage").show();
    });
    $("#purpose").change(function() {
        if($("#purpose").val() == "1"){
            $("#euthStorage").hide();
            $("#euthExperiment").show();
            $("#submit_euthanize").hide();
        }
        else if($("#purpose").val() == "2"){
            $("#euthStorage").show();
            $("#euthExperiment").hide();
            $("#submit_euthanize").hide();
        }
        else if($("#purpose").val() == "3"){
            $("#euthExperiment").hide();
            $("#euthStorage").hide();
            $("#submit_euthanize").show();
        }else{
            $("#euthStorage").hide();
            $("#euthExperiment").hide();
            $("#submit_euthanize").hide();
        }

    });
    $("#experiment").change(function() {
        if($("#experiment").val() != "0"){
            $("#submit_euthanize").show();
        }else{
            $("#submit_euthanize").hide();
        }
    });
    $("#storage").change(function() {
        if($("#storage").val() != "0"){
            $("#submit_euthanize").show();
        }else{
            $("#submit_euthanize").hide();
        }
    });

    $(".euthStorage").hide();
    $(".submit_euthanize").hide();
    $(".btn_euthanize").click(function(){
        $("."+this.id).show();
    });
    $(".storage").change(function() {
        if(this.selectedIndex != "0"){
            $("."+this.id).show();
        }else{
            $("."+this.id).hide();
        }
    });

    //validation
    $("#quantity").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });

});


//    $('#createMice').on('submit', function() {
//        var id = $('#source').val();
//        var formAction = $('#createMice').attr('action');
//        $('#createMice').attr('action', formAction + id);
//    });

/*CREATE BREEDER CAGE*/

//event to get drop-down Female one box change
function checkFemaleOne(){
    var ddl_one = document.getElementById('female_one');
    var ddl_two = document.getElementById('female_two');
    var ddl_three = document.getElementById('female_three');

    //get value of female_one
    var f_one = $('#female_one').val();

    //reset 2nd and 3rd indexes if it matches new selection
    if(f_one == $('#female_two').val()) {
        ddl_two.selectedIndex = 0;

    }
    if(f_one == $('#female_three').val()) {
        ddl_three.selectedIndex = 0;
    }

    //return all values visible in second ddl if any have been hidden
    for(var i = 0; i < ddl_two.options.length; i++) {
        ddl_two.options[i].style.display = "block";
    }

    //reset all values visible in third ddl if any have been hidden and don't match second selected
    for(var i = 0; i < ddl_three.options.length; i++) {
        if ($('#female_two').val() != ddl_two.options[i].value) {
            ddl_three.options[i].style.display = "block";
        }
    }

    //remove this value from the second drop down
    for(var i = 0; i < ddl_two.options.length; i++){
        if(f_one != 0) {
            if (ddl_two.options[i].value == f_one) {
                ddl_two.options[i].style.display = "none";
                ddl_three.options[i].style.display = "none";
                ddl_two.disabled = false;
            }
        }else{//Reset and disable the 2nd and 3rd drop downs if 1st de-selected
            ddl_two.options[i].style.display = "block";
            ddl_three.options[i].style.display = "block";
            ddl_two.selectedIndex = 0;
            ddl_three.selectedIndex = 0;
            ddl_two.disabled = true;
            ddl_three.disabled = true;
        }
    }
}

function checkFemaleTwo(){
    var ddl_three = document.getElementById('female_three');

    //get value of female_two
    var f_two = $('#female_two').val();
    var f_one = $('#female_one').val();

    //return all values visible if any have been hidden
    for(var i = 0; i < ddl_three.options.length; i++) {
        ddl_three.options[i].style.display = "block";
    }

    //reset 3rd value if it matches new selection
    if(f_two == $('#female_three').val()) {
        ddl_three.selectedIndex = 0;
    }

    //remove this option from the 3rd drop down
    for(var i = 0; i < ddl_three.options.length; i++){
        if(f_two != 0) {
            if (ddl_three.options[i].value == f_two || ddl_three.options[i].value == f_one) {
                ddl_three.options[i].style.display = "none";
                ddl_three.disabled = false;
            }
        }else{//Reset and disable the 2nd and 3rd drop downs if 1st de-selected
            ddl_three.options[i].style.display = "block";
            ddl_three.selectedIndex = 0;
            ddl_three.disabled = true;
        }
    }
}

//Confirm removal of mouse from surgery.
function confirmRemove()
{
    return confirm("Remove mouse from this surgery?");
}

/*CONFIRMATION OF DELETE USING ALERT*/
//function is used, not recognised due to laravel FORM annotation.
function confirmDelete()
{
    return confirm("Are you sure you want to delete?");
}

//edit user reset password
var cb_reset = document.getElementById('reset_password');
function hide_password() {
    if(cb_reset != null) {
        if (cb_reset.checked) {
            $("#password").show();
            $("#password_label").show();
        } else {
            $("#password").hide();
            $("#password_label").hide();
        }
    }
}

function lock_out(){
    if($('#cage_id').val() != 0 && $('#source').val() != 0 || $('#source').val() == 2){
        $('#create_mice_btn').prop('disabled', false);
    }else{
        $('#create_mice_btn').prop('disabled', true);
    }
}

$('#cage_id').change(function(){
    lock_out();

});

$('#source').change(function() {
    lock_out();
});
window.onload = function(){
    hide_password();
    lock_out();
};

//Handling the lockout of buttons for untagged mice
var btn_submit_tag = document.getElementById('submit_tag');
var btn_submit_sex = document.getElementById('submit_sex');
var btn_clear_sex = document.getElementById('clear_sex');
var btn_submit_remove = document.getElementById('submit_remove');
var new_tag_array = document.getElementsByName('new_tag_id[]');
var remove_cbk_array = document.getElementsByName('group_select_untagged_cb[]');

function checkTag() {

    var tag_num = [];
    var duplicate = [];

    //place each new_tag_input into one array
    for (var i = 0; i < new_tag_array.length; i++) {
        tag_num.push(new_tag_array[i].value);
    }

    //check new tag values against duplicates in themselves
    var new_tag_check = tag_num;
    for (var t = 0; t < tag_num.length ; t++){
        for( var x = 0; x < new_tag_check.length; x++){
            if(x != t) {
                if (new_tag_check[x] == tag_num[t] && tag_num[t] != "") {
                    new_tag_array[t].style.backgroundColor = "yellow";
                    duplicate.push(t);
                    btn_submit_tag.disabled = true;
                }
            }
        }
    }

    //if no duplicates ensure button is enabled
    if (duplicate.length < 1) {
        btn_submit_tag.disabled = false;
        for (var y = 0; y < tag_num.length ; y++) {
            new_tag_array[y].style.backgroundColor = "white";
        }
    }

    //if any inputs hold value, disable submit for sex and delete
    var tag_str = parseFloat((tag_num.join()).replace(/,/g, ''));
    if (isNaN(tag_str)) {
        btn_submit_sex.disabled = false;
        btn_submit_remove.disabled = false;
        btn_clear_sex.disabled = false;
        $(".btn-group label").attr("disabled", false);
        $("[name='group_select_untagged_cb[]']").attr('disabled', false);
    } else {
        $(".btn-group label").attr("disabled", true);
        btn_submit_sex.disabled = true;
        btn_submit_remove.disabled = true;
        btn_clear_sex.disabled = true;
        $("[name='group_select_untagged_cb[]']").attr('disabled', true);
    }
}


document.on('change', '[type=input]', function (e) {
    alert('This is the ' + $(this).index('[type=input]') + ' checkbox');
});

function checkRemove() {
    var total_cbks = $('.untaggedChk').length;
    var remove_array = [];

    for (var i = 0; i < total_cbks; i++) {
        if (remove_cbk_array[i].checked) {
            remove_array.push(i);
        }
    }
    //check boxes not selected enable other form elements
    if (remove_array.length < 1) {
        btn_submit_sex.disabled = false;
        btn_submit_tag.disabled = false;
        btn_clear_sex.disabled = false;
        $(".btn-group label").attr("disabled", false);
        $("[name='new_tag_id[]']").attr('readOnly', false);
    } else { //check boxes selected, disable and clear other form elements
        btn_submit_sex.disabled = true;
        btn_submit_tag.disabled = true;
        btn_clear_sex.disabled = true;
        $(".btn-group label").attr("disabled", true);
        $(".btn-group label").removeClass('active').end()
            .find('[type="radio"]').prop('checked', false);
        $("[name='new_tag_id[]']").val('');
        $("[name='new_tag_id[]']").attr('readOnly', true);
    }
}

function checkSex(){
    //determine if any checkbox is checked
    if(($(".btn-group label").find('[type="radio"]')).length > 0){
        //disable other form controls
        $("[name='new_tag_id[]']").attr('readOnly', true);
        $("[name='group_select_untagged_cb[]']").attr('disabled', true);
        btn_submit_tag.disabled = true;
        btn_submit_remove.disabled = true;
    }else{//enable other form controls when no radio checked
        $("[name='new_tag_id[]']").attr('readOnly', false);
        $("[name='group_select_untagged_cb[]']").attr('disabled', false);
        $(".btn-group label").find('[type="radio"]').data('waschecked', false);
        $(".btn-group label").find('[type="radio"]').prop('checked', false);
        btn_submit_tag.disabled = false;
        btn_submit_remove.disabled = false;
    }
}

//clear the sex option if one or more have been clicked
function clearSex(){
    $(".btn-group label").removeClass('active').end()
        .find('[type="radio"]').prop('checked', false);
    $("[name='new_tag_id[]']").attr('readOnly', false);
    $("[name='group_select_untagged_cb[]']").attr('disabled', false);
    btn_submit_tag.disabled = false;
    btn_submit_remove.disabled = false;
}

