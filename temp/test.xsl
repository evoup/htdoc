<?xml   version="1.0"   encoding="GB2312"   ?>  
  <xsl:stylesheet   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"   version="1.0">    
  <xsl:output   method="html"   version="1.0"   encoding="GB2312"   indent="yes"   />  
      <xsl:template   match="/">  
        <html>  
        <head>  
          <title><xsl:value-of   select="/data/id"   /></title>  
        </head>  
        </html>  
      </xsl:template>  
  </xsl:stylesheet>   