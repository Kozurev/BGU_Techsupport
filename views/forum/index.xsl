<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:include href="../new_application_popup.xsl" />

    <xsl:template match="root">
        <section class="cards-section text-center">
            <div class="container">

                <input type="hidden" id="wwwroot" value="{dir_root}" />

                <div class="search row">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <span>Поиск: </span>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <input class="form-control" id="searching_string" placeholder="Введите ключевые слова для поиска" value="{search}" />
                        <div class="search_result">
                            <ul></ul>
                        </div>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#" class="btn btn-green show_result">Найти</a>
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#" class="btn btn-primary applocationPopup">Оставить заявку</a>
                    </div>
                </div>

                <xsl:choose>
                    <xsl:when test="count(application) != 0">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Дата</th>
                                        <th>Тема</th>
                                        <th>Система</th>
                                        <th>ФИО</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:apply-templates select="application" />
                                </tbody>
                            </table>
                        </div>

                        <xsl:apply-templates select="pagination" />
                    </xsl:when>
                    <xsl:otherwise>
                        <h2>Обращений по вашему запросу: "<xsl:value-of select="search" />" не найдено</h2>
                    </xsl:otherwise>
                </xsl:choose>
            </div><!--container-->
        </section>

        <xsl:call-template name="new_app_form" />
    </xsl:template>


    <xsl:template match="application">
        <xsl:variable name="system_id" select="system_id" />

        <tr>
            <td scope="row"><xsl:value-of select="id" /></td>
            <td><xsl:value-of select="create_date" /></td>
            <td><a href="{/root/dir_root}/forum/{id}"><xsl:value-of select="subject" /></a></td>
            <td><xsl:value-of select="/root/system[id = $system_id]/title" /></td>
            <td><xsl:value-of select="fio" /></td>
        </tr>
    </xsl:template>


    <xsl:template match="pagination">
        <div class="pagination1">
            <a class="prev_page" href="#" >
                <xsl:choose>
                    <xsl:when test="page = '1'">
                        <xsl:attribute name="href"><xsl:value-of select="wwwroot" />/forum/page/1</xsl:attribute>
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:attribute name="href"><xsl:value-of select="wwwroot" />/forum/page/<xsl:value-of select="page - 1" /></xsl:attribute>
                    </xsl:otherwise>
                </xsl:choose>
                <input type="hidden" />
            </a>

            <span class="current_page">
                Страница <xsl:value-of select="page" /> из <xsl:value-of select="count_pages" />
            </span>

            <a class="next_page" href="#" >
                <xsl:choose>
                    <xsl:when test="page = count_pages">
                        <xsl:attribute name="href"><xsl:value-of select="wwwroot" />/forum/page/<xsl:value-of select="count_pages" /></xsl:attribute>
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:attribute name="href"><xsl:value-of select="wwwroot" />/forum/page/<xsl:value-of select="page + 1" /></xsl:attribute>
                    </xsl:otherwise>
                </xsl:choose>
                <input type="hidden" />
            </a>

            <br/>

            <span class="total_count">Всего элементов: <xsl:value-of select="total_count" /></span>
        </div>
    </xsl:template>


</xsl:stylesheet>