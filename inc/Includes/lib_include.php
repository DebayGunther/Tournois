<?php      


/////////////////////////////////////////////
function debug($variable){
    echo '<pre>' . print_r($variable,true) . '</pre>';
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
   return substr( str_shuffle( str_repeat($alphabet, $length)),0,$length);
   
}

function logged_only(){
    
    if(session_status() == PHP_SESSION_NONE){
session_start();
}
    
    if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder a cette page";
    header('Location: http://localhost/TFE/login.php');
    exit();
    
}
}














///////////////////////////////////////////////////////////////
//FONCTIONS

/*==================================================
0 KO
1 OK
==================================================*/
function getOk($val){
    $ret = '';
    if ($val == 2)
        $ret = 'KO';
    if ($val == 1)
        $ret = 'OK';
    return $ret;
}

/*==================================================
0 KO
1 OK
==================================================*/
function getOui($val){
    $ret = '';
    if ($val == 2)
        $ret = 'NON';
    if ($val == 1)
        $ret = 'OUI';
    return $ret;
}



/*==================================================
Formate une date postgres
==================================================*/
function formatPgDate($date){
    
    if ($date <>'') {
        $liste = explode("-", $date);

        $formated_date =  $liste[2].'/'. $liste[1].'/'.$liste[0];
    }
    else $formated_date = '';
    return $formated_date;
}
/*==================================================
Retourne l'information en retirant les \r \n \t
(Pour alléger le code de retour ajax par exemple
==================================================*/
function string_for_ajax($info){
	return trim(str_replace(array("\r", "\n", "\t", "\r\n", "\n\r"), "", $info));
}

// Looks in $_GET and $_POST for a variable $var_name
function getVariable($var_name, $default_value) {

	// We look in $_POST and $_GET if the variable is defined
	$var_value = (isset($_POST[$var_name])) ?
		$_POST[$var_name] : ((isset($_GET[$var_name])) ?
			$_GET[$var_name] : $default_value);
/*	if ("-" . $var_value == "-") {
		$var_value = $default_value;
	} */

	// If we got a value or if we used the default value provided to the
	// function, we trim it if it is not
	if ($var_value != "" && gettype($var_value) != "array") {
		$var_value = trim($var_value);
	}
//	$var_value = htmlentities($var_value);
	return mysqli_real_escape_string($var_value);
        
}

function escape_str($var_value) {
	return str_replace("'","\"",$var_value);
}

// ------------------------------------------------------------------------------

function unescape_str($var_value) {
	return str_replace("''","'",$var_value);
}

// ------------------------------------------------------------------------------

