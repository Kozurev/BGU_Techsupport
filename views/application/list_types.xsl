<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <!--<header class="header">-->
            <!--<div class="container">-->
                <!--<div class="branding">-->
                    <!--<h1 class="logo">-->
                        <!--<a href="#">-->
                            <!--<span aria-hidden="true" class="icon_documents_alt icon"><input type="hidden"/></span>-->
                            <!--<span class="text-highlight">ТИПЫ СПИСКОВ </span><span class="text-bold">ЗАЯВОК</span>-->
                        <!--</a>-->
                    <!--</h1>-->
                <!--</div>-->

                <!--<ol class="breadcrumb">-->
                    <!--<xsl:for-each select="breadcumbs/item">-->
                        <!--<li>-->
                            <!--<xsl:choose>-->
                                <!--<xsl:when test="active = 1 or path = ''">-->
                                    <!--<xsl:attribute name="class">active</xsl:attribute>-->
                                    <!--<xsl:value-of select="title" />-->
                                <!--</xsl:when>-->
                                <!--<xsl:otherwise>-->
                                    <!--<a href="{href}">-->
                                        <!--<xsl:value-of select="title" />-->
                                    <!--</a>-->
                                <!--</xsl:otherwise>-->
                            <!--</xsl:choose>-->
                        <!--</li>-->
                    <!--</xsl:for-each>-->
                <!--</ol>-->

                <!--&lt;!&ndash;<div class="tagline">&ndash;&gt;-->
                    <!--&lt;!&ndash;<p>«Новые задачи» - список новых заявок.</p>&ndash;&gt;-->
                    <!--&lt;!&ndash;<p>«В работе» - список заявок, находящихся в работе.</p>&ndash;&gt;-->
                    <!--&lt;!&ndash;<p>«Общий список» - список всех обращений за указанный период.</p>&ndash;&gt;-->
                <!--&lt;!&ndash;</div>&ndash;&gt;-->
            <!--</div>-->
        <!--</header>-->


        <section class="cards-section text-center">
            <div class="container">

                <h2 class="title">Выберите формат списка заявок</h2>
                <div class="intro">
                    <!--<p>Welcome to prettyDocs. This landing page is an example of how you can use a card view to present segments of your documentation. You can customise the icon fonts based on your needs.</p>-->
                    <!--<div class="cta-container">-->
                        <!--<a class="btn btn-primary btn-cta" href="http://themes.3rdwavemedia.com/" target="_blank"><i class="fa fa-cloud-download"></i> Download Now</a>-->
                    <!--</div>&lt;!&ndash;//cta-container&ndash;&gt;-->
                </div><!--//intro-->
                <div id="cards-wrapper" class="cards-wrapper row">

                    <div class="item item-green col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-star"><div style="display:none">123</div></i>
                                <!-- <div class="icon people"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Новые задачи</h3>
                            <p class="intro">Список новых заявок</p>
                            <a class="link" href="list/new"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-primary col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-cog"><div style="display:none">123</div></i>
                                <!-- <div class="icon people"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">В работе</h3>
                            <p class="intro">Список заявок, находящихся на исполнении</p>
                            <a class="link" href="list/performance"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-orange col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-history"><div style="display:none">123</div></i>
                                <!-- <div class="icon people"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Общий список</h3>
                            <p class="intro">Список всех заявок за указанный период</p>
                            <a class="link" href="list/all"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                </div><!--//cards-->

                <div class="callout-block callout-info">
                    <div class="icon-holder">
                        <i class="fa fa-info-circle"><input type="hidden"/></i>
                    </div>

                    <div class="content">
                        <h4 class="callout-title">Работа со списком заявок</h4>
                        <p>Переход на страницу заявки для просмотра подробной информации и изменения параметров осуществляется по клику на тему обращения.</p>
                        <p>Имеется возможность сортировки записей в списке. По умолчанию записи отсортированы по дате создания.
                            Для сортировки необходимо кликнуть по заголовку столбца таблицы.
                            Для сортировки в обратном порядке необходимо повторно нажать на название столбца.</p>
                    </div>
                </div>

            </div>

            <!--<div class="callout-block callout-info">-->
                <!--<div class="icon-holder">-->
                    <!--<i class="fa fa-info-circle"><input type="hidden"/></i>-->
                <!--</div>-->

                <!--<div class="content">-->
                    <!--<h4 class="callout-title">Содержание разделов</h4>-->
                    <!--<p>«Новые задачи» - список новых заявок.</p>-->
                    <!--<p>«В работе» - список заявок, находящихся в работе.</p>-->
                    <!--<p>«Общий список» - список всех обращений за указанный период.</p>-->
                <!--</div>-->
            <!--</div>-->

        </section>


    </xsl:template>

</xsl:stylesheet>