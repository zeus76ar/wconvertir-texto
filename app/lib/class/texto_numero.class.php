<?php
/*
version: 18.08.21
Autor: Ariel Balmaceda.
Compatible con PHP 5
*/

class Texto_Numero
{
    // propiedades

    protected $texto; // (string)
    protected $numero; // (string)
    protected $sistema; // (string)
    protected $error; // (string)

    // constructor

    function __construct(){
        $this->texto = '';
        $this->numero = '';
        $this->sistema = '';
        $this->error = '';
    }
    
    // metodos privados
    
    protected function _validarTexto()
    {
        $this->error = '';

        if (mb_strlen($this->texto) < 1)
        {
            $this->error = 'El texto esta vacio.';
        }
    }

    protected function _validarNumVacio()
    {
        $this->error = '';

        if (mb_strlen($this->numero) < 1)
        {
            $this->error = 'El numero es vacio.';
        }
    }

    protected function _validarNumHexa()
    {
        $this->_validarNumVacio();

        if ($this->error == '')
        {
            $limite = mb_strlen($this->numero);
            $letras_permitidas = 'ABCDEF';

            for ($i = 0; $i < $limite; $i++)
            {
                $condicion = (is_numeric(substr($this->numero, $i, 1)));

                if (! $condicion)
                {
                    $condicion = 
                    (stripos($letras_permitidas, substr($this->numero, $i, 1)) === false);

                    if ($condicion)
                    {
                        $this->error = 'El numero no es hexadecimal.';
                        break;
                    }
                }
            }
        }
    }

    protected function _validarNumOctal()
    {
        $this->_validarNumVacio();

        if ($this->error == '')
        {
            $limite = mb_strlen($this->numero);

            for ($i = 0; $i < $limite; $i++)
            {
                $condicion = (! is_numeric(substr($this->numero, $i, 1))) || 
                (substr($this->numero, $i, 1) > 7);

                if ($condicion)
                {
                    $this->error = 'El numero no es octal.';
                    break;
                }
            }
        }
    }

    protected function _validarNumBinario()
    {
        $this->_validarNumVacio();

        if ($this->error == '')
        {
            $limite = mb_strlen($this->numero);

            for ($i = 0; $i < $limite; $i++)
            {
                $condicion = (! is_numeric(substr($this->numero, $i, 1))) || 
                (substr($this->numero, $i, 1) > 1);

                if ($condicion)
                {
                    $this->error = 'El numero no es binario.';
                    break;
                }
            }
        }
    }

    protected function _validarNumDecimal()
    {
        $this->_validarNumVacio();

        if ($this->error == '')
        {
            $limite = mb_strlen($this->numero);

            for ($i = 0; $i < $limite; $i++)
            {
                $condicion = (is_numeric(substr($this->numero, $i, 1)));

                if (! $condicion)
                {
                    $this->error = 'El numero no es decimal.';
                    break;
                }
            }
        }
    }

    // metodos publicos

    public function getError()
    {
        return $this->error;
    }

    public function setTexto($texto)
    {
        $this->texto = trim($texto);
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setNumero($numero)
    {
        $this->numero = str_replace(' ', '', trim($numero));
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setSistema($sistema)
    {
        $this->sistema = $sistema;
    }

    public function getSistema()
    {
        return $this->sistema;
    }

    public function convertirTextoEnNumero() 
    {
        $this->_validarTexto();

        if ($this->error !== '') return;

        $numero_d = array();
        $limite = mb_strlen($this->texto);
        
        for ($i = 0; $i < $limite; $i++)
        {
            $numero_d[$i] = ord(substr($this->texto, $i, 1));
            $numero_d[$i] = str_pad($numero_d[$i], 3, '0', STR_PAD_LEFT);
        }
        
        $this->numero = implode('', $numero_d);
        $limite = count($numero_d);

        switch ($this->sistema)
        {
            case 'd':
                break;
            case 'b':
                $numero_b = array();

                for ($i = 0; $i < $limite; $i++)
                {
                    $numero_b[$i] = decbin($numero_d[$i]);
                    $numero_b[$i] = str_pad($numero_b[$i], 8, '0', STR_PAD_LEFT);
                }

                $this->numero = implode('', $numero_b);
                break;
            case 'o':
                $numero_o = array();

                for ($i = 0; $i < $limite; $i++)
                {
                    $numero_o[$i] = decoct($numero_d[$i]);
                    $numero_o[$i] = str_pad($numero_o[$i], 3, '0', STR_PAD_LEFT);
                }

                $this->numero = implode('', $numero_o);
                break;
            case 'h':
                $numero_h = array();

                for ($i = 0; $i < $limite; $i++)
                {
                    $numero_h[$i] = dechex($numero_d[$i]);
                    $numero_h[$i] = str_pad($numero_h[$i], 2, '0', STR_PAD_LEFT);
                }

                $this->numero = implode('', $numero_h);
                break;
            default:
                $this->error = 'El sistema ' . $this->sistema . 
                ' elegido es incorrecto';
        }
    }

    public function convertirHexaEnTexto()
    {
        $this->_validarNumHexa();

        if ($this->error == '')
        {
            $numeros = str_split($this->numero, 2);
            $limite = count($numeros);

            for ($i = 0; $i < $limite; $i++)
            {
                $this->texto .= chr(base_convert($numeros[$i], 16, 10));
            }
        }
    }

    public function convertirOctEnTexto()
    {
        $this->_validarNumOctal();

        if ($this->error == '')
        {
            $numeros = str_split($this->numero, 3);
            $limite = count($numeros);

            for ($i = 0; $i < $limite; $i++)
            {
                $this->texto .= chr(base_convert($numeros[$i], 8, 10));
            }
        }
    }

    public function convertirBinEnTexto()
    {
        $this->_validarNumBinario();

        if ($this->error == '')
        {
            $numeros = str_split($this->numero, 8);
            $limite = count($numeros);

            for ($i = 0; $i < $limite; $i++)
            {
                $this->texto .= chr(bindec($numeros[$i]));
            }
        }
    }

    public function convertirDecEnTexto()
    {
        $this->_validarNumDecimal();

        if ($this->error == '')
        {
            //$numeros = explode("\n", 
            //chunk_split(str_replace("\n", '', $this->numero), 7));
            $numeros = str_split($this->numero, 3);
            $limite = count($numeros);

            for ($i = 0; $i < $limite; $i++)
            {
                $this->texto .= chr($numeros[$i]);
            }
        }
    }

    public function convertirNumeroEnTexto()
    {
        switch ($this->sistema)
        {
            case 'd':
                $this->convertirDecEnTexto();
                break;
            case 'b':
                $this->convertirBinEnTexto();
                break;
            case 'o':
                $this->convertirOctEnTexto();
                break;
            case 'h':
                $this->convertirHexaEnTexto();
                break;
            default:
                $this->error = 'El sistema ' . $this->sistema . 
                ' elegido es incorrecto';
        }
    }
}//fin clase