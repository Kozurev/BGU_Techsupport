<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="root">

        <style>
            .status {
            display: inline-block;
            height: 26px;
            width: 26px;
            background-size: cover;
            }

            .done {
            background-image: url("<xsl:value-of select="dataroot" />/templates/template1/assets/images/checked.png");
            }

            .not_done {
            background-image: url("<xsl:value-of select="dataroot" />/templates/template1/assets/images/unchecked.png");
            }
        </style>


        <section class="cards-section text-center">

            <div class="container">
                <div class="search row">

                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <span>Период с: </span>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                        <input class="form-control" type="date" id="date_from" value="{date_from}" />
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                        <span>по: </span>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2">
                        <input class="form-control" type="date" id="date_to" value="{date_to}" />
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 col-xs-offset-0 col-sm-offset-3 col-md-offset-0 col-lg-offset-0 col-lg-offset-0">
                        <a href="#" id="applications_show" class="btn btn-purple">Найти</a>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th >№</th>
                                <th>Статус</th>
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

            </div><!--container-->
        </section>

    </xsl:template>


    <xsl:template match="application">
        <tr>
            <td scope="row"><xsl:value-of select="id" /></td>

            <td>
                <xsl:choose>
                    <xsl:when test="done = 1">
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

            <td><xsl:value-of select="create_date" /></td>
            <td><a href="list/{id}"><xsl:value-of select="subject" /></a></td>
            <td><xsl:value-of select="title" /></td>
            <td><xsl:value-of select="fio" /></td>
        </tr>
    </xsl:template>


</xsl:stylesheet>