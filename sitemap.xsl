<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    exclude-result-prefixes="sitemap">

    <xsl:output method="html" indent="yes" />

    <!-- HTML structure -->
    <xsl:template match="/">
        <html>
        <head>
            <title>Sitemap</title>
            <style type="text/css">
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    font-size: 15px;
                }
                th, td {
                    padding: 10px;
                    border-bottom: 1px solid #ddd;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                tr:hover {
                    background-color: #f9f9f9;
                }
                .header {
                    background-color: #007BFF;
                    color: #fff;
                    padding: 3px 0;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>XML Sitemap</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Last Modified</th>
                        <th>Change Frequency</th>
                        <th>Priority</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:apply-templates select="sitemap:urlset/sitemap:url" />
                </tbody>
            </table>
        </body>
        </html>
    </xsl:template>

    <!-- How each URL should be displayed -->
    <xsl:template match="sitemap:url">
        <tr>
            <td><xsl:value-of select="sitemap:loc" /></td>
            <td><xsl:value-of select="sitemap:lastmod" /></td>
            <td><xsl:value-of select="sitemap:changefreq" /></td>
            <td><xsl:value-of select="sitemap:priority" /></td>
        </tr>
    </xsl:template>

</xsl:stylesheet>
