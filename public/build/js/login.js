$('.message a').click(function () {
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$('.register-form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: '/register',
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {
            username : $('#register-username').val(),
            password : $('#register-password').val(),
            email : $('#register-email').val()
        },

        success: function () {
          alert('You can now log in.');
        },
        error: function (xhr, textStatus, errorThrown) {
            alert('Ajax request failed.');
        }
    });
});