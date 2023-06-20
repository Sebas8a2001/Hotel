//MASCARAS PARA LOS INPUT TEXT
$(document).ready(function() {
    $(".pho-inputmask").mask("99 (9999) 9999999");
    $(".phone-inputmask").mask("(9999) 9999999");
    $(".date-inputmask").mask("99-99-9999"); 
    $(".time-inputmask").mask("99:99"); 
    //$(".phone-inputmask").mask("(999) 999-9999");
    $(".international-inputmask").mask("+9(999)999-9999"); 
    $(".xphone-inputmask").mask("(999) 999-9999 / x999999"); 
    $(".purchase-inputmask").mask("aaaa 9999-****"); 
    $(".cc-inputmask").mask("9999 9999 9999 9999"); 
    $(".ssn-inputmask").mask("999-99-9999"); 
    $(".isbn-inputmask").mask("999-99-999-9999-9");  
    $(".expira-inputmask").mask("99/99");
    $(".fecha-inputmask").mask("99-99-9999");
    $(".cvc-inputmask").mask("9999");
    $(".currency-inputmask").mask("$9999"); 
    $(".percentage-inputmask").mask("99%"); 
    $(".decimal-inputmask").mask({
        alias: "decimal"
        , radixPoint: "."
    });
});