<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <style type="text/css">
            .breadcrumb {
                margin-bottom: 20px;
            }
        </style>

        <header class="header">
            <div class="container">
                <div class="branding">
                    <h1 class="logo">
                        <xsl:if test="title-big != ''">
                            <span class="text-bold"><xsl:value-of select="title-big" /></span>
                        </xsl:if>

                        <xsl:if test="title-first != '' or title-second != ''">
                            <a href="#">
                                <span aria-hidden="true" class="icon_documents_alt icon"></span>
                                <span class="text-highlight"><xsl:value-of select="title-first" /></span>
                                <span class="text-bold">
                                    <xsl:text> </xsl:text>
                                    <xsl:value-of select="title-second" />
                                </span>
                            </a>
                        </xsl:if>
                    </h1>
                </div>

                <ol class="breadcrumb">
                    <xsl:apply-templates select="breadcumb" />
                </ol>

                <xsl:if test="count(page-description) &gt; 0">
                    <div class="tagline">
                        <xsl:apply-templates select="page-description" />
                    </div>
                </xsl:if>

            </div>
        </header>

    </xsl:template>


    <xsl:template match="page-description">
        <p><xsl:value-of select="description" /></p>
    </xsl:template>


    <xsl:template match="breadcumb">
        <xsl:choose>
            <xsl:when test="active = 1">
                <li class="active"><xsl:value-of select="title" /></li>
            </xsl:when>
            <xsl:otherwise>
                <li><a href="{href}"><xsl:value-of select="title" /></a></li>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>


</xsl:stylesheet>