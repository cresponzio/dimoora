<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dimoora</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <!--STYLESHEET-->
        <!--=================================================-->

        <!--Roboto Slab Font [ OPTIONAL ] -->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400" rel="stylesheet">
        <!--Bootstrap Stylesheet [ REQUIRED ]-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--Jasmine Stylesheet [ REQUIRED ]-->
        <link href="css/style.css" rel="stylesheet">
        <!--footer Stylesheet [ REQUIRED ]-->
        <link href="css/footer.css" rel="stylesheet">
        <!--Font Awesome [ OPTIONAL ]-->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!--Switchery [ OPTIONAL ]-->
        <link href="plugins/switchery/switchery.min.css" rel="stylesheet">
        <!--Bootstrap Select [ OPTIONAL ]-->
        <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <!--Bootstrap Tags Input [ OPTIONAL ]-->
        <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
        <!--Jquery Tag It [ OPTIONAL ]-->
        <link href="plugins/tag-it/jquery.tagit.css" rel="stylesheet">
        <!--Ion.RangeSlider [ OPTIONAL ]-->
        <link href="plugins/ion-rangeslider/ion.rangeSlider.css" rel="stylesheet">
        <link href="plugins/ion-rangeslider/ion.rangeSlider.skinNice.css" rel="stylesheet">
        <!--Chosen [ OPTIONAL ]-->
        <link href="plugins/chosen/chosen.min.css" rel="stylesheet">
        <!--noUiSlider [ OPTIONAL ]-->
        <link href="plugins/noUiSlider/jquery.nouislider.min.css" rel="stylesheet">
        <link href="plugins/noUiSlider/jquery.nouislider.pips.min.css" rel="stylesheet">
        <!--Bootstrap Timepicker [ OPTIONAL ]-->
        <link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <!--Bootstrap Datepicker [ OPTIONAL ]-->
        <link href="plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <!--Dropzone [ OPTIONAL ]-->
        <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
        <!--Summernote [ OPTIONAL ]-->
        <link href="plugins/summernote/summernote.min.css" rel="stylesheet">
        <!--Demo [ DEMONSTRATION ]-->
        <link href="css/demo/jasmine.css" rel="stylesheet">
        <!--/STYLESHEET-->
        <!--=================================================-->
        <!--Page Load Progress Bar [ OPTIONAL ]-->
        <link href="plugins/pace/pace.min.css" rel="stylesheet">
        <script src="plugins/pace/pace.min.js"></script>
    </head>
    <body>
        <!--HEADER-->
        <?php include("header.php") ?>
        <!--===================================================-->

        <!--CONTAINER-->
        <div id="container" class="effect mainnav-full">
            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <section id="content-container">
                    <!--Page content-->
                    <section id="page-content">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4">
                                <!--Panel Content-->
                                <div class="panel">
                                    <h4 style="text-align: center; font-weight: bold" class="panel-title">Fai una richiesta. Dimoora è qui per te</h4> 
                                    <!-- FORM ELEMENTS -->
                                    <form class="panel-body form-horizontal">
                                        <div class="form-group">
                                            <label style="font-weight: bold; text-align:left" class="col-xs-12 control-label" for="demo-textarea-input"><img src="images/icons/red-message.png">&nbsp;Descrivi il servizio a cui sei interessato, sii il più dettagliato possibile</label>
                                            <div class="col-xs-12">
                                                <textarea id="demo-textarea-input" rows="5" class="form-control" placeholder="Sono interessato a:"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold; text-align:left" class="control-label col-xs-12"><img src="images/icons/red-right.png">&nbsp;Una volta effettuata la richiesta, quando vorresti ricevere le proposte?</label>
                                            <div class="col-xs-12">
                                                <!-- Default Bootstrap Select -->
                                                <select class="form-control selectpicker">
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                </select>
                                                <!--===================================================-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold; text-align:left" class="control-label col-xs-12"><img src="images/icons/red-plus.png">&nbsp;Scegli una categoria</label>
                                            <div class="col-xs-12">
                                                <!-- Default Bootstrap Select -->
                                                <select class="form-control selectpicker">
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                    <option>Lorem ipsum sin dolr</option>
                                                </select>
                                                <!--===================================================-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold; text-align:left" class="col-xs-12 control-label" for="demo-text-input"><img src="images/icons/red-euro.png">&nbsp;Qual'è il tuo budget</label>
                                            <div class="col-xs-12">
                                                <input type="text" id="demo-text-input" class="form-control" placeholder="€ Lorem ipsum sin dolr">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <button class="btn btn-block" style="font-size:16px; padding:10px; background-color:#fd5962; color:white">Invia Richiesta</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--===================================================-->
                                    <!--End Form Elements-->
                                </div>
                                <!--===================================================-->
                                <!--End Panel-->
                            </div>
                        </div>
                    </section>
                    <!--===================================================-->
                    <!--End page content-->
                </section>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
            </div>
        </div>
        <!--===================================================-->
        <!-- END OF CONTAINER -->

                    <!-- FOOTER -->
            <?php include("footer.php") ?>
            <!--===================================================-->


        <!--JAVASCRIPT-->
        <!--jQuery [ REQUIRED ]-->
        <script src="js/jquery-2.1.1.min.js"></script>
        <!--jQuery UI [ REQUIRED ]-->
        <script src="js/jquery-ui.min.js"></script>
        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="js/bootstrap.min.js"></script>
        <!--Fast Click [ OPTIONAL ]-->
        <script src="plugins/fast-click/fastclick.min.js"></script>
        <!--Jquery Nano Scroller js [ REQUIRED ]-->
        <script src="plugins/nanoscrollerjs/jquery.nanoscroller.min.js"></script>
        <!--Metismenu js [ REQUIRED ]-->
        <script src="plugins/metismenu/metismenu.min.js"></script>
        <!--Jasmine Admin [ RECOMMENDED ]-->
        <script src="js/scripts.js"></script>
        <!--Switchery [ OPTIONAL ]-->
        <script src="plugins/switchery/switchery.min.js"></script>
        <!--Bootstrap Select [ OPTIONAL ]-->
        <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!--Bootstrap Tags Input [ OPTIONAL ]-->
        <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <!--Bootstrap Tags Input [ OPTIONAL ]-->
        <script src="plugins/tag-it/tag-it.min.js"></script>
        <!--Chosen [ OPTIONAL ]-->
        <script src="plugins/chosen/chosen.jquery.min.js"></script>
        <!--noUiSlider [ OPTIONAL ]-->
        <script src="plugins/noUiSlider/jquery.nouislider.all.min.js"></script>
        <!--Bootstrap Timepicker [ OPTIONAL ]-->
        <script src="plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <!--Bootstrap Datepicker [ OPTIONAL ]-->
        <script src="plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <!--Dropzone [ OPTIONAL ]-->
        <script src="plugins/dropzone/dropzone.min.js"></script>
        <!--Dropzone [ OPTIONAL ]-->
        <script src="plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
        <!--Masked Input [ OPTIONAL ]-->
        <script src="plugins/masked-input/jquery.maskedinput.min.js"></script>
        <!--Summernote [ OPTIONAL ]-->
        <script src="plugins/summernote/summernote.min.js"></script>
        <!--Fullscreen jQuery [ OPTIONAL ]-->
        <script src="plugins/screenfull/screenfull.js"></script>
        <!--Form Component [ SAMPLE ]-->
        <script src="js/demo/form-component.js"></script>
    </body>
</html>
