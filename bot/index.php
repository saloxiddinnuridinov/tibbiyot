<?php
require "fpdf.php";

$data = file_get_contents('php://input');

$data = json_decode($data, true);

$token = '5635387097:AAFy6X1s1JeKpp_4NKXF8eeWZCGxHcPY-_I';

$chat_id = $data["message"]["from"]["id"] ?
			$data["message"]["from"]["id"] : null;

try{
	if (!empty($data['message']['photo'])) {
        $photo = array_pop($data['message']['photo']);
        $ch = curl_init('https://api.telegram.org/bot' . $token . '/getFile');  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('file_id' => $photo['file_id']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);
        
		if ($res['ok']) {
			$dir = __DIR__ . '/'.$chat_id;
			if ( !file_exists( $dir ) && !is_dir( $dir ) ) {
				mkdir($dir);
			}
            $src  = 'https://api.telegram.org/file/bot' . $token . '/' . $res['result']['file_path'];
            $papka = __DIR__ . '/' . $chat_id . "/". time() . '-' . basename($src);
            copy($src, $papka);
			$matn = "Rasm yuklandi";
			send("sendMessage",["chat_id" => $chat_id, "text" => $matn,]);	
        }

	}
    if (isset($chat_id)){
	    $text = $data["message"]["text"] ?
		$data["message"]["text"] : null;

		$name = $data ["message"]["from"]["first_name"];

		$matn = '';
		if ($text == "/start") {
		    $matn = "Assalomu alaykum! ".$name."botimizga xush kelibsiz!!!";
		}

		elseif ($text == "/programmer") {
		    $matn = "https://www.programmer.uz";
		}
		

		elseif ($text == "/dasturchi") {
			$matn = "https://t.me/Salohiddin_Nuridinov";
		}
		elseif ($text == "/pdfni_yuklash") {
			$pdf = new FPDF();
			$images = glob("$chat_id/*.jpg");
				for ($i=0; $i < count($images) ; $i++) { 
					$pdf->AddPage();
					$pdf->Image($images[$i],0,0);
				}
			$pdf->Output('F', 'result.pdf');
			$matn = "PDF tayyor!";
			send("sendDocument",["chat_id" => $chat_id, "document" => new CURLFile('result.pdf'),]);
			unlink("result.pdf");
			rmdir($chat_id);
		}
        send("sendMessage",["chat_id" => $chat_id, "text" => $matn,]);
	}
    	
	
}catch(Exception $exception){
	send("sendmessage",["chat_id" => $chat_id, "text" => json_encode($exception->getMessage(),JSON_PRETTY_PRINT)]);
	
}
 
function send($method, $data)
{

	$bot_api = "5635387097:AAFy6X1s1JeKpp_4NKXF8eeWZCGxHcPY-_I";

	$url = "https://api.telegram.org/bot".$bot_api."/".$method;

	try{
        if(!$curl = curl_init()){
		    exit();
		}
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);

        return $result;

 	}catch(Exception $exception){
 		echo $exception->getMessage();	
 	}
}			
?>