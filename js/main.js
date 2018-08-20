$(".buttonEditComment").click(function() {
      var commentBody = $(this).parent().parent();

       var cancelEditComment = commentBody.find(".cancelEditComment");
       cancelEditComment.show();

    var editButtonsBlock = commentBody.find(".editButtonsBlock");
    editButtonsBlock.hide();

      var commentText = commentBody.find(".textComment");
      commentText.hide();

      var commentEditor = commentBody.find(".commentUpdateArea");
      commentEditor.html(commentText.text());
      commentEditor.parent().show();
});
$(".cancelEditComment").click(function() {
    var commentBody = $(this).parent().parent();

    var cancelEditComment = commentBody.find(".cancelEditComment");
    cancelEditComment.hide();

    var editButtonsBlock = commentBody.find(".editButtonsBlock");
    editButtonsBlock.show();

    var commentText = commentBody.find(".textComment");
    commentText.show();

    var commentEditor = commentBody.find(".commentUpdateArea");
    commentEditor.parent().hide();
});
function validateValue(value, pattern) {
    value = value.val();
    var match = value.match(pattern);
    return match != null && value == match[0];
}

function validate(value, pattern, result, button, name) {
    result.text("");

    if (validateValue(value, pattern)) {
        button.removeAttr("disabled");
        value.removeClass("error");
        value.addClass("good");
        result.hide();
    } else {
        console.log("yuo are inavalid");
        if (name != "Password") {
            result.text(value.val() + " is not valid "+name+" :(");
        } else {
            result.text("The password must be at least 8 characters, must contain lowercase and uppercase letters and at least one digit.");
        }
        button.attr("disabled","disabled");
        value.addClass("error");
        value.removeClass("good");
        result.show();
    }
}
$("#inputEmail").change(function() {
    var result = $(".emailValidRes");
    var email = $("#inputEmail");
    var button = $(".btn-block");
    var pattern = /^[a-z\d]+@[a-z\d]+\.[a-z]{2,}$/i;
    var name = "EMail";
    validate(email, pattern, result, button, name);
});
$("#inputUsername").change(function() {
    var result = $(".emailValidRes");
    var email = $("#inputUsername");
    var button = $(".btn-block");
    var pattern = /[a-z][a-z\d]{0,15}/i;
    var name = "Username";
    validate(email, pattern, result, button, name);
});
$("#inputPassword").change(function() {
    var result = $(".passValidRes");
    var email = $("#inputPassword");
    var button = $(".btn-block");
    var pattern = /(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]+)/;
    var name = "Password";
    validate(email, pattern, result, button, name);
});
$('#repeatPassword, #repeatPassword').change(function() {
    var pass = $('#inputPassword');
    var passes = $(".pass");
    var confirmPass = $('#repeatPassword');
    var result = $(".passValidRes");
    var button = $(".btn-block");
    result.hide();

    if (pass.val() == confirmPass.val()) {
        button.removeAttr("disabled");
        passes.removeClass("error");
        passes.addClass("good");
    } else {
        result.text('Passwords do not match');
        button.attr("disabled","disabled");
        passes.addClass("error");
        passes.removeClass("good");
        result.show();
    }
});