<?php

/**
 * @author Copyright 2019 Izzeldin Addarda <zeldin@merahputih.id>
 * @package Auto Create Account Gojek & Redeem Voucher
 * Change the copyright doesn't make you as a Proffesional CODER.
 **/

require "./gojek.class.php";
echo "\e[93m
  ___  ___ ___   _____ ___   _   __  __   __  __ _  _____ 
 / __|/ __| _ ) |_   _| __| /_\ |  \/  | |  \/  | |/ / __|
 \__ \ (_ | _ \   | | | _| / _ \| |\/| | | |\/| | ' <\__ \
 |___/\___|___/   |_| |___/_/ \_\_|  |_| |_|  |_|_|\_\___/
                                                          
\n";
echo "\e[93m Timezone : ".date('d-m-Y H:i:s')."\n";
echo "[#] Nomor : "; $nomor = trim(fgets(STDIN));
$gojek = new Gojek($nomor);
$register = $gojek->register();
if(isset($register['success'])){
    if($register['message'] == null){
        die("User already registered.\n");
    }
    echo "[#] OTP : "; $otp = trim(fgets(STDIN));
    $send = $gojek->send_otp($register['otp_token'], $otp);
    while(!$send['success']){
        echo "[!] Invalid OTP.\n".PHP_EOL;
        echo "[#] OTP : "; $otp = trim(fgets(STDIN));
        $send = $gojek->send_otp($register['otp_token'], $otp);
    }
    echo "[+] Access token for number ".$nomor." is ".$send['access_token'].PHP_EOL;
    echo "[$] Try to redeem GOFOODBOBA07".PHP_EOL;
    echo $gojek->redeem("GOFOODBOBA07", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem GOFOODBOBA07..".PHP_EOL : "\n[!] Failed redeem GOFOODBOBA07..".PHP_EOL;
    sleep(10);
    echo "[$] Try to redeem COBAINGOJEK".PHP_EOL;
    echo $gojek->redeem("COBAINGOJEK", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem COBAINGOJEK..".PHP_EOL : "\n[!] Failed redeem COBAINGOJEK..".PHP_EOL;
    sleep(10);
    echo "[$] Try to redeem AYOCOBAGOJEK".PHP_EOL;
    echo $gojek->redeem("AYOCOBAGOJEK", 0, $send['access_token'])['success'] == true ? "\n[$] Success redeem AYOCOBAGOJEK..".PHP_EOL : "\n[!] Failed redeem AYOCOBAGOJEK..".PHP_EOL;
    echo "[$] Try to redeem Batch Mc Donald's Cashback 20k".PHP_EOL;
    sleep(10);
    echo $gojek->redeem(0, "44c78b9b-69ec-4fe0-9c63-feb4e6075aed", $send['access_token'])['success'] == true ? "[$] Success redeem Mc Donald's..".PHP_EOL : "[!] Failed redeem Mc Donald's..\n".PHP_EOL;
    echo "Done Redeem..\n".PHP_EOL;
}else{
    print("\t".$register['message'].PHP_EOL);
}
?>
