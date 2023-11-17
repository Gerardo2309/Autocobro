<?php
	function base_url(){
		return BASE_URL;
	} 
	function media(){
		return BASE_URL."assets";
	}
	function headerHome($data=""){
		$view_header = "Views/Template/header.php";
		require_once($view_header);
	}

	function footerHome($data=""){
		$view_footer = "Views/Template/footer.php";
		require_once($view_footer);
	}

	function headerAdmin($data=""){
		$view_hadmin = "Views/Template/Admin/header_admin.php";
		require_once($view_hadmin);
	}

	function footerAdmin($data=""){
		$view_fadmin = "Views/Template/Admin/footer_admin.php";
		require_once($view_fadmin);
	}

	function navbar($data=""){
		$view_navbar = "Views/Template/nav_bar.php";
		require_once($view_navbar);
	}

	function navbar_admin($data=""){
		$view_navbar = "Views/Template/Admin/nav_bar_admin.php";
		require_once($view_navbar);
	}

	function dep($data){
		$format = print_r('<pre>');
		$format .= print_r($data);
		$format .= print_r('</pre>');
		return $format;
	}

	function getModal(string $nameModal, $data){
		$view_modal = "Views/Template/Modals/{$nameModal}.php";
		require_once $view_modal;
	}

	function strClean($strCadena){
		$string = preg_replace(['/\s+/','/^\s|\s$/'], [' ',''], $strCadena);
		$string = trim($string);
		$string = stripslashes($string);
		$string = str_ireplace("<script>", "", $string);
		$string = str_ireplace("</script>", "", $string);
		$string = str_ireplace("<script src>", "", $string);
		$string = str_ireplace("<script type=>", "", $string);
		$string = str_ireplace("SELECT * FROM", "", $string);
		$string = str_ireplace("DELETE FROM", "", $string);
		$string = str_ireplace("INSERT INTO", "", $string);
		$string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
		$string = str_ireplace("DROP TABLE", "", $string);
		$string = str_ireplace("OR '1'='1", "", $string);
		$string = str_ireplace('OR "1"="1"', "", $string);
		$string = str_ireplace('OR ´1´=´1´', "", $string);
		$string = str_ireplace("is NULL; --", "", $string);
		$string = str_ireplace("is NULL; --", "", $string);
		$string = str_ireplace("LIKE '", "", $string);
		$string = str_ireplace('LIKE "', "", $string);
		$string = str_ireplace("LIKE ´", "", $string);
		$string = str_ireplace("OR 'a'='a", "", $string);
		$string = str_ireplace('OR "a"="a', "", $string);
		$string = str_ireplace("OR ´a´=´a", "", $string);
		$string = str_ireplace("OR ´a´=´a", "", $string);
		$string = str_ireplace("--", "", $string);
		$string = str_ireplace("^", "", $string);
		$string = str_ireplace("[", "", $string);
		$string = str_ireplace("]", "", $string);
		$string = str_ireplace("==", "", $string);
		return $string;
	}

	function passGenerator($length=10){
		$pass ="";
		$longitudPass = $length;
		$cadena = "ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstvwxyz1234567890";
		$longitudCadena = strlen($cadena);
		for ($i=1; $i<=$longitudPass; $i++) { 
			$pos = rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}

	function token(){
		$r1 = bin2hex(random_bytes(10));
		$r2 = bin2hex(random_bytes(10));
		$r3 = bin2hex(random_bytes(10));
		$r4 = bin2hex(random_bytes(10));

		$token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
		return $token;
	}

	function formatMoney($cantidad){
		$cantidad = number_format($cantidad,2,SPD,SPM);
		return $cantidad;
	}

?>