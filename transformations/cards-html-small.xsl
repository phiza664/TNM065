<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output indent="no" omit-xml-declaration="yes" method="html" encoding="UTF-8" media-type="text/html"/>
  <xsl:template match="cards">
	<div id="card-container"><!--BEGIN OF CARDS div lr h2 tagg?-->
		 <xsl:for-each select="card"> 
			<div class="card">
				<xsl:attribute name="data-card-id">
					<xsl:value-of select="Card_ID"/>
				</xsl:attribute>
				<xsl:attribute name="data-user-id">
					<xsl:value-of select="User_ID"/>
				</xsl:attribute>
				<div class="small-image-container">
					<img class="small-image">
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
						<span class="text-content-text"><xsl:value-of select="Content"/></span>
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

  </xsl:template>
</xsl:stylesheet>

