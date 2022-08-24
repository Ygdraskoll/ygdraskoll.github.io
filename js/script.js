$(function () {

    $("#contact-form").submit(function (e) {
        e.preventDefault();
        $('.erreur').empty();
        var postdata = $('#contact-form').serialize();
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {
                if (result.validate) {
                    $('#contact-form').append("<p id='thank-you' >Votre message m'a bien été envoyer, merci de m'avoir contacté.</p>");
                    setTimeout(function ()
                                { document.getElementById("thank-you").style.display = "none"; }, 4000);
                    $('#contact-form')[0].reset();
                }
                else {
                    $("#prenom + .erreur").html(result.firstnameError);
                    $("#nom + .erreur").html(result.nameError);
                    $("#email + .erreur").html(result.emailError);
                    $("#telephone + .erreur").html(result.phoneError);
                    $("#message + .erreur").html(result.messageError);
                }
            }
        });
    });
});

function Reset() {
    const element = document.getElementById('thank-you');
element.remove();
}