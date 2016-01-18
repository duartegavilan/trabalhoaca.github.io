<?php

define("YOUTUBE_URL_1", "youtube.com");
define("YOUTUBE_URL_2", "youtu.be");
define("YOUTUBE_URL_3","youtube.com/attribution_link");
define("IMGUR_URL_1","imgur.com");

define("REDDIT_URL", "https://www.reddit.com");
define("SEPARADOR_URL_YOUTUBE_INICIO", "v=");
define("SEPARADOR_URL2_YOUTUBE_INICIO", ".be/");
define("SEPARADOR_URL3_YOUTUBE_INICIO","?a=");

define("SEPARADOR_URL_YOUTUBE_FIM", "&");


	function consumirUrl($url) {
		$service_url = $url;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$html = curl_exec($curl);
		curl_close($curl);
		return $html;
	}

	function retirarChildNodesSemId($redditMainContent) {
		$mainContentChildNodes = $redditMainContent->childNodes;
		$mainContentChildNodesParaRemover = array();

		foreach ($mainContentChildNodes as $filho) {
			if($filho->hasAttributes()) {
				if(strcmp($filho->getAttribute('class'), "clearleft") === 0 ||
					!$filho->hasAttribute('id')
					) {
					$mainContentChildNodesParaRemover[] = $filho;	
				}
			}
		}

		foreach ($mainContentChildNodesParaRemover as $filho) {
			$filho->parentNode->removeChild($filho);
		}
	}

	function obterFilhoPeloValorDoAtributoClass($nodeParent, $className) {
		foreach ($nodeParent->childNodes as $filho) {
			if($filho->hasAttributes()) {
				if(strcmp($filho->getAttribute('class'), $className) === 0)
					return $filho;
			}
		}
	}

	function imprimirPosts($redditPosts) {
		foreach ($redditPosts as $post) {
			echo "---------------------------------------"."\n";
			//echo "id: 		 ".$post->getAttribute('id')."\n";
			
			echo "subrredit: ".$post->getAttribute('data-subreddit')."\n";
			echo "author:    ".$post->getAttribute('data-author')."\n";
			echo "rank:      ".$post->firstChild->nextSibling->nodeValue."\n";
			echo "score:     ".
			obterFilhoPeloValorDoAtributoClass($post, "midcol unvoted")
			->firstChild->nextSibling->nextSibling->nodeValue."\n";
			echo "link:      ".$post->getElementsByTagName('a')->item(0)->getAttribute('href')."\n"; 
			echo "---------------------------------------";
		}
	}

	function postsToString($redditPosts) {
		$ret = "";
		foreach ($redditPosts as $post) {
			$ret .= "---------------------------------------"."</br>".
			
			"subrredit: ".$post->getAttribute('data-subreddit')."</br>".
			"author:    ".$post->getAttribute('data-author')."</br>".
			"rank:      ".$post->firstChild->nextSibling->nodeValue."</br>".
			"score:     ".
			obterFilhoPeloValorDoAtributoClass($post, "midcol unvoted")
			->firstChild->nextSibling->nextSibling->nodeValue."</br>".
			"link:      "."<a href=".$post->getElementsByTagName('a')->item(0)->getAttribute('href').">".
			$post->getElementsByTagName('a')->item(0)->getAttribute('href')."</a>"."</br>". 
			"---------------------------------------</br>";
		}
		return $ret;
	}





function isImage( $url )
  {
    $pos = strrpos( $url, ".");
	  if ($pos === false)
	  return false;
		$ext = strtolower(trim(substr( $url, $pos)));
		$imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif"); 
			if ( in_array($ext, $imgExts) )
	 			 return true;
   					 return false;
  }


  function verificaVideo($url){

  		$sacaString=substr($url,0,23);


		if($sacaString=="https://www.youtube.com"){

            	echo "E um video do youtube";
            	return true;
			}else{
				echo "Nao e um video do youtube";
				return false;
			}
  }


  function criarVideoYoutube($url){


     
		if(strpos($url, YOUTUBE_URL_1)) {
			echo "url é do tipo 1";
		

  		$posicaoIdVideoStart = strpos($url, SEPARADOR_URL_YOUTUBE_INICIO) + strlen(SEPARADOR_URL_YOUTUBE_INICIO);
		$tamanhoId = strlen($url) - $posicaoIdVideoStart;

			$stringSacada = substr($url, $posicaoIdVideoStart,$tamanhoId);


			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$stringSacada.'" frameborder="0" allowfullscreen></iframe>';

		}

		if(strpos($url, YOUTUBE_URL_2)) {
			echo "url é do tipo 2";
		

  		$posicaoIdVideoStart = strpos($url, SEPARADOR_URL2_YOUTUBE_INICIO) + strlen(SEPARADOR_URL2_YOUTUBE_INICIO);
		$tamanhoId = strlen($url) - $posicaoIdVideoStart;

			$stringSacada = substr($url, $posicaoIdVideoStart,$tamanhoId);


			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$stringSacada.'" frameborder="0" allowfullscreen></iframe>';

		}


		if(strpos($url, YOUTUBE_URL_3)) {
			echo "url é do tipo 3";
		

  		$posicaoIdVideoStart = strpos($url, SEPARADOR_URL3_YOUTUBE_INICIO) + strlen(SEPARADOR_URL3_YOUTUBE_INICIO);
		$tamanhoId = strlen($url) - $posicaoIdVideoStart;

			$stringSacada = substr($url, $posicaoIdVideoStart,$tamanhoId);


			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$stringSacada.'" frameborder="0" allowfullscreen></iframe>';

		}

		

		
  }



  	function criarImagens($url){



			preg_match('~/\K\w+(?=[^/]*$)~m', $url, $id);

 
			$final = '<img src="https://i.imgur.com/'.$id[0].'.gif">';


			return $final;


  		
  	}



  	function criarTexto(){

  		//ligaçao com o url para obter o conteudo , CURL





  	}


	function postToString($post) {
		$link=$post->getElementsByTagName('a')->item(0)->getAttribute('href').">Link";
			//$post->getElementsByTagName('a')->item(0)->getAttribute('href');

			$link2=$post->getElementsByTagName('a')->item(0)->getAttribute('href');




		return $ret = 
		   "<center><font size=".'8'."<b><u></u></b> ".obterFilhoPeloValorDoAtributoClass($post, "entry unvoted")
			->firstChild->firstChild->nodeValue."</br></font><center>".

			

			criarVideoYoutube($link2).
			criarImagens($link2).
			"<p><b>Link</b>:      "."<a href=".$link."</a>"."</br>". 
			"<b>Subrredit</b>: ".$post->getAttribute('data-subreddit')."</br>".
			"<b>Author</b>:    ".$post->getAttribute('data-author')."</br>".
			"<b>Rank</b>:      ".$post->firstChild->nextSibling->nodeValue."</br>".
			"<b>Score</b>:     ".
			obterFilhoPeloValorDoAtributoClass($post, "midcol unvoted")
			->firstChild->nextSibling->nextSibling->nodeValue."</br>";
	}

	$html = consumirUrl(REDDIT_URL);
	$dom = new DOMdocument();
	//ignorar os warnings de html mal estruturado
	@$dom->loadHTML($html);
	//siteTable é a div onde estã os posts
	$redditMainContent = $dom->getElementById('siteTable');
	//o objectivo é remover os elementos div q não têm nada lá dentro
	retirarChildNodesSemId($redditMainContent);
	$redditPosts = $redditMainContent->childNodes;

	$postNumber = $_GET['id'];
	//imprimirPosts($redditPosts);
?>