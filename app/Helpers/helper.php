<?php

// include composer autoload
require __DIR__.'/../../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;


if (!function_exists('human_file_size')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function human_file_size($bytes, $decimals = 2)
    {
        $sz = 'BKMGTPE';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sz[$factor];

    }
}

if (!function_exists('in_arrayi')) {

    /**
     * Checks if a value exists in an array in a case-insensitive manner
     *
     * @param mixed $needle
     * The searched value
     *
     * @param $haystack
     * The array
     *
     * @param bool $strict [optional]
     * If set to true type of needle will also be matched
     *
     * @return bool true if needle is found in the array,
     * false otherwise
     */
    function in_arrayi($needle, $haystack, $strict = false)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), $strict);
    }
}

if(!function_exists('extractDate')){

    function extractDate($dateTime) {

        if (isset($dateTime)) {

            date_default_timezone_set("America/Sao_Paulo");

            $dataNow = substr($dateTime, 0, 10);
            $data = explode('-', $dataNow);
            $data = $data[2] . '/' . $data[1] . '/' . $data[0];
            return $data;
        } else {
            return false;
        }
    }
}

if(!function_exists('extrateHour')){


    function extrateHour($dateTime, $secunts = false) {
        date_default_timezone_set("America/Sao_Paulo");

        $hora = substr($dateTime, 11, 8);
        return $hora;
    }

}

if(!function_exists('stringTo')){


    function stringTo($string) {


        $string = preg_replace(
            array(
        //Maiúsculos
                '/\xc3[\x80-\x85]/',
                '/\xc3\x87/',
                '/\xc3[\x88-\x8b]/',
                '/\xc3[\x8c-\x8f]/',
                '/\xc3([\x92-\x96]|\x98)/',
                '/\xc3[\x99-\x9c]/',
        //Minúsculos
                '/\xc3[\xa0-\xa5]/',
                '/\xc3\xa7/',
                '/\xc3[\xa8-\xab]/',
                '/\xc3[\xac-\xaf]/',
                '/\xc3([\xb2-\xb6]|\xb8)/',
                '/\xc3[\xb9-\xbc]/',
            ), str_split('ACEIOUaceiou', 1), is_utf8($string) ? $string : utf8_encode($string)
        );
        $string = strtolower($string);

        $what = array('(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '>', '<', 'ª', 'º', '“', '”');
        $by = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

        $string = str_replace($what, $by, $string);

        $string = str_replace(" ", "-", $string);

        return $string;
    }
}

if(!function_exists('criptBySystem')){
    function criptBySystem( $string, $action = 'e' ) {


	#EMPRCPT
	//$encrypted = criptBySystem( 'Hello World!', 'e' );
	#DECRIPT
	//$decrypted = criptBySystem( 'RTlOMytOZStXdjdHbDZtamNDWFpGdz09', 'd' );

    // you may change these values to your own
        $secret_key = 'IOF-1441';
        $secret_iv = '-EDONIH';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }
}

function dateGetExtencer($date){

    $days = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
    $daysnumber = date('w', strtotime($date));
    $date = explode('-', $date);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];

    switch ($month){
        case 1: $month = "Janeiro"; break;
        case 2: $month = "Fevereiro"; break;
        case 3: $month = "Março"; break;
        case 4: $month = "Abril"; break;
        case 5: $month = "Maio"; break;
        case 6: $month = "Junho"; break;
        case 7: $month = "Julho"; break;
        case 8: $month = "Agosto"; break;
        case 9: $month = "Setembro"; break;
        case 10: $month = "Outubro"; break;
        case 11: $month = "Novembro"; break;
        case 12: $month = "Dezembro"; break;
    }

    return $days[$daysnumber].", dia " . $day . " de ". $month;
}

function getTimeLast($time){
    $now = strtotime(date('m/d/Y H:i:s'));
    $time = strtotime($time);
    $diff = $now - $time;

    $seconds = $diff;
    $minutes = round($diff / 60);
    $hours = round($diff / 3600);
    $days = round($diff / 86400);
    $weeks = round($diff / 604800);
    $months = round($diff / 2419200);
    $years = round($diff / 29030400);

    if ($seconds <= 60) return"1 min";
    else if ($minutes <= 60) return $minutes==1 ?'1 min':$minutes.' min';
    else if ($hours <= 24) return $hours==1 ?'1 hora':$hours.' horas';
    else if ($days <= 7) return $days==1 ?'1 dia':$days.' dias';
    else if ($weeks <= 4) return $weeks==1 ?'1 semana':$weeks.' semanas';
    else if ($months <= 12) return $months == 1 ?'1 mês':$months.' meses';
    else return $years == 1 ? 'um ano':$years.' anos';
}


