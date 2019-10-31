jQuery(document).ready(function($) {

  $('.multistep-cf7-next').click(function(e) {
    if ($('#rodo-e-mail').val() == '' && $('#zgoda-rodo').prop("checked") == true) {
      $('#rodo-e-mail').val($('#input-firma-email').val());
    }
  });

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
      url: 'https://wpdev.wapro.pl/nip/checknip.php',
      type: "GET",
      data: {
        nip: $('#input-nip').val()
      }
    }).done(function(string) {
      var obj = JSON.parse(string);
      if (obj.code == 200) {
        console.log(obj.content.DPAgreementGetData);

        $('#input-nazwa-firmy').val(obj.content.name);
        $('#input-firma-miasto').val(obj.content.city);
        $('#input-firma-kod-pocztowy').val(obj.content.postCode);
        $('#input-firma-ulica').val(obj.content.address);
        $('#input-firma-imie').val(obj.content.firstname);
        $('#input-firma-nazwisko').val(obj.content.lastname);
        $('.NIP .wpcf7-not-valid-tip').remove();
        $('.firma .wpcf7-not-valid-tip').remove();
        $('.firma-miasto .wpcf7-not-valid-tip').remove();
        $('.firma-kod-pocztowy .wpcf7-not-valid-tip').remove();
        $('.firma-ulica .wpcf7-not-valid-tip').remove();
        $('.firma-imie .wpcf7-not-valid-tip').remove();
        $('.firma-nazwisko .wpcf7-not-valid-tip').remove();
        if (obj.DPAgreementGetData.ArrayDPAgreementGetResult.Status == 1) {
          alert("RODO!!!");
          console.log(obj.DPAgreementGetData.ArrayDPAgreementGetResult);

          //$('#data-umowy').val('ustawić datę z ERP-a');
          //$('#rodo-rodzaj').val('ustawić rodzaj umowcowania z ERP-a');
          $('#zgoda-rodo').prop('checked', true);
          $('#rodo-name').val($('#input-firma-imie').val() + ' ' + $('#input-firma-nazwisko').val());
        }
      } else {
        if (!$('.NIP .wpcf7-not-valid-tip').length) {
          $('.NIP').append('<span role="alert" class="wpcf7-not-valid-tip">' + obj.content + '</span>');
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

/*function soap(nip) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('POST', 'https://mcl.assecobs.pl/ERP_Service/services_integration_api/ApiWebService.ashx?wsdl&dbc=ABS_TEST', true);

  // build SOAP request
  var sr =
    '<?xml version="1.0" encoding="utf-8"?>' +
    '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ass="http://www.assecobs.pl">' +
    '<soapenv:Header />' +
    '<soapenv:Body>' +
    '<ass:DPAGREEMENTGET>' +
    '<ass:ArrayDPAgreementGetData>' +
    '<ass:DPAgreementGetData>' +
    '<ass:NIPSameCyfry>' + nip + '</ass:NIPSameCyfry>' +
    '</ass:DPAgreementGetData>' +
    '</ass:ArrayDPAgreementGetData>' +
    '</ass:DPAGREEMENTGET>' +
    '</soapenv:Body>' +
    '</soapenv:Envelope>';

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
          console.log(xmlhttp.responseText);
        }
      }
    }
    // Send the POST request
  xmlhttp.setRequestHeader('Content-Type', 'text/xml');
  xmlhttp.send(sr);
}*/