function print_r_debug($array){
	echo "<pre style=\"text-align:left;color:#FF0000;\">".print_r($array,true)."</pre>\n";
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function print_r_query($sqlcmd) {
	global $path_to;

	echo
		'<script type="text/javascript" src="' . $path_to .
		'/general_includes/js/chili/jquery.chili.pack.js"></script>' .
		'<script type="text/javascript">' .
		'ChiliBook.recipeFolder = "' . $path_to . '/general_includes/js/chili/";' .
		'ChiliBook.stylesheetFolder = "' . $path_to . '/general_includes/js/chili/";' .
		'</script>' .
		'<code class="mysql" style="white-space: pre;">' .
		$sqlcmd .
		'</code>';
}

// ------------------------------------------------------------------------------------
//Remplace les caracteres accentues
// ------------------------------------------------------------------------------------
function no_accent($str_accent) {
	$pattern = Array("/À/", "/Á/", "/Â/", "/Ã/", "/Ä/", "/Å/", "/Ç/", "/È/", "/É/", "/Ê/", "/Ë/", "/Ì/", "/Í/", "/Î/", "/Ï/", "/Ò/", "/Ó/", "/Ô/", "/Õ/", "/Ö/", "/Ù/", "/Ú/", "/Û/", "/Ü/", "/Ý/", "/à/", "/á/", "/â/", "/ã/", "/ä/", "/å/", "/ç/", "/è/", "/é/", "/ê/", "/ë/", "/ì/", "/í/", "/î/", "/ï/", "/ð/", "/ò/", "/ó/", "/ô/", "/õ/", "/ö/", "/ù/", "/ú/", "/û/", "/ü/", "/ý/", "/ÿ/");
	$rep_pat = Array("A", "A", "A", "A", "A", "A", "C", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "y");
	$str_noacc = preg_replace($pattern, $rep_pat, $str_accent);
	return $str_noacc;
}

/**
	Remplace les caractères non ISO-8859-1 ou non ASCII par leur équivalent ASCII

	string	removeDiacritics(string $str[, bool $all = false])

	string	$str	chaîne dont il faut éventuellement remplacer des caractères
	bool	$all	si true, remplace aussi les caractères diacrités ISO-8859-1 (gérés par les polices PDF)

	@param	string $str : chaîne dont il faut éventuellement remplacer des caractères
	@param	bool $all : si true, remplace aussi les caractères diacrités ISO-8859-1 (gérés par les polices PDF)
	@return	string : chaîne éventuellement modifiée
*/
function removeDiacritics($str, $all = false) {

	$diacritics = array(
		'A' => array('Ā','Ă','Ą','Ǎ','Ǟ','Ǡ','Ǻ','Ȁ','Ȃ','Ȧ','Ḁ','Ạ','Ả','Ấ','Ầ','Ẩ','Ẫ','Ậ','Ắ','Ằ','Ẳ','Ẵ','Ặ'),
		'a' => array('ā','ă','ą','ǎ','ǟ','ǡ','ǻ','ȁ','ȃ','ȧ','ḁ','ạ','ả','ấ','ầ','ẩ','ẫ','ậ','ắ','ằ','ẳ','ẵ','ặ'),
		'B' => array('Ḃ','Ḅ','Ḇ','Ƀ','Ɓ','Ƃ'),
		'b' => array('ḃ','ḅ','ḇ','ƀ','ɓ','ƃ','ᵬ','ᶀ'),
		'C' => array('Ć','Ĉ','Č','Ċ','Ḉ','Ȼ','Ƈ'),
		'c' => array('ć','ĉ','č','ċ','ḉ','ȼ','ƈ','ɕ'),
		'D' => array('Ď','Ḋ','Ḑ','Ḍ','Ḓ','Ḏ','Đ','Ɖ','Ɗ','Ƌ'),
		'd' => array('ď','ḋ','ḑ','ḍ','ḓ','ḏ','đ','ɖ','ɗ','ƌ','ᵭ','ᶁ','ᶑ','ȡ','∂'),
		'E' => array('Ĕ','Ế','Ề','Ễ','Ể','Ě','Ẽ','Ė','Ȩ','Ḝ','Ę','Ē','Ḗ','Ḕ','Ẻ','Ȅ','Ȇ','Ẹ','Ệ','Ḙ','Ḛ','Ɇ'),
		'e' => array('ĕ','ế','ề','ễ','ể','ě','ẽ','ė','ȩ','ḝ','ę','ē','ḗ','ḕ','ẻ','ȅ','ȇ','ẹ','ệ','ḙ','ḛ','ɇ','ᶒ'),
		'F' => array('Ḟ','Ƒ'),
		'f' => array('ḟ','ƒ','ᵮ','ᶂ'),
		'G' => array('Ǵ','Ğ','Ĝ','Ǧ','Ġ','Ģ','Ḡ','Ǥ','Ɠ'),
		'g' => array('ǵ','ğ','ĝ','ǧ','ġ','ģ','ḡ','ǥ','ɠ','ᶃ'),
		'H' => array('Ĥ','Ȟ','Ḧ','Ḣ','Ḩ','Ḥ','Ḫ','Ħ','Ⱨ'),
		'h' => array('ĥ','ȟ','ḧ','ḣ','ḩ','ḥ','ḫ','ẖ','ħ','ⱨ'),
		'I' => array('Ĭ','Ǐ','Ḯ','Ĩ','Į','Ī','Ỉ','Ȉ','Ȋ','Ị','Ḭ','Ɨ','İ'),
		'i' => array('ĭ','ǐ','ḯ','ĩ','į','ī','ỉ','ȉ','ȋ','ị','ḭ','ɨ','ᵻ','ᶖ','ı'),
		'J' => array('Ĵ','Ɉ','ȷ'),
		'j' => array('ĵ','ɉ','ǰ','ʝ','ɟ','ʄ'),
		'K' => array('Ḱ','Ǩ','Ķ','Ḳ','Ḵ','Ƙ','Ⱪ'),
		'k' => array('ḱ','ǩ','ķ','ḳ','ḵ','ƙ','ⱪ','ᶄ'),
		'L' => array('Ĺ','Ľ','Ļ','Ḷ','Ḹ','Ḽ','Ḻ','Ł','Ŀ','Ƚ','Ɫ'),
		'l' => array('ĺ','ľ','ļ','ḷ','ḹ','ḽ','ḻ','ł','ŀ','ƚ','ⱡ','ɫ','ɬ','ᶅ','ɭ','ȴ'),
		'M' => array('Ḿ','Ṁ','Ṃ'),
		'm' => array('ḿ','ṁ','ṃ','ᵯ','ᶆ','ɱ'),
		'N' => array('Ń','Ǹ','Ň','Ṅ','Ņ','Ṇ','Ṋ','Ṉ','Ɲ','Ƞ','Ŋ'),
		'n' => array('ń','ǹ','ň','ṅ','ņ','ṇ','ṋ','ṉ','ɲ','ƞ','ŋ','ᵰ','ᶇ','ɳ','ȵ'),
		'O' => array('Ŏ','Ố','Ồ','Ỗ','Ổ','Ǒ','Ȫ','Ő','Ṍ','Ṏ','Ȭ','Ȯ','Ȱ','Ǿ','Ǫ','Ǭ','Ō','Ṓ','Ṑ','Ỏ','Ȍ','Ȏ','Ơ','Ớ','Ờ','Ỡ','Ở','Ợ','Ọ','Ộ','Ɵ','Ɔ'),
		'o' => array('ŏ','ố','ồ','ỗ','ổ','ǒ','ȫ','ő','ṍ','ṏ','ȭ','ȯ','ȱ','ǿ','ǫ','ǭ','ō','ṓ','ṑ','ỏ','ȍ','ȏ','ơ','ớ','ờ','ỡ','ở','ợ','ọ','ộ','ɵ','ɔ'),
		'P' => array('Ṕ','Ṗ','Ᵽ','Ƥ'),
		'p' => array('ṕ','ṗ','ᵽ','ƥ','ᵱ','ᶈ'),
		'Q' => array('Ɋ','Ƣ'),
		'q' => array('ɋ','ƣ','ʠ'),
		'R' => array('Ŕ','Ř','Ṙ','Ŗ','Ȑ','Ȓ','Ṛ','Ṝ','Ṟ','Ɍ','Ɽ'),
		'r' => array('ŕ','ř','ṙ','ŗ','ȑ','ȓ','ṛ','ṝ','ṟ','ɍ','ɽ','ᵲ','ᶉ','ɼ','ɾ','ᵳ'),
		'S' => array('Ś','Ṥ','Ŝ','Š','Ṧ','Ṡ','Ş','Ṣ','Ṩ','Ș'),
		's' => array('ś','ṥ','ŝ','š','ṧ','ṡ','ẛ','ş','ṣ','ṩ','ș','ᵴ','ᶊ','ʂ','ȿ'),
		'T' => array('Ť','Ṫ','Ţ','Ṭ','Ț','Ṱ','Ṯ','Ŧ','Ⱦ','Ƭ','Ʈ'),
		't' => array('ť','ṫ','ţ','ṭ','ț','ṱ','ṯ','ŧ','ⱦ','ƭ','ʈ','ẗ','ᵵ','ƫ','ȶ'),
		'U' => array('Ŭ','Ǔ','Ů','Ǘ','Ǜ','Ǚ','Ǖ','Ű','Ũ','Ṹ','Ų','Ū','Ṻ','Ủ','Ȕ','Ȗ','Ư','Ứ','Ừ','Ữ','Ử','Ự','Ụ','Ṳ','Ṷ','Ṵ','Ʉ'),
		'u' => array('ŭ','ǔ','ů','ǘ','ǜ','ǚ','ǖ','ű','ũ','ṹ','ų','ū','ṻ','ủ','ȕ','ȗ','ư','ứ','ừ','ữ','ử','ự','ụ','ṳ','ṷ','ṵ','ʉ','ᵾ','ᶙ'),
		'V' => array('Ṽ','Ṿ','Ʋ'),
		'v' => array('ṽ','ṿ','ʋ','ᶌ','ⱴ'),
		'W' => array('Ẃ','Ẁ','Ŵ','Ẅ','Ẇ','Ẉ'),
		'w' => array('ẃ','ẁ','ŵ','ẅ','ẇ','ẉ','ẘ'),
		'X' => array('Ẍ','Ẋ'),
		'x' => array('ẍ','ẋ','ᶍ'),
		'Y' => array('Ỳ','Ŷ','Ÿ','Ỹ','Ẏ','Ȳ','Ỷ','Ỵ','Ɏ','Ƴ'),
		'y' => array('ỳ','ŷ','ẙ','ỹ','ẏ','ȳ','ỷ','ỵ','ɏ','ƴ','ʏ'),
		'Z' => array('Ź','Ẑ','Ž','Ż','Ẓ','Ẕ','Ƶ','Ȥ','Ⱬ'),
		'z' => array('ź','ẑ','ž','ż','ẓ','ẕ','ƶ','ȥ','ⱬ','ᵶ','ᶎ','ʐ','ʑ','ɀ'),
		'OE' => array('Œ'),
		'oe' => array('œ')
	);

	$basicLatinDiacritics = array(
		'A' => array('À','Á','Â','Ã','Ä','Å'),
		'a' => array('à','á','â','ã','ä','å'),
		'C' => array('Ç'),
		'c' => array('ç'),
		'E' => array('É','È','Ê','Ë'),
		'e' => array('é','è','ê','ë'),
		'I' => array('Í','Ì','Î','Ï'),
		'i' => array('í','ì','î','ï'),
		'N' => array('Ñ'),
		'n' => array('ñ'),
		'O' => array('Ó','Ò','Ô','Ö','Õ','Ø'),
		'o' => array('ó','ò','ô','ö','õ','ø'),
		'U' => array('Ú','Ù','Û','Ü'),
		'u' => array('ú','ù','û','ü'),
		'Y' => array('Ý'),
		'y' => array('ý','ÿ'),
		'AE' => array('Æ'),
		'ae' => array('æ'),
	);

	if (!!$all === true) {
		$diacritics = array_merge_recursive($diacritics, $basicLatinDiacritics);
	}

	foreach ($diacritics as $letter => $variations) {
		$str = str_replace($variations, $letter, $str);
	}

	return $str;
}


//-----------------------------------------------------------------------------
// Cree une HTML select box basee sur un array avec les valeurs
// Idealement, cet array est initialise dans la classe generique
function html_CreateSelectOption($infos, $selected_value, $pk_name, $select_name="", $select_attribute = "", $WithSelect=true, $group_field="") {
	$select_name = ($select_name == "") ? $pk_name : $select_name;

	$str = "";
	if ($WithSelect)
		$str .= "<select name=\"".$select_name."\" ".$select_attribute.">\n";

	if (! empty($group_field)) $prev_group = "-1";
    foreach ($infos as $result) {
//print_r_debug($result);
    	//for ($i = 0; $i < count($infos); $i++) {
		if (! empty($group_field)) {
			if ($result[$group_field] != $prev_group) {
				if ($prev_group != "-1") $str .= "</optgroup>\n";
				$str .= "<optgroup label=\"" . $result[$group_field] . "\">";
			}
		}
		$selected = ($result[$pk_name] == $selected_value) ? " selected" : "";

		$str .= "	<option value=\"".$result[$pk_name]."\"".$selected.">".(htmlentities($result["select_label"], ENT_QUOTES, 'UTF-8'))."</option>\n";
		if (! empty($group_field)) $prev_group = $result[$group_field];
    }
	if (! empty($group_field))
		$str .= "</optgroup>\n";
    if ($WithSelect)
		$str .= "</select>\n";
	return $str;
}

/////////////////////////////////////////////////////////
// Ecrire (créer) un log
function trace($project_name,$str) {
    

    switch ($project_name) {
        case "bon":
            $file = getcwd()."/logs/log.txt";
            break;
        case "gis":
             $file = getcwd()."/logs/log.txt";
            break;
        case "dr1":

            break;
    }  
    $mode="a";
    
    $t = explode(" ",microtime());
    $date = date("m-d-y H:i:s",$t[1]).substr((string)$t[0],1,4);

    if (($handle = @fopen ($file, $mode)) == FALSE) {
            return -1;
    }
    if (fwrite ($handle, "[".$date."] ".$str."\r\n") === FALSE){
            fclose ($handle);
            return -2;
    }
    fclose ($handle);
    return 0;   
 }
 
/////////////////////////////////////////////////////////
// Ecrire (créer) un log
function encryptFile($filename,$input_path,$output_path) {
    $gpg = new gnupg();

    $monfichier = fopen($input_path.$filename, 'r+');
    if ($monfichier == false)
        die("Impossible d\'ouvrir $input_path.$filename");
echo $input_path.$filename.'<br>';
    $contenu = fread($monfichier, filesize($input_path.$filename));
    if ($contenu == false)
        die("Impossible de lire $input_path.$filename");

    $fichierCrypt = fopen($output_path.$filename.'.pgp', 'w');
    if ($fichierCrypt == false)
         die("Impossible de créer le fichier pgp");

    if ($gpg->addencryptkey("D8D9361FD99403A3F0D12923F80EE82E98572A28") == false)
             die("Impossible d'ajouter la clé pgp");

    $enc = $gpg->encrypt($contenu);

    fputs($fichierCrypt, $enc); 

    fclose($monfichier);
    fclose($fichierCrypt);
}

 
//////////////////////////////////////////////////////////////////
//          Récupération du champ INS à agréger                //
////////////////////////////////////////////////////////////////
    function getAgregationInsField($niveau_agregation) {
        //switch $niveau_agregation
        switch ($niveau_agregation) {
            case 'A' : $field = 'ins_arrondissement';break;
            case 'P' : $field = 'ins_province';break;
            case 'B' : $field = "ins_bassin";break;
            case 'C' : $field = 'ins_commune';break;
            case 'R' : $field = 'ins_region';break;
        }
        return $field;
    } 

    
//////////////////////////////////////////////////////////////////
//          Récupére le nom du projet ( walstat ou ICPIB       //
////////////////////////////////////////////////////////////////
     function getProjet($nom_projet){
        
        switch ($nom_projet){
            case 'walstat' : $field = 'ind_gis';break;
            case 'ICPIB' : $field = 'ind_pib';break;
            
        }
        return $field;
        
    }
    //////////////////////////////////////////////////////////////////
    function afficheNombre($val,$nb_decimal=0) {
        $val = str_replace(' ','',$val);
        $val = str_replace(',','.',$val);
        if ($val <> '0') {
            // Try to convert the string to a float
            $floatVal = floatval($val);
            // If the parsing succeeded and the value is not equivalent to an int
            if(!$floatVal)
            {
                $val = '-';
            }
        }
        $val = number_format($val,$nb_decimal,',','.');
        return $val;
    }
    
      //////////////////////////////////////////////////////////////////
    function isValidCaptcha($code, $ip = null){
    if (empty($code)) {
        return false; // Si aucun code n'est entré, on ne cherche pas plus loin
    }
    $params = [
        'secret'    => '6LcVHRYTAAAAAELnBezanIpfGC0Kc-0nfQjo4TdR',
        'response'  => $code
    ];
    if( $ip ){
        $params['remoteip'] = $ip;
    }
    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
    if (function_exists('curl_version')) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
        $response = curl_exec($curl);
    } else {
        // Si curl n'est pas dispo, un bon vieux file_get_contents
        $response = file_get_contents($url);
    }

    if (empty($response) || is_null($response)) {
        return false;
    }

    $json = json_decode($response);
    return $json->success;
}

    function sendMail($recipients,$subject,$body,$from) {
        $headers["From"]    = $from;
        $headers["To"]      = $recipients;
        $headers["Subject"] = $subject;

        $params["host"] = "mail.iweps.be";
        $params["port"] = "25";

        $mail_object =& Mail::factory('sendmail', $params);
        if (PEAR::isError($mail_object))
        {
          print "<p>construction de l'objet 'Mail' ratée car ";
          die($mail_object->getMessage());
        } 

        $send_result = $mail_object->send($recipients,$headers,$body);
        
        if (PEAR::isError($send_result))
        {
          print "<p>envoi de l'email raté car ";
          die($send_result->getMessage());
        } 
    }

?>