function percentage($result, $count)
{
    $problem = (($result / $count) * 100);
    return  $problem;
}

if (!function_exists('policiesAgent')) {

    function policiesAgent($modulo, $modules)
    {
        $modules = explode(':', $modules);

        foreach ($modules as $key => $value) {
            if($value == $modulo){
                return true;
            }
        }

    }

}

if(!function_exists('getMonth')){
    function getMonth($data){

        switch ($data){
            case "01": $month = "Janeiro"; break;
            case "02": $month = "Fevereiro"; break;
            case "03": $month = "Março"; break;
            case "04": $month = "Abril"; break;
            case "05": $month = "Maio"; break;
            case "06": $month = "Junho"; break;
            case "07": $month = "Julho"; break;
            case "08": $month = "Agosto"; break;
            case "09": $month = "Setembro"; break;
            case "10": $month = "Outubro"; break;
            case "11": $month = "Novembro"; break;
            case "12": $month = "Dezembro"; break;
        }

        return $month;
    }
}


if(!function_exists('getName')){
    function getName($string){
        $reabitt = explode(' ', $string);
        return array_shift($reabitt);
    }
}


if(!function_exists('anti_sql_injection')){

  function anti_sql_injection($sql) {
    $seg = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $sql); 
    $seg = trim($seg);
    $seg = strip_tags($seg); 
    $seg = addslashes($seg); 
    return $seg;
}
}

if(!function_exists('limita_caracteres')){

    function limita_caracteres($texto, $limite, $quebra = true) {
        $tamanho = strlen($texto);
        if ($tamanho <= $limite) {
            $novo_texto = $texto;
        } else {
            if ($quebra == true) {
                $novo_texto = trim(substr($texto, 0, $limite)) . '...';
            } else {
                $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
                $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . '...';
            }
        }
        return $novo_texto;
    }
}
if ( ! function_exists('is_external_url'))
{
    function is_external_url($url)
    {
        if ( ! is_string($url))
        {
            return FALSE;
        }

        $external_url = parse_url($url);
        $internal_url = parse_url(url("/"));

        return isset($external_url['host']) && $external_url['host'] !== $internal_url['host'];
    }
}



