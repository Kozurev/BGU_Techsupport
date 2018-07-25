<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <section id="download-section" class="cards-section application">
            <div class="container">
                <h2 class="section-title">Формулировка проблемы</h2>
                <div class="section-block">
                    <xsl:value-of select="application/subject" />
                </div>

                <h2 class="section-title">Последовательность шагов, приводящих к ошибке</h2>
                <div class="section-block">
                    <p><xsl:value-of select="application/description" /></p>
                </div>
            </div>
        </section>

        <section class="cards-section text-center">
            <div class="container">
                <xsl:if test="count(application_screenshot) != 0">
                    <div class="row left">
                        <h3>Приложенные к заявке скриншоты</h3>
                        <xsl:apply-templates select="application_screenshot" />
                    </div>
                </xsl:if>

                <div class="forum">
                    <xsl:choose>
                        <xsl:when test="count(comment) != 0">
                            <h2 class="section-title">Комментарии к задаче</h2>
                        </xsl:when>
                        <xsl:otherwise>
                            <h2 class="section-title">Пока что ни одного комментария</h2>
                        </xsl:otherwise>
                    </xsl:choose>

                    <xsl:apply-templates select="comment" />

                    <xsl:if test="user/id != ''">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 comment-form">
                                <h4>Добавление комметнария к задаче</h4>
                                <h5>Вы:
                                    <span class="current-user">
                                        <xsl:value-of select="user/lastname" />
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="user/firstname" />
                                    </span>
                                </h5>

                                <script>
                                    $(function(){
                                    $("#comment-form").validate({
                                    rules: {
                                    text:   { required: true }
                                    },
                                    messages: {
                                    text:   { required: "Это поле обязателдьно к заполнению" }
                                    }
                                    });
                                    });
                                </script>

                                <form id="comment-form">
                                    <textarea class="form-control" name="text">1</textarea>
                                    <input type="hidden" name="authorId" value="{user/id}" />
                                    <input type="hidden" name="applicationId" value="{application/id}" />
                                    <script>$("textarea[name=text]").empty(); /*TODO: снова костыль*/ </script>
                                </form>


                                <div class="comment-buttons">
                                    <a href="#" class="btn btn-green" id="add_comment">Добавить</a>
                                </div>
                            </div>
                        </div>
                    </xsl:if>

                </div>

            </div><!--container-->
        </section>

    </xsl:template>


    <xsl:template match="application_screenshot">
        <div class="screenshots">
            <div class="col-md-4 col-sm-12 col-sm-12">
                <h6>Скринщот №<xsl:value-of select="position()" /></h6>
                <!--<p>Project management</p>-->
                <div class="screenshot-holder">
                    <a href="" data-title="Скринщот №{position()}" data-toggle="lightbox">
                        <img class="img-responsive" src="{path}" alt="screenshot" width="900px" />
                    </a>
                    <a class="mask" href="{path}" data-title="Скринщот №{position()}" data-toggle="lightbox">
                        <i class="icon fa fa-search-plus"><input type="hidden" /></i>
                    </a>
                </div>
            </div>
        </div>
    </xsl:template>


    <xsl:template match="comment">
        <div class="message">
            <div class="head">
                <div class="username">
                    <xsl:value-of select="lastname" />
                    <xsl:text> </xsl:text>
                    <xsl:value-of select="firstname" />
                </div>
                <div class="datetime">
                    <xsl:value-of select="create_date" />
                </div>
            </div>

            <div class="body">
                <xsl:value-of select="text" />
            </div>
        </div>
    </xsl:template>


</xsl:stylesheet>