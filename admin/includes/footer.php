<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-4">
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</main>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/perfect-scrollbar.min.js"></script>
<script src="../assets/js/smooth-scrollbar.min.js"></script>


<!-- JavaScript Alertiy JS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    <?php if (isset($_SESSION['message'])) { ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
</script>

<!-- Jqurey -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Delete Product -->
<script>
    $(document).ready(function() {

        $(document).on('click', '.delete_product_btn', function(e) {
            e.preventDefault();


            var id = $(this).val();
            // alert(id);

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "POST",
                            url: "code.php",
                            data: {
                                'product_id': id,
                                'delete_product_btn': true
                            },
                            success: function(response) {
                                if (response == 200) {
                                    swal("Success!", "Product Deleted Successfully", "success");
                                    $("#products_table").load(location.href + " #products_table");
                                } else if (response == 500) {
                                    swal("Error!", "Something Went Wrong", "error");
                                }
                            }
                        });
                    }
                });
        });
    });
</script>

<!-- Delete Category -->
<script>
    $(document).ready(function() {

        $(document).on('click', '.delete_category_btn', function(e) {
            e.preventDefault();


            var id = $(this).val();
            // alert(id);

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "POST",
                            url: "code.php",
                            data: {
                                'category_id': id,
                                'delete_category_btn': true
                            },
                            success: function(response) {
                                if (response == 200) {
                                    swal("Success!", "Category Deleted Successfully", "success");
                                    $("#category_table").load(location.href + " #category_table");
                                } else if (response == 500) {
                                    swal("Error!", "Something Went Wrong", "error");
                                }
                            }
                        });
                    }
                });
        });
    });
</script>

<!-- Delete Variant Product -->
<script>
    $(document).ready(function() {

        $(document).on('click', '.delete_variant_btn', function(e) {
            e.preventDefault();


            var id = $(this).val();
            // alert(id);

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "POST",
                            url: "code.php",
                            data: {
                                'product_id': id,
                                'delete_variant_btn': true
                            },
                            success: function(response) {
                                if (response == 200) {
                                    swal("Success!", "Variant Deleted Successfully", "success");
                                    $("#variant_table").load(location.href + " #variant_table");
                                } else if (response == 500) {
                                    swal("Error!", "Something Went Wrong", "error");
                                }
                            }
                        });
                    }
                });
        });
    });
</script>

</body>

</html>