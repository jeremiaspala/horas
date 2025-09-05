


                <!-- CONTENT AREA -->

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <?=date('Y')?> <a target="_blank" href="https://www.fxsistemas.com.ar">FX Sistemas</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url?>assets/js/libs/jquery-3.1.1.min.js"></script>
    <?php /*<script src="<?=base_url?>assets/js/jquery-image-upload-resizer.js"></script>
        <script>
            $('#foto1').imageUploadResizer({
                max_width: 800,
                max_height: 600,
                quality: 0.5, // Defaults 1
                do_not_resize: ['gif', 'svg'], // Defaults []
            });
            $('#foto2').imageUploadResizer({
                max_width: 800,
                max_height: 600,
                quality: 0.5, // Defaults 1
                do_not_resize: ['gif', 'svg'], // Defaults []
            });
            $('#foto3').imageUploadResizer({
                max_width: 800,
                max_height: 600,
                quality: 0.5, // Defaults 1
                do_not_resize: ['gif', 'svg'], // Defaults []
            });
            $('#foto4').imageUploadResizer({
                max_width: 800,
                max_height: 600,
                quality: 0.5, // Defaults 1
                do_not_resize: ['gif', 'svg'], // Defaults []
            });
        </script>*/?>
    <script src="<?=base_url?>bootstrap/js/popper.min.js"></script>
    <script src="<?=base_url?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=base_url?>plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="<?=base_url?>assets/js/app.js"></script>
    <script src="<?=base_url?>assets/js/app_1.js"></script>
     <script src="<?=base_url?>plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=base_url?>plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="<?=base_url?>assets/js/scrollspyNav.js"></script>
    <script src="<?=base_url?>plugins/file-upload/file-upload-with-preview.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=base_url?>plugins/apex/apexcharts.min.js"></script>
    <script src="<?=base_url?>assets/js/dashboard/dash_1.js"></script>
    <script src="<?=base_url?>assets/js/dashboard/dash_2.js"></script>
    <!-- Autocompletar !-->
    <script src="<?=base_url?>plugins/autocomplete/jquery.mockjax.js"></script>
    <script src="<?=base_url?>plugins/autocomplete/jquery.autocomplete.js"></script>
    
    <script src="<?=base_url?>plugins/autocomplete/demo.js"></script>
    <script src="<?=base_url?>plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?=base_url?>plugins/input-mask/input-mask.js"></script>
    <?php /*<script src="<?=base_url?>assets/js/script.js"></script>*/?>
    <?php
    /*<script src="<?=base_url?>assets/js/dashboard/dash_2.php"></script>*/
    ?>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?=base_url?>assets/js/custom.js"></script>
    <script src="<?=base_url?>assets/js/apps/invoice.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url?>plugins/table/datatable/datatables.js"></script>
    
        <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="<?=base_url?>plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=base_url?>plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=base_url?>plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=base_url?>plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    
    <script>        
        $('#default-ordering').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
               "sLengthMenu": "Resultados :  _MENU_",
            },
            "order": [[ 1, "desc" ]],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
	    } );

        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage');

    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
       <script src="<?=base_url?>plugins/highlight/highlight.pack.js"></script>
    <script src="<?=base_url?>assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM SCRIPT FILE  -->
    <script src="<?=base_url?>assets/js/scrollspyNav.js"></script>
    <script>
        $('#yt-video-link').click(function () {
            var src = 'https://www.youtube.com/embed/YE7VzlLtp-4';
            $('#videoMedia1').modal('show');
            $('<iframe>').attr({
                'src': src,
                'width': '560',
                'height': '315',
                'allow': 'encrypted-media'
            }).css('border', '0').appendTo('#videoMedia1 .video-container');
        });
        $('#vimeo-video-link').click(function () {
            var src = 'https://player.vimeo.com/video/1084537';
            $('#videoMedia2').modal('show');
            $('<iframe>').attr({
                'src': src,
                'width': '560',
                'height': '315',
                'allow': 'encrypted-media'
            }).css('border', '0').appendTo('#videoMedia2 .video-container');
        });
        $('#videoMedia1 button, #videoMedia2 button').click(function () {
            $('#videoMedia1 iframe, #videoMedia2 iframe').removeAttr('src');
        });
    </script>    
    <!--  END CUSTOM SCRIPT FILE  -->
    <script src="<?=base_url?>plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="<?=base_url?>plugins/jquery-step/custom-jquery.steps.js"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url?>plugins/fullcalendar/moment.min.js"></script>
    <script src="<?=base_url?>plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=base_url?>plugins/fullcalendar/fullcalendar.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="<?=base_url?>plugins/fullcalendar/custom-fullcalendar.advance.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>
</html>