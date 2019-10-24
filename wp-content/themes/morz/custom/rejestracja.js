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
      url: 'https://partnerzy.wpdev.wapro.pl/nip/checknip.php',
      type: "GET",
      data: {
        nip: $('#input-nip').val()
      }
    }).done(function(string) {
      var obj = JSON.parse(string);
      if (obj.code == 200) {
        $('#input-nazwa-firmy').val(obj.content.name);
        $('#input-miasto').val(obj.content.city);
        $('#input-adres').val(obj.content.address);
        $('#input-kod-pocztowy').val(obj.content.postCode);
        if (obj.content.firstname && obj.content.lastname) {
          $('#input-wlasciciel').val(obj.content.firstname + ' ' + obj.content.lastname);
        }
        $('#select-wojewodztwo option[value="' + obj.content.state.toLowerCase() + '"]').prop('selected', true);
        $('.your-nip-register .wpcf7-not-valid-tip').remove();
        $('.wlasciciel .wpcf7-not-valid-tip').remove();
        $('.your-company .wpcf7-not-valid-tip').remove();
        $('.your-adres .wpcf7-not-valid-tip').remove();
        $('.your-code .wpcf7-not-valid-tip').remove();
        $('.your-city .wpcf7-not-valid-tip').remove();
        $('.wojewodztwo .wpcf7-not-valid-tip').remove();
      } else {
        if (!$('.number-nip .wpcf7-not-valid-tip').length) {
          $('.number-nip').append('<span role="alert" class="wpcf7-not-valid-tip">' + obj.content + '</span>');
        }
      }
    });
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