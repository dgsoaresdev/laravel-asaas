
   
//=================================
// Copy Text to Clipboard
//=================================

function copyTextToClipBoard(param1) {
    // Get the text field
    //var copyText = document.getElementById("ChavePix");
    var copyText = param1;
    // Select the text field
    // copyText.select();
    // copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);
    
    jQuery('#ButtonCopyTextToClipBoard').removeClass('blue').addClass('green').html('<i class="far fa-copy"></i> COPIADO!');
    
    // Alert the copied text
    //alert("Chave PIX Copiada: " + copyText);
}

//=================================
// Mask Fields
//=================================

   $(document).ready(function () { 
         
    var $vat_number = $("#cartao_numero");
    $vat_number.mask('0000 0000 0000 0000', {reverse: false});

    var $vat_number = $("#cartao_codigo");
    $vat_number.mask('0000', {reverse: false});

    var $vat_number = $("#cartao_cpf");
    $vat_number.mask('000.000.000-00', {reverse: false});

    var $vat_number = $("#telefone");
    $vat_number.mask('(00) 0000-0000', {reverse: false});

    var $vat_number = $("#mobilePhone");
    $vat_number.mask('(00) 00000-0000', {reverse: false});

    var $vat_number = $("#postalCode");
    $vat_number.mask('00.000-000', {reverse: false});

});

