<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" doctype-public="XSLT-compat" omit-xml-declaration="yes"/>
    <xsl:template match="/">
        <html>
        <head>
            <title>Sitemap</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; border: 1px solid #ddd; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h1>Sitemap</h1>
            <table>
                <tr>
                    <th>URL</th>
                    <th>Priority</th>
                    <th>Change Frequency</th>
                    <th>Last Modified</th>
                </tr>
                <xsl:for-each select="urlset/url">
                    <tr>
                        <td><xsl:value-of select="loc"/></td>
                        <td><xsl:value-of select="priority"/></td>
                        <td><xsl:value-of select="changefreq"/></td>
                        <td><xsl:value-of select="lastmod"/></td>
                    </tr>
                </xsl:for-each>
            </table>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
