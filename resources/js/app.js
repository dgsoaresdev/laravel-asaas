require('./bootstrap');

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