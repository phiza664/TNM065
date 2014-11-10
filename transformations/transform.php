<?php	
	


	/**
	 *  Transformes the $xmlString to appropriate output format.
	 *	@param string $xmlString the xml to stransform
	 *	@param string $format if json is specified the output will be json formatted
	 *
	 */
	function transformXML($xmlString, $format){
		# LOAD XML FILE
		$XML = new DOMDocument();
		$XML->loadXML( $xmlString );

		# START XSLT
		$xslt = new XSLTProcessor();
		$XSL = new DOMDocument();
		
		
		#OUTPUT FORMAT
		if($format == "json")
		{
			//header for outputting json data
				header("Content-type:application/json");
				$XSL->load('transformations/cards-json.xsl', LIBXML_NOCDATA);
		}
		else
		{
			// See which user agent is connecting
			// and load which xsl style sheet to use
			$UA = getenv('HTTP_USER_AGENT');
			if (preg_match("/Symbian/", $UA) | preg_match("/Opera/", $UA) | preg_match("/Nokia/", $UA)) 
			{
				// if a mobile phone, use a wml stylesheet and set appropriate MIME type
				header("Content-type:text/vnd.wap.wml");
				$XSL->load('transformations/index-wml.xsl');
			} 
			else 
			{
				
				// if not a mobile phone, use a html stylesheet
				header("Content-type:text/html");
				$XSL->load('transformations/cards-html.xsl', LIBXML_NOCDATA);
				//$xsl->load('index-rss.xsl');
			}
		
		}

		$xslt->importStylesheet( $XSL );
		#PRINT
	
		return $xslt->transformToXML( $XML );


	}

	
	
	
	
	
	
	
?>