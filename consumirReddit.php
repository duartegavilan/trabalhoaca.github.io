<?php
define("REDDIT_URL", "https://www.reddit.com/r/progmetal");

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
					echo $filho->getAttribute('class')."\n";
					$mainContentChildNodesParaRemover[] = $filho;	
				}
			}
		}

		foreach ($mainContentChildNodesParaRemover as $filho) {
			"nada: ".$filho->nodeValue."\n";
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

	$html = consumirUrl(REDDIT_URL);
	$dom = new DOMdocument();
	//ignorar os warnings de html mal estruturado
	@$dom->loadHTML($html);
	//siteTable é a div onde estã os posts
	$redditMainContent = $dom->getElementById('siteTable');
	//o objectivo é remover os elementos div q não têm nada lá dentro
	retirarChildNodesSemId($redditMainContent);
	$redditPosts = $redditMainContent->childNodes;

	imprimirPosts($redditPosts);
?>