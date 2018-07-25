<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">
        <!-- ******Header****** -->
        <!--<header class="header text-center">-->
            <!--<div class="container">-->
                <!--<div class="branding">-->
                    <!--<h1 class="logo">-->
                        <!--<span class="text-bold">Служба технической поддержки управления электронных образовательных технологий</span>-->
                    <!--</h1>-->
                <!--</div>-->
                <!--&lt;!&ndash; <div class="tagline">-->
                    <!--<p></p>-->
                    <!--<p>Designed with <i class="fa fa-heart"></i> for developers</p>-->
                <!--</div> &ndash;&gt;-->
            <!--</div>-->
        <!--</header>-->

        <section class="cards-section text-center">
            <div class="container">

                <h2 class="title">Выберите интересующий Вас раздел</h2>
                <!--<div class="intro">-->
                <!--<p>Welcome to prettyDocs. This landing page is an example of how you can use a card view to present segments of your documentation. You can customise the icon fonts based on your needs.</p>-->
                <!--<div class="cta-container">-->
                <!--<a class="btn btn-primary btn-cta" href="http://themes.3rdwavemedia.com/" target="_blank"><i class="fa fa-cloud-download"></i> Download Now</a>-->
                <!--</div>&lt;!&ndash;//cta-container&ndash;&gt;-->
                <!--</div>&lt;!&ndash;//intro&ndash;&gt;-->
                <div id="cards-wrapper" class="cards-wrapper row">

                    <div class="item item-green col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-ambulance"><div style="display:none">123</div></i>
                                <!-- <div class="icon people"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Электронная система технической поддержки</h3>
                            <!--<p class="intro">Demo example, consectetuer adipiscing elit</p>-->
                            <a class="link" href="support"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-blue item-2 col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-envelope"><div style="display:none">123</div></i>
                                <!--<span aria-hidden="true" class="icon icon_puzzle_alt"></span>-->
                                <!-- <div class="icon email"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Обращения по email: sdoadmin@bsu.edu.ru</h3>
                            <!--<p class="intro">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>-->
                            <a class="link" href="mailto:sdoadmin@bsu.edu.ru?subject=Техподдержка%20управления%20электронных%20образовательных%20технологий"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-pink col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-cogs"><div style="display:none">123</div></i>
                                <!--<span aria-hidden="true" class="icon icon_datareport_alt"></span>-->
                                <!-- <div class="icon instructions"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Инструкции</h3>
                            <!--<p class="intro">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>-->
                            <a class="link" href="instructions"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-purple col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-list-alt"><div style="display:none">123</div></i>
                                <!--<span aria-hidden="true" class="icon icon_lifesaver"></span>-->
                                <!-- <div class="icon schedule"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Расписание тематических метод. семинаров</h3>
                            <!--<p class="intro">Layout for FAQ page. Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>-->
                            <a class="link" href="#"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-primary col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-fax"><div style="display:none">123</div></i>
                                <!--<span aria-hidden="true" class="icon icon_genius"></span>-->
                                <!-- <div class="icon phone"><div style="display:none">123</div></div> -->
                            </div><!--//icon-holder-->
                            <h3 class="title">Горячая линия <br/> (4722) 30-18-77</h3>
                            <!--<p class="intro">Layout for showcase page. Lorem ipsum dolor sit amet, consectetuer adipiscing elit </p>-->
                            <a class="link" href="#"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->

                    <div class="item item-orange col-md-4 col-sm-6 col-xs-12">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-book"><div style="display:none">123</div></i>
                                <!--<span aria-hidden="true" class="icon icon_gift"></span>-->
                            </div><!--//icon-holder-->
                            <h3 class="title">Регламент работы службы технической поддержки управления электронных образовательных технологий</h3>
                            <!--<p class="intro">Layout for license &amp; credits page. Consectetuer adipiscing elit.</p>-->
                            <a class="link" href="reglament"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
                </div><!--//cards-->
            </div>
        </section>
    </xsl:template>

</xsl:stylesheet>