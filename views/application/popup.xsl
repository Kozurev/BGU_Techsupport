<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <script>
            $(function(){
                $("form[name=application]").validate({
                    rules: {
                        subject:        { required: true },
                        description:    { required: true },
                        fio:            { required: true, maxlength: 255 },
                        email:          { maxlength: 45 },
                    },
                    messages: {
                        subject:        { required: "Это поле обязателдьно к заполнению" },
                        description:    { required: "Это поле обязателдьно к заполнению" },
                        fio:            { required: "Это поле обязателдьно к заполнению", maxlength: "Длинна значения данного поля не должна превышаьть 255 символов" },
                        email:          { maxlength: "Длина значения не должна превышать 45 символов" },
                    }
                });
            });
        </script>

        <form class="application_popup" method="POST" enctype="multipart/form-data" action="application/save" name="application">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span class="required">К какой системе относится запрос</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <select name="systemId" class="form-control">
                        <xsl:for-each select="system">
                            <option value="{id}">
                                <xsl:value-of select="title" />
                            </option>
                        </xsl:for-each>
                    </select>
                </div>
            </div>

            <div class="row title">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Описание проблемы</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span class="required">Формулировка проблемы</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" name="subject"/>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span class="required">
                        Последовательность шагов, <br/>
                        приводящих к ошибке
                    </span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <textarea name="description" class="form-control textarea">1</textarea>
                    <script>
                        /**
                         * TODO: ВНИМАНИЕ, КОСТЫЛЬ!!! Сделайте что-то с этим ужасом
                         * Мудла решила, что самая умная, и закрывает МОИ(!) пустые тэги не так как положено
                         * простите :(
                         */
                        $("textarea[name=description]").empty();
                    </script>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span class="required">ФИО</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input name="fio" class="form-control">
                        <xsl:if test="count(user) != 0">
                            <xsl:attribute name="value">
                                <xsl:value-of select="user/lastname" />
                                <xsl:text> </xsl:text>
                                <xsl:value-of select="user/firstname" />
                            </xsl:attribute>
                        </xsl:if>
                    </input>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span>Email</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input type="text" name="email" class="form-control" />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span>Получать уведомления по почте</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: left">
                    <input type="checkbox" class="checkbox" name="email_notification" />
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <span>Изображения ошибок</span>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input type="file" name="screenshots[]" multiple="multiple" id="images" />
                </div>
            </div>

            <input type="hidden" name="ajax" value="1" />

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-green application_submit">Отправить</button>
                </div>
            </div>

        </form>
    </xsl:template>

</xsl:stylesheet>