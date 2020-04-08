/*
version: 18.05
subversion: 08
autor: Ariel Balmaceda
*/
// defino la 'clase'
function bsValidarForm(){
    this.campoError = function(id_campo, id_span, mensaje){
        $(id_campo).parent().removeClass('has-success');
        $(id_campo).parent().addClass('has-error');
        //$(id_campo).focus();

        $(id_span).html(mensaje);
        $(id_span).removeClass('hidden');
    }

    this.campoOk = function(id_campo, id_span){
        $(id_campo).parent().removeClass('has-error');
        $(id_campo).parent().addClass('has-success');
        
        $(id_span).html('');
        $(id_span).addClass('hidden');
    }

    this.campoReset = function(id_campo, id_span){
        $(id_campo).parent().removeClass('has-error');
        $(id_campo).parent().removeClass('has-success');
        
        $(id_span).html('');
        $(id_span).addClass('hidden');
    }

    this.validarVacio = function(id_campo, id_span, mensaje){
        var retorno = true, condicion = false;
        
        if (jQuery.trim(mensaje) == '')
        {
            mensaje = 'El campo no puede quedar vacio.';
        }

        condicion = (jQuery.trim($(id_campo).val()) == '');

        if (condicion)
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }
        else
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }

        return retorno;
    }

    this.validarUrl = function(id_campo, id_span, mensaje)
    {
        var retorno = true, condicion = false, url = $(id_campo).val();
        var pattern = /^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/;

        if (jQuery.trim(mensaje) == '')
        {
            mensaje = 'La URL ingresada no tiene un formato correcto.';
        }
        
        condicion = url.match(pattern);

        if (condicion)
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }
        else
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }

        return retorno;
    }
    
    this.validarNumEntero = function(id_campo, id_span, mensaje)
    {
        var retorno = true, condicion = false;
        
        condicion = isNaN(parseInt($(id_campo).val()));

        if (condicion)
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }
        else
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }

        return retorno;
    }
    
    this.validarNumDecEs = function(id_campo, id_span, mensaje)
    {
        var retorno = true, condicion = false;
        var numero = $(id_campo).val().replace('.', '');
        numero = numero.replace(',', '.');
        
        condicion = isNaN(parseFloat(numero));

        if (condicion)
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }
        else
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }

        return retorno;
    }
    
    this.validarNumMin = function(minimo, id_campo, id_span, mensaje)
    {
        /*
         * valida que el valor del campo sea mayor o igual a minimo 
        */
        
        var retorno = true, condicion = false;
        
        condicion = parseFloat($(id_campo).val()) >= minimo;

        if (condicion)
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }
        else
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }

        return retorno;
    }
    
    this.validarNumMax = function(maximo, id_campo, id_span, mensaje)
    {
        /*
         * valida que el valor del campo sea menor o igual a maximo
        */
        
        var retorno = true, condicion = false;
        
        condicion = parseFloat($(id_campo).val()) <= maximo;

        if (condicion)
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }
        else
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }

        return retorno;
    }
    
    this.validarFecha = function(id_campo, id_span)
    {
        var retorno = true, condicion = false, mensaje = '';
        
        //compruebo el formato
        var patt = /^[0-3]?[0-9][.\-/][0-1]?[0-9][.\-/][1-9]?[0-9]?[0-9][0-9]$/;
        condicion = patt.test($(id_campo).val());

        if (!condicion)
        {
            mensaje = 'El formato No es valido.'
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }
        else
        {
            // compruebo el valor
            var partes = $(id_campo).val().split('\/');
            var d = new Date(partes[2], ((partes[1] * 1) - 1), (partes[0] * 1));
            
            condicion = (d.getDate() == (partes[0] * 1)) && 
            ((d.getMonth() + 1) == (partes[1] * 1)) && (d.getFullYear() == (partes[2] * 1));
            
            if (!condicion)
            {
                mensaje = 'La Fecha No es valida.'
                retorno = false;
                this.campoError(id_campo, id_span, mensaje);
            }
            else
            {
                retorno = true;
                this.campoOk(id_campo, id_span);
            }
        }

        return retorno;
    }
    
    this.validarEmail = function(id_campo, id_span, mensaje)
    {
        var retorno = true, condicion = false, url = $(id_campo).val();
        var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (jQuery.trim(mensaje) == '')
        {
            mensaje = 'El Email ingresado no tiene un formato valido.';
        }
        
        condicion = url.match(pattern);

        if (condicion)
        {
            retorno = true;
            this.campoOk(id_campo, id_span);
        }
        else
        {
            retorno = false;
            this.campoError(id_campo, id_span, mensaje);
        }

        return retorno;
    }
}
