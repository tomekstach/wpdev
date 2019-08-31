jQuery(document).ready(function($) {

    $('#get-nip-1').click(function(e) {
        if (!ValidateNip($('#input-nip').val())) {
            if (!$('.numbernip .wpcf7-not-valid-tip').length) {
                $('.numbernip').append('<span role="alert" class="wpcf7-not-valid-tip">NIP jest niepoprawny!</span>');
            }
            return false;
        } else {
            $('.numbernip .wpcf7-not-valid-tip').remove();
        }

        $.ajax({
            url: 'https://www.wapro.pl/oferta/nip/check.php',
            type: "GET",
            data: { nip: $('#input-nip').val() }
        }).done(function(string) {
            var obj = JSON.parse(string);
            if (obj.code == 200) {
                $('#input-nazwa-firmy').val(obj.content.name);
                $('#input-firma-miasto').val(obj.content.city);
                $('.number-nip .wpcf7-not-valid-tip').remove();
                $('.textfirma .wpcf7-not-valid-tip').remove();
            } else {
                if (!$('.number-nip .wpcf7-not-valid-tip').length) {
                    $('.number-nip').append('<span role="alert" class="wpcf7-not-valid-tip">' + obj.content + '</span>');
                }
            }
        });
    });

    $('#dane-takie-same input').click(function(e) {

        if ($('#dane-takie-same input').prop('checked')) {
            $('#input-kontakt-imie').val($('#input-firma-imie').val());
            $('#input-kontakt-nazwisko').val($('#input-firma-nazwisko').val());
            $('#input-kontakt-telefon').val($('#input-firma-telefon').val());
            $('#input-kontakt-email').val($('#input-firma-email').val());
        }
    });
});

function ValidateNip(nip) {
    if (typeof nip !== 'string')
        return false;

    nip = nip.replace(/[\ \-]/gi, '');

    if (/^([0-9])\1{9}$/.test(nip)) {
        return false;
    }

    var weight = [6, 5, 7, 2, 3, 4, 5, 6, 7];
    var sum = 0;
    var controlNumber = parseInt(nip.substring(9, 10));
    for (let i = 0; i < weight.length; i++) {
        sum += (parseInt(nip.substring(i, i + 1)) * weight[i]);
    }

    return sum % 11 === controlNumber;
}