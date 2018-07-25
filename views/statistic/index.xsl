<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">


        <section class="cards-section text-center">
            <div class="container">

                <div class="search row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <span>Период с: </span>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <input class="form-control" type="date" name="date_from" value="{date_from}" />
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <span>по: </span>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <input class="form-control" type="date" name="date_to" value="{date_to}" />
                    </div>
                </div>


                <div class="row statistic">
                    <form id="statistic_form" method="GET" action=".">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <span>Система:</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <select class="form-control" name="systemId">
                                <option value="0"> ... </option>
                                <xsl:variable name="systemId" select="system_id" />
                                <xsl:for-each select="system">
                                    <option value="{id}">
                                        <xsl:if test="id = $systemId">
                                            <xsl:attribute name="selected">true</xsl:attribute>
                                        </xsl:if>
                                        <xsl:value-of select="title" />
                                    </option>
                                </xsl:for-each>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <span>Исполнитель:</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <select class="form-control" name="performerId">
                                <option value=""> ... </option>
                                <xsl:variable name="performerId" select="performer_id" />
                                <xsl:for-each select="performer">
                                    <option value="{id}">
                                        <xsl:if test="id = $performerId">
                                            <xsl:attribute name="selected">true</xsl:attribute>
                                        </xsl:if>
                                        <xsl:value-of select="lastname" />
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="firstname" />
                                    </option>
                                </xsl:for-each>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <span>Приоритет:</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <select class="form-control" name="priorityId">
                                <option value=""> ... </option>
                                <xsl:variable name="priorityId" select="priority_id" />
                                <xsl:for-each select="application_priority">
                                    <option value="{id}">
                                        <xsl:if test="id = $priorityId">
                                            <xsl:attribute name="selected">true</xsl:attribute>
                                        </xsl:if>
                                        <xsl:value-of select="title" />
                                    </option>
                                </xsl:for-each>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                            <a id="statistic_show" class="btn btn-green">Показать</a>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </xsl:template>


    <xsl:template match="application">
        <xsl:variable name="systemId" select="system_id" />
        <xsl:variable name="priorityId" select="priority_id" />
        <xsl:variable name="performerId" select="performer_id" />

        <tr>
            <td scope="row"><xsl:value-of select="id" /></td>
            <td>
                <xsl:choose>
                    <xsl:when test="done = 1 and done_end != ''">
                        <span class="label label-success">Done</span>
                    </xsl:when>
                    <xsl:when test="done_start != '' and done = 0">
                        <span class="label label-primary">In process</span>
                    </xsl:when>
                    <xsl:otherwise>
                        <span class="label label-danger">New</span>
                    </xsl:otherwise>
                </xsl:choose>
            </td>

            <td>
                <xsl:choose>
                    <xsl:when test="performer_id = 0">
                        Не определен
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:value-of select="/root/performer[id = $performerId]/surname" />
                        <xsl:text> </xsl:text>
                        <xsl:value-of select="/root/performer[id = $performerId]/name" />
                    </xsl:otherwise>
                </xsl:choose>
            </td>

            <td><xsl:value-of select="create_date" /></td>
            <td><xsl:value-of select="/root/application_priority[id = $priorityId]/title" /></td>
            <td><xsl:value-of select="/root/system[id = $systemId]/title" /></td>
            <!--<td><xsl:value-of select="fio" /></td>-->
        </tr>
    </xsl:template>


</xsl:stylesheet>