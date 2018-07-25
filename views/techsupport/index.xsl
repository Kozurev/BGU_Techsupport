<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:include href="../new_application_popup.xsl" />

    <xsl:template match="root">
        <section class="cards-section text-center">
            <div class="container">
                <div id="cards-wrapper" class="cards-wrapper row">
                    <div class="item item-red col-md-6 col-sm-12 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-comment"><div style="display:none">123</div></i>
                                <!-- <div class="icon forum"><div style="display:none">123</div></div> -->
                            </div>
                            <h3 class="title">Форум</h3>
                            <p class="intro">
                                На этой страничке вы можете описать возникшую техническую проблему по поддерживаемым управлением электронных
                                образовательных технологий системам (СЭО «Пегас» и «ИнфоБелГУ: Учебный процесс»)
                            </p>
                            <a class="link" href="forum"><span></span></a>
                        </div>
                    </div>

                    <div class="item item-primary col-md-6 col-sm-12 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-clipboard"><div style="display:none">123</div></i>
                                <!-- <div class="icon phone"><div style="display:none">123</div></div> -->
                            </div>
                            <h3 class="title">Оставить заявку</h3>
                            <p class="intro">
                                Опишите возникшую проблему. После её решения данное обращение может быть опубликовано на форуме для возможности ознакомления с этой проблемой другим людям
                            </p>
                            <a class="link applocationPopup" href="#"><span></span></a>
                        </div>
                    </div>

                    <xsl:if test="user_role = 1 or user_role = 2">
                        <div class="item item-purple col-md-6 col-sm-12 col-xs-12">

                            <xsl:if test="user_role = 2">
                                <xsl:attribute name="class">item item-purple col-md-6 col-sm-12 col-xs-12 col-md-offset-3 col-sm-offset-0 col-xs-offset-0</xsl:attribute>
                            </xsl:if>

                            <xsl:variable name="path">
                                <xsl:choose>
                                    <xsl:when test="user_role = 2">application/performer</xsl:when>
                                    <xsl:otherwise>application/list</xsl:otherwise>
                                </xsl:choose>
                            </xsl:variable>

                            <div class="item-inner">
                                <div class="icon-holder">
                                    <i class="icon fa fa-list-ul"><div style="display:none">123</div></i>
                                    <!-- <div class="icon phone"><div style="display:none">123</div></div> -->
                                </div>
                                <h3 class="title">Список заявок</h3>
                                <p class="intro">
                                    На данной странице будет представлен список всех заявок поступивших в поддержку
                                </p>
                                <a class="link" href="{$path}"><span></span></a>
                            </div>
                        </div>
                    </xsl:if>

                    <xsl:if test="user_role = 1">
                        <div class="item item-green col-md-6 col-sm-12 col-xs-12">
                            <div class="item-inner">
                                <div class="icon-holder">
                                    <!--<i class="icon fa fa-list-ul"><div style="display:none">123</div></i>-->
                                    <span aria-hidden="true" class="icon icon_datareport_alt"></span>
                                </div>
                                <h3 class="title">Статистика</h3>
                                <p class="intro">
                                    Вывод краткой сводки по поступившим заявкам в течении указанного периода
                                </p>
                                <a class="link" href="statistic"><span></span></a>
                            </div>
                        </div>
                    </xsl:if>

                    <xsl:call-template name="new_app_form" />

                </div><!--cards-wrapper-->
            </div><!--container-->
        </section>
    </xsl:template>


</xsl:stylesheet>