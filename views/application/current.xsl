<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <section class="cards-section text-center">
            <div class="container application">
                <xsl:if test="user_role_id = 1">
                    <div class="row criterias">
                        <form id="app_form" method="GET" action=".">


                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span>Система, к которой относится запрос</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <select class="form-control" name="systemId">
                                    <xsl:variable name="systemId" select="application/system_id" />
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
                                <span>Уровень приоритета</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <select class="form-control" name="priorityId">
                                    <xsl:variable name="priorityId" select="application/priority_id" />
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


                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span>Исполнитель</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <select class="form-control" name="performerId">
                                    <option value="0">Не определен</option>
                                    <xsl:variable name="performerId" select="application/performer_id" />
                                    <xsl:for-each select="performer">
                                        <xsl:variable name="id" select="id" />
                                        <option value="{$id}">
                                            <xsl:if test="$id = $performerId">
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
                                <span>Заявка поступила от</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="white_bg">
                                    <span>
                                        <xsl:value-of select="application/fio" />
                                        <xsl:if test="application/email != ''">,<br/>
                                            <xsl:value-of select="application/email" />
                                        </xsl:if>
                                    </span>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span>Публичность</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <select name="isPublic" class="form-control">
                                    <option value="0">Нет</option>
                                    <option value="1">
                                        <xsl:if test="application/is_public = 1">
                                            <xsl:attribute name="selected">selected</xsl:attribute>
                                        </xsl:if>
                                        Да
                                    </option>
                                </select>
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span>Задача создана:</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="white_bg"><span><xsl:value-of select="application/create_date" /></span></div>
                            </div>


                            <xsl:if test="application/done_start != ''">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-6 col-md-offset-6">
                                    <span>Задача принята на выполнение:</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="white_bg"><span><xsl:value-of select="application/done_start" /></span></div>
                                </div>
                            </xsl:if>


                            <xsl:if test="application/done = 1 and application/done_end != ''">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-lg-offset-6 col-md-offset-6">
                                    <span>Задача выполнена: </span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="white_bg"><span><xsl:value-of select="application/done_end" /></span></div>
                                </div>
                            </xsl:if>

                        </form>
                    </div><!--row-->
                </xsl:if>

                <section id="download-section" class="cards-section left">
                    <div class="container">
                        <h2 class="section-title">Формулировка проблемы</h2>
                        <div class="section-block">
                            <xsl:value-of select="application/subject" />
                        </div>

                        <h2 class="section-title">Последовательность шагов, приводящих к ошибке</h2>
                        <div class="section-block">
                            <p><xsl:value-of select="application/description" /></p>
                        </div>

                        <xsl:if test="count(application_screenshot) != 0">
                            <h2 class="section-title">Приложенные к заявке скриншоты</h2>
                            <xsl:apply-templates select="application_screenshot" />
                        </xsl:if>
                    </div>
                </section>

                <xsl:if test="user_role_id = 1 or user_role_id = 2">
                    <div class="row buttons">
                        <input type="hidden" id="application_id" value="{application/id}" />

                        <xsl:choose>
                            <xsl:when test="application/done_start != '' and application/done = 0">
                                <a href="#" class="btn btn-green" id="mark_as_done">Задача выполнена</a>
                            </xsl:when>
                            <xsl:when test="application/done = 1">
                                <a href="#" class="btn btn-orange" id="mark_as_in_process">Вернуться к работе</a>
                            </xsl:when>
                            <xsl:otherwise>
                                <a href="#" class="btn btn-blue" id="mark_as_in_process">Приступить к работе</a>
                            </xsl:otherwise>
                        </xsl:choose>

                        <xsl:if test="user_role_id = 1">
                            <a href="#" id="app_save" class="btn btn-primary">Сохранить изменения</a>
                            <a href="#" id="app_delete" class="btn btn-red">Удалить заявку</a>
                        </xsl:if>
                    </div>
                </xsl:if>

                <section class="doc-section left">
                    <div class="container forum">
                        <h2 class="section-title" style="margin-bottom: 20px;">Комментарии к задаче</h2>

                        <xsl:apply-templates select="comment" />

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 comment-form">
                                <h4>Добавление комметнария к задаче</h4>
                                <h5>Вы:
                                    <span class="current-user">
                                        <xsl:value-of select="user/lastname" />
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="user/firstname" />
                                        <xsl:text> </xsl:text>
                                        <xsl:variable name="roleId" select="user_role_id" />
                                        (<xsl:value-of select="user_role[id = $roleId]/title" />)
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
                    </div>
                </section>

                <div class="callout-block callout-info">
                    <div class="icon-holder">
                        <i class="fa fa-info-circle"><input type="hidden"/></i>
                    </div><!--//icon-holder-->
                    <div class="content">
                        <h4 class="callout-title">Работа с заявкой</h4>
                        <p>Параметр "Публичность" указывает будет ли эта заявка общедоступна на форуме или нет.</p>
                    </div><!--//content-->
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

                    <xsl:variable name="roleId" select="role_id" />
                    (<xsl:value-of select="/root/user_role[id = $roleId]/title" />)
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