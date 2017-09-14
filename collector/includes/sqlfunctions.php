<?php 
include('db.php');//connection file

function f_sqlConnect(){
	$link = new mysqli(HOST,USER,PASS,DB);

	if($link->connect_error){
		echo "Failure " . $link->connect_error;
	}else{
		
		return $link;//this will send the $link variable when the function completes we need this
	
	}
}

//this is checking to see if the ip is in a routable range this is a standard function
function f_validIP($ip){
		 /*!empty($ip) checks if $ip is populated*/
		       /*ip2long($ip) is a form of validation on the input*/
		  if (!empty($ip) && ip2long($ip)!=-1) {
		               /*Create an array of arrays standard non routable IPs so we can filter 
		               out IPs that aren’t useful*/
		    $reserved_ips = array (
		      array('0.0.0.0','2.255.255.255'),
		      array('10.0.0.0','10.255.255.255'),
		                 array('127.0.0.0','127.255.255.255'),
		                 array('169.254.0.0','169.254.255.255'),
		                 array('172.16.0.0','172.31.255.255'),
		                 array('192.0.2.0','192.0.2.255'),
		                 array('192.168.0.0','192.168.255.255'),
		                 array('255.255.255.0','255.255.255.255')
		    );
		               /*Compare the IP to each array and return a false if the IP is within any 
		               of the ranges*/
		    foreach ($reserved_ips as $r) {
		      $min = ip2long($r[0]);
		      $max = ip2long($r[1]);
		      if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
		    }
		               /*if the ip is populated and isn’t in the non routable range, return true*/
		    return true; 
		  } else {
		      return false;     
		  }
}

//this is getting the IP address from the $_SERVER super global again this is a standard function
function f_getIP(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

function f_tableExists(mysqli $link, $tablename, $database = false){
	if(!$database){
		$res = mysqli_query($link,"SELECT_DATABASE()");
		$database = mysqli_result($res, 0);
	}
	$res = mysqli_query($link,"SELECT * FROM information_schema.tables
								WHERE table_schema = '$database'
								AND table_name = '$tablename'");
	echo '<br>Table Exists: ' . ($res->num_rows);
	return $res->num_rows == 1;
}







 ?>