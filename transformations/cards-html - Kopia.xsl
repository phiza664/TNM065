<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="cards">
  <html>
  <head>
	<link rel="stylesheet" href="design.css"/>
  </head>
  <body>
	  <script src="jquery-1.9.0.js"></script>
	  <script src="flickrTest.js"></script>
		<div id="card-container"><!--BEGIN OF CARDS div lr h2 tagg?-->
		
			
				<xsl:for-each select="card">
					<div class="card">
						<xsl:attribute name="id">
							<xsl:value-of select="Card_ID"/>
						</xsl:attribute>
						<div class="large-image-container">
							<img class="large-image">
								<xsl:attribute name="src">
									<xsl:value-of select="Image_URL"/>
								</xsl:attribute>
							</img>
						</div>
						<h2 class="card-rubrik">
							<xsl:value-of select="Title"/>
						</h2>
						<div class="text-content">
							<p>
								<span class="qoute qoute-first">&#699;</span>
								<xsl:value-of select="Content"/>
								<span class="qoute qoute-last">&#8218;</span>
							</p>
						</div>
						<div class="small-images-container">
							<xsl:attribute name="id">small-images-container<xsl:value-of select="Card_ID"/>
							</xsl:attribute>
						</div>
						
					</div>
				</xsl:for-each>
			
		
		</div><!--END OF CARDS-->
	</body>
	</html>
  </xsl:template>
</xsl:stylesheet>

