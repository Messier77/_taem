
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2({multiple: true, placeholder: "Please select value"});
        $('.js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('disabled', true);});
    });
    </script>

</body>

</html>
