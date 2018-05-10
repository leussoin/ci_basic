<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Verifie si les variables envoyées en paramêtre sont vide
 * @return bool
 */
function mempty()
{
    foreach( func_get_args() as $arg )
    {
        if( !empty($arg) )
        {
            return FALSE;
        }
    }

    return TRUE;
}