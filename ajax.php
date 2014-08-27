<?php 
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	
	/*
	@Curl Bağlantı Fonksiyonu
	*/
	function getir($url)
	{	
		$ch = curl_init();
		$timeout = 10;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_HEADER,false);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (X11; U; Linux x86_64; en; rv:1.9.0.19) Gecko/20080528 Epiphany/2.22');
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	if($_POST){
	
		$dizi = array();
		
		$keyword = $_POST['keyword'];
		$etiketGoogleTag = str_replace(' ','+',$keyword);
		$Site = getir('https://www.google.com.tr/search?hl=tr&as_q='.$etiketGoogleTag.'');
		$Site =   str_replace(array("\t","\n","\r"),"",$Site);  
		$Pattern = '|<p class="(.*?)"><a href="/search?(.*?)">(.*?)</a></p>|si';
		
		preg_match_all($Pattern, $Site, $Sonuc);
		
		
			$tags = array();
			
			foreach($Sonuc[3] as $tag)
			{
				$tags[] = strip_tags($tag);
			}
			
			$tags = implode(',',$tags);
			
			$dizi['data'] = $tags;
		
		echo json_encode($dizi);
	
	}
	
	
}
	
	
?>	