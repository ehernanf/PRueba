</div>
<!-- END MAIN PANEL -->
<!-- PAGE FOOTER -->

<div class="page-footer" >
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white"><?= APP_NAME; ?> &copy;2016</span>
        </div>

        <div class="col-xs-6 col-sm-6 text-right hidden-xs">
            <div class="txt-color-white inline-block">
                <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE FOOTER -->

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut"></div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= BASE_URL; ?>public/js/plugin/pace/pace.min.js"></script>-->



<!-- IMPORTANT: APP CONFIG -->
<script src="<?= BASE_URL; ?>public/js/libs/jquery-2.1.1.min.js"></script>
<script src="<?= BASE_URL; ?>public/js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="<?= BASE_URL; ?>public/js/app.config.js"></script>

<script src="<?= BASE_URL; ?>public/js/jquery.keyboard.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?= BASE_URL; ?>public/js/bootstrap/bootstrap.min.js"></script>
<!-- CUSTOM NOTIFICATION -->
<script src="<?= BASE_URL; ?>public/js/notification/SmartNotification.min.js"></script>
<!-- JQUERY VALIDATE -->
<script src="<?= BASE_URL; ?>public/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= BASE_URL; ?>public/js/headers.js"></script>
<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->


<!-- MAIN APP JS FILE -->
<script src="<?= BASE_URL; ?>public/js/app.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>public/app/js/base.js"></script>

<script type="text/javascript">
    var CI = <?php echo json_encode($this->CI); ?>;
    $.extend(jQuery.validator.messages, {
        required: "Campo obligatorio",
        email: "Ingrese un email válido",
        date: "Ingrese una fecha válida",
        number: "Solo se permiten números",
        digits: "Solo se permiten números",
        range: jQuery.validator.format("Por favor ingrese un valor  entre {0} y {1}."),
        maxlength: jQuery.validator.format("Por favor ingrese a lo más {0} caracteres."),
        minlength: jQuery.validator.format("Por favor ingrese por lo menos {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor ingrese un valor entre {0} y {1} caracteres de largo."),
        max: jQuery.validator.format("Por favor ingrese un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor ingrese un valor mayor o igual a {0}.")
    });

</script>


<?PHP if (isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
    <?PHP foreach ($_layoutParams['js'] as $layout): ?>
        <script src="<?= $layout ?>" type="text/javascript"></script>
    <?PHP endforeach; ?>
<?PHP endif; ?>

<script>
    $(document).ready(function () {
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        pageSetUp();
        /*
         * PAGE RELATED SCRIPTS
         */
        $(".js-status-update a").click(function () {
            var selText = $(this).text();
            var $this = $(this);
            $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
            $this.parents('.dropdown-menu').find('li').removeClass('active');
            $this.parent().addClass('active');
        });
        /*
         * TODO: add a way to add more todo's to list
         */
        // initialize sortable
        $(function () {
            $("#sortable1, #sortable2").sortable({
                handle: '.handle',
                connectWith: ".todo",
                update: countTasks
            }).disableSelection();
        });

        // check and uncheck
        $('.todo .checkbox > input[type="checkbox"]').click(function () {
            var $this = $(this).parent().parent().parent();
            if ($(this).prop('checked')) {
                $this.addClass("complete");
                // remove this if you want to undo a check list once checked
                //$(this).attr("disabled", true);
                $(this).parent().hide();
                // once clicked - add class, copy to memory then remove and add to sortable3
                $this.slideUp(500, function () {
                    $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                    $this.remove();
                    countTasks();
                });
            } else {
                // insert undo code here...
            }
        })
        // count tasks
        function countTasks() {
            $('.todo-group-title').each(function () {
                var $this = $(this);
                $this.find(".num-of-tasks").text($this.next().find("li").size());
            });
        }


        /* hide default buttons */
        $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();

        // calendar prev
        $('#calendar-buttons #btn-prev').click(function () {
            $('.fc-prev-button').click();
            return false;
        });

        // calendar next
        $('#calendar-buttons #btn-next').click(function () {
            $('.fc-next-button').click();
            return false;
        });

        // calendar today
        $('#calendar-buttons #btn-today').click(function () {
            $('.fc-button-today').click();
            return false;
        });

        // calendar month
        $('#mt').click(function () {
            $('#calendar').fullCalendar('changeView', 'month');
        });

        // calendar agenda week
        $('#ag').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });

        // calendar agenda day
        $('#td').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });

    });

</script>
</body>
</html>