<?php
// constantes
define('TEXTO_LIM', 500);
define('NUM_DEC_LIM', 1500);
define('NUM_BIN_LIM', 4000);
define('NUM_OCT_LIM', 1500);
define('NUM_HEX_LIM', 1000);

// funciones
function mostrarVarPost($nomvar)
{
    // $nomavr: (string) nombre de la variable a mostrar

    $retorno = '';

    if (isset($_POST[$nomvar])) $retorno = $_POST[$nomvar];

    echo $retorno;
}

function seleccionarVarOption($nomvar, $valor)
{
    // $nomavr: (string) nombre del campo tipo option
    // $valor: (string) valor a comparar

    $retorno = '';

    if (isset($_POST[$nomvar]))
    {
        $retorno = (($_POST[$nomvar] == $valor)?'checked="1"':'');
    }
    else
    {
        // la variable post no existe, selecciono un valor por defecto
        $retorno = (($valor == 'd')?'checked="1"':'');
    }

    echo $retorno;
}

function validarTexto()
{
    $retorno = '';

    if ($_POST['texto'] === '')
    {
        $retorno = 'Ingrese el texto a convertir.';
    }
    elseif (mb_strlen($_POST['texto']) > constant('TEXTO_LIM'))
    {
        $retorno = 'El texto puede tener hasta ' . 
        constant('TEXTO_LIM') . ' caracteres.';
    }
    else
    {
        if ($_POST['sistema'] === '')
        {
            $retorno = 'Falta el sistema para convertir.';
        }
    }

    return $retorno;
}

function validarNumero()
{
    $retorno = '';

    if ($_POST['numero'] === '')
    {
        $retorno = 'Ingrese el numero a convertir.';
    }
    else
    {
        switch ($_POST['sistema_1'])
        {
            case 'd':
                if (mb_strlen($_POST['numero']) > constant('NUM_DEC_LIM'))
                {
                    $retorno = 'El numero puede tener hasta ' . 
                    constant('NUM_DEC_LIM') . ' digitos.';
                }
                break;
            case 'b':
                if (mb_strlen($_POST['numero']) > constant('NUM_BIN_LIM'))
                {
                    $retorno = 'El numero puede tener hasta ' . 
                    constant('NUM_BIN_LIM') . ' digitos.';
                }
                break;
            case 'o':
                if (mb_strlen($_POST['numero']) > constant('NUM_OCT_LIM'))
                {
                    $retorno = 'El numero puede tener hasta ' . 
                    constant('NUM_OCT_LIM') . ' digitos.';
                }
                break;
            case 'h':
                if (mb_strlen($_POST['numero']) > constant('NUM_HEX_LIM'))
                {
                    $retorno = 'El numero puede tener hasta ' . 
                    constant('NUM_HEX_LIM') . ' digitos.';
                }
                break;
            default:
                $retorno = 'Falta el sistema para convertir.';
                break;
        }
    }

    return $retorno;
}

// main
$otn = new Texto_Numero();

if (isset($_POST['texto']))
{
    $_POST['texto'] = trim($_POST['texto']);

    $error_1 = validarTexto();

    if ($error_1 === '')
    {
        $otn->setTexto($_POST['texto']);
        $otn->setSistema($_POST['sistema']);
        $otn->convertirTextoEnNumero();

        $error_1 = $otn->getError();

        if ($error_1 == '') $numero = $otn->getNumero();
    }
}

if (isset($_POST['numero']))
{
    $_POST['numero'] = trim($_POST['numero']);

    $error_2 = validarNumero();

    if ($error_2 === '')
    {
        $otn->setNumero($_POST['numero']);
        $otn->setSistema($_POST['sistema_1']);
        $otn->convertirNumeroEnTexto();
        
        $error_2 = $otn->getError();
        
        if ($error_2 == '') $texto = $otn->getTexto();
    }
}