if ( ! function_exists('img_src'))
{
    function img_src()
    {
        $args  = func_get_args();
        $types = array_map(function($arg) {
            return gettype($arg);
        }, $args);

        // Defaults options
        $options = array(
            'dynamic'   => FALSE,
            'thumbnail' => FALSE,
            'width'     => 'auto',
            'height'    => 'auto'
        );

        switch (implode('|', $types))
        {
            // ARGS: src
            case 'string':
            $url = $args[0];
            break;

            // ARGS: width
            case 'integer':
            $options['width'] = $args[0];
            break;

            // ARGS: src, attributes
            case 'string|array':
            $url     = $args[0];
            $options = $args[1] + $options;
            break;

            // ARGS: src, dynamic
            case 'string|boolean':
            $url                = $args[0];
            $options['dynamic'] = $args[1];
            break;

            // ARGS: src, width
            case 'string|integer':
            $url              = $args[0];
            $options['width'] = $args[1];
            break;

            // ARGS: width, height
            case 'integer|integer':
            $options['width']  = $args[0];
            $options['height'] = $args[1];
            break;

            // ARGS: src, width, dynamic
            case 'string|integer|boolean':
            $url                = $args[0];
            $options['width']   = $args[1];
            $options['dynamic'] = $args[2];
            break;

            // ARGS: src, width, height
            case 'string|integer|integer':
            $url               = $args[0];
            $options['width']  = $args[1];
            $options['height'] = $args[2];
            break;

            // ARGS: src, width, height, dynamic
            case 'string|integer|integer|boolean':
            $url                = $args[0];
            $options['width']   = $args[1];
            $options['height']  = $args[2];
            $options['dynamic'] = $args[3];
            break;

            // ARGS: src, width, dynamic, thumbnail
            case 'string|integer|boolean|boolean':
            $url                  = $args[0];
            $options['width']     = $args[1];
            $options['dynamic']   = $args[2];
            $options['thumbnail'] = $args[3];
            break;

            // ARGS: src, width, height, dynamic, thumbnail
            case 'string|integer|integer|boolean|boolean':
            $url                  = $args[0];
            $options['width']     = $args[1];
            $options['height']    = $args[2];
            $options['dynamic']   = $args[3];
            $options['thumbnail'] = $args[4];
            break;

            default:
            return;
        }

        if ($url == "")
        {
            $placeholder = "//placehold.it/";
            
            if (isset($options['width']))
            {
                $placeholder .= "{$options['width']}";
            }else {
                $placeholder .= "400";
            }

            if (isset($options['height']))
            {
                $placeholder .= "x{$options['height']}";
            }else {
                $placeholder .= "x400";
            }

            return $placeholder;
        }

        // If is an external URL, so we've done
        if (is_external_url($url))
        {
            return $url;
        }

        $path = ($options['dynamic'] ? '/public/storage/files/' : '/public/img/');


        if ($options['thumbnail'])
        {
            $path .= 'cache/';
            $size  = array('auto', 'auto'); // width, height

            if ($options['width'] !== NULL)
            {
                $size[0] = $options['width'];
            }

            if ($options['height'] !== NULL)
            {
                $size[1] = $options['height'];
            }

            $path .= implode('x', $size) . '/';
        }

        $path      .= ($options['dynamic']) ? $url : "{$url}";

        $path_uris = explode("/", $path);
        $file      = end($path_uris);         
        unset($path_uris[key($path_uris)]);
        unset($path_uris[0]);
        $path_temp =  implode("/", $path_uris);

        if(!file_exists($path_temp."/".$file) && file_exists(str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file))) {

            list($widthImage, $heightImage, $typeImage, $attrImage) = getimagesize(str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file));

            if ($widthImage > 1900)
            {           
                $image = Image::make((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file);

                $image->resize(1900, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file, 75);
            }       

            if (!file_exists($path_temp))
            {
                mkdir($path_temp, 0777, true);
            }

            $image = Image::make((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file)->fit(($size[0] == "auto") ? null : $size[0], ($size[1] == "auto") ? null : $size[1]);
            $image->save($path_temp."/".$file);
        }

        return url("/").$path;
    }


    if ( ! function_exists('html_tag'))
    {
        function html_tag()
        {
            $args  = func_get_args();
            $types = array_map(function($arg) {
                return gettype($arg);
            }, $args);

            // Default options
            $name    = reset($args);
            $content = NULL;
            $close   = FALSE;
            $options = array();

            switch (implode('|', $types))
            {
                // ARGS: name
                case 'string':
                break;

                // ARGS: name, content
                case 'string|string':
                $content = $args[1];
                $close   = TRUE;
                break;

                // ARGS: name, close
                case 'string|boolean':
                $close = $args[1];
                break;

                // ARGS: name, options
                case 'string|array':
                $options = $args[1];
                break;

                // ARGS: name, content, options
                case 'string|string|array':
                $content = $args[1];
                $options = $args[2];
                $close   = TRUE;
                break;

                // ARGS: name, close, options
                case 'string|boolean|array':
                $close   = $args[1];
                $options = $args[2];
                break;

                default:
                return NULL;
            }

            $tag = "<{$name}";
            

            foreach ($options as $option => $value)
            {
                $tag .= " {$option}";

                if ( ! is_null($value))
                {
                    $tag .= "=\"{$value}\"";
                }
            }

            if (isset($options['src']) && !is_external_url($options['src'])) {

                $file = str_replace("/public/", "public/", str_replace(array(url("/"), ""), "", $options['src']));
                
                if (file_exists($file)) {

                    list($widthImage, $heightImage, $typeImage, $attrImage) = getimagesize($file);

                    $tag .= " width={$widthImage} height={$heightImage}";
                }
            }

            $tag .= ">";

            if ($close || ! is_null($content))
            {
                $tag .= $content;
                $tag .= "</{$name}>";
            }
            return $tag;
        }
    }
    
    if ( ! function_exists('img'))
    {
        function img()
        {
            $args  = func_get_args();
            $types = array_map(function($arg) {
                return gettype($arg);
            }, $args);

            // Defaults options
            $width   = $height    = NULL;
            $dynamic = $thumbnail = FALSE;
            $options = array();

            switch (implode('|', $types))
            {
                // ARGS: src
                case 'string':
                $src = $args[0];
                break;

                // ARGS: width
                case 'integer':
                $width = $args[0];
                break;

                // ARGS: src, attributes
                case 'string|array':
                $src     = $args[0];
                $options = $args[1];
                break;

                // ARGS: src, dynamic
                case 'string|boolean':
                $src     = $args[0];
                $dynamic = $args[1];
                break;

                // ARGS: src, width
                case 'string|integer':
                $src   = $args[0];
                $width = $args[1];
                break;

                // ARGS: width, height
                case 'integer|integer':
                $width  = $args[0];
                $height = $args[1];
                break;

                // ARGS: src, width, dynamic
                case 'string|integer|boolean':
                $src     = $args[0];
                $width   = $args[1];
                $dynamic = $args[2];
                break;

                // ARGS: src, dynamic, attributes
                case 'string|boolean|array':
                $src     = $args[0];
                $dynamic = $args[1];
                $options = $args[2];
                break;

                // ARGS: src, width, attributes
                case 'string|integer|array':
                $src     = $args[0];
                $width   = $args[1];
                $options = $args[2];
                break;

                // ARGS: src, width, height
                case 'string|integer|integer':
                case 'string|integer|string':
                case 'string|string|integer':
                $src    = $args[0];
                $width  = $args[1];
                $height = $args[2];
                break;

                // ARGS: src, width, dynamic, attributes
                case 'string|integer|boolean|array':
                $src     = $args[0];
                $width   = $args[1];
                $dynamic = $args[2];
                $options = $args[3];
                break;

                // ARGS: src, width, height, attributes
                case 'string|integer|integer|array':
                case 'string|integer|string|array':
                case 'string|string|integer|array':
                $src     = $args[0];
                $width   = $args[1];
                $height  = $args[2];
                $options = $args[3];
                break;

                // ARGS: src, width, height, dynamic
                case 'string|integer|integer|boolean':
                case 'string|integer|string|boolean':
                case 'string|string|integer|boolean':
                $src     = $args[0];
                $width   = $args[1];
                $height  = $args[2];
                $dynamic = $args[3];
                break;

                // ARGS: src, width, dynamic, thumbnail
                case 'string|integer|boolean|boolean':
                $src       = $args[0];
                $width     = $args[1];
                $dynamic   = $args[2];
                $thumbnail = $args[3];
                break;

                // ARGS: src, width, height, dynamic, thumbnail
                case 'string|integer|integer|boolean|boolean':
                case 'string|integer|string|boolean|boolean':
                case 'string|string|integer|boolean|boolean':
                $src       = $args[0];
                $width     = $args[1];
                $height    = $args[2];
                $dynamic   = $args[3];
                $thumbnail = $args[4];
                break;

                // ARGS: src, width, height, dynamic, thumbnail, attributes
                case 'string|integer|integer|boolean|boolean|array':
                case 'string|integer|string|boolean|boolean|array':
                case 'string|string|integer|boolean|boolean|array':
                $src       = $args[0];
                $width     = $args[1];
                $height    = $args[2];
                $dynamic   = $args[3];
                $thumbnail = $args[4];
                $options   = $args[5];
                break;
            }

            $options = array('src' => '') + $options; // Unshift src to the array

            if (!$thumbnail && $width !== NULL && strtolower($width) !== 'auto')
            {
                $options['width'] = $width;
            }

            if (!isset($src) || $args[0] == "")
            {
                $src = "";
            }

            $options['src'] = img_src($src, array(
                'width'     => $width,
                'height'    => $height,
                'dynamic'   => $dynamic,
                'thumbnail' => $thumbnail
            ));

            return html_tag('img', $options);
        }
    }
}




if( ! function_exists( 'setDate' ) ){
    function setDate($data){
        date_default_timezone_set("America/Sao_Paulo");
        $data = explode('/', $data);
        $data = $data[2] . '-' . $data[1] . '-' . $data[0];
        return $data;
    }
}
