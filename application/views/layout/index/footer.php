            </div>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/app/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/app/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/app/js/jquery.validate.min.js"></script>
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
                minlength: jQuery.validator.format("Por favor ingrese por lo menos {0} carateres."),
                rangelength: jQuery.validator.format("Por favor ingrese un valor entre {0} y {1} caracteres de largo."),
                max: jQuery.validator.format("Por favor ingrese un valor menor o igual a {0}."),
                min: jQuery.validator.format("Por favor ingrese un valor mayor o igual a {0}.")
            });

        </script>
        <?php if (isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
            <?php foreach ($_layoutParams['js'] as $layout): ?>
<script src="<?php echo $layout; ?>" type="text/javascript"></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>