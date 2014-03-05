<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output indent="no" omit-xml-declaration="yes" method="text" encoding="UTF-8" media-type="text/x-json"/>
<xsl:template match="cards">
({	
	"cards": [
	<xsl:for-each select="card" >
		{
			<xsl:for-each select="child::*">"<xsl:value-of select="name(.)"/>": "<xsl:value-of select="."/>",
			</xsl:for-each>
		}
		<xsl:if test="position() != last()" >,</xsl:if>
	</xsl:for-each>
	]
})
  </xsl:template>
</xsl:stylesheet>
