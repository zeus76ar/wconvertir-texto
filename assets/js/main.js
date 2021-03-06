// clase main
function codigoMain()
{
    this.id_campo_texto = '#texto';
    this.id_span_texto = '#stexto';
    this.id_campo_num = '#numero';
    this.id_span_num = '#snumero';

    this.validarFormTn = function() {
        var retorno = true, mensaje = '';

        mensaje = 'Ingresa el texto.';
        retorno = ovf.validarVacio(this.id_campo_texto, this.id_span_texto, mensaje);
        
        return retorno;
    }

    this.validarFormNt = function() {
        var retorno = true, mensaje = '';

        mensaje = 'Ingresa el numero.';
        retorno = ovf.validarVacio(this.id_campo_num, this.id_span_num, mensaje);

        return retorno;
    }
}

// main program
var ocm = new codigoMain(), ovf = new bsValidarForm();

// main
$(document).ready(function() {
    $('#texto').keyup(function() {
        $('#resultado_1').val('');
    });

    $('input.opcion').change(function() {
        $('#resultado_1').val('');
    });

    $('#numero').keyup(function() {
        $('#resultado_2').val('');
    });

    $('input.opcion_1').change(function() {
        $('#resultado_2').val('');
    });

    $('#bconvertirtn').click(function() {
        if (ocm.validarFormTn()) $('#frmtn').submit();
    });

    $('#bconvertirnt').click(function() {
        if (ocm.validarFormNt()) $('#frmnt').submit();
    });
});
