<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <?php include("nav.php") ?>

        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>ระบบทรัพย์สิน</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="assets/images/dashboard/top-header.png" alt="header"
                    class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                <img src="assets/images/dashboard/top-header1.png" alt="header"
                    class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                <img src="assets/images/dashboard/top-header2.png" alt="header"
                    class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                <img src="assets/images/dashboard/top-header3.png" alt="header"
                    class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                <img src="assets/images/dashboard/top-header4.png" alt="header"
                    class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                <img src="assets/images/dashboard/top-header5.png" alt="header"
                    class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
            </div>
        </div> <!-- Nav Header Component End -->
        <!--Nav End-->
    </div>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                        <div class="header-title">
                            <h4 class="card-title mb-0">รายการ ระบบทรัพย์สิน</h4>
                        </div>
                        <div class="">
                            <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </i>
                                <span>New Asset</span>
                            </a>
                            <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" id="addAsset">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add new permission
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="AssetID" class="form-label">Asset ID</label>
                                                    <input type="text" class="form-control" id="AssetID" name="AssetID"
                                                        aria-describedby="text" placeholder="Asset ID">
                                                </div>
                                                <div class="form-group">
                                                    <label for="AssetName" class="form-label">Asset Name</label>
                                                    <input type="text" class="form-control" id="AssetName"
                                                        name="AssetName" aria-describedby="text"
                                                        placeholder="Asset Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Type" class="form-label">Type</label>
                                                    <input type="text" class="form-control" id="Type" name="Type"
                                                        aria-describedby="text" placeholder="Type">
                                                </div>
                                                <div class="text-start">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                            $("#addAsset").on('submit', (function(e) {
                                e.preventDefault();
                                $.ajax({
                                    url: "https://icandefine.com/api/service/index.php?service=addAsset",
                                    type: "POST",
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    beforeSend: function() {
                                        //$("#preview").fadeOut();
                                        $("#err").fadeOut();
                                    },
                                    success: function(data) {
                                        $.ajax({
                                            url: "page/table/table_asset.php",
                                            type: "POST",
                                            cache: false,
                                            success: function(data) {
                                                $('#page').html(data);
                                            }
                                        });
                                        $('[data-bs-dismiss="modal"]').click();
                                    },
                                    error: function(e) {
                                        $("#err").html(e).fadeIn();
                                    }
                                });
                            }));
                            </script>
                            <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop-1">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </i>
                                <span>New Import</span>
                            </a>
                            <div class="modal fade" id="staticBackdrop-1" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Import</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="files" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" id="excel" name="excel">
                                                </div>
                                                <input type="hidden" name="import" value="import">
                                                <div class="text-start mt-2">
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Save</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    // $("#files").submit(function() {

                    //     var formData = new FormData($(this)[0]);

                    //     $.ajax({
                    //         url: window.location.pathname,
                    //         type: 'POST',
                    //         data: formData,
                    //         async: false,
                    //         success: function(data) {
                    //             alert(data)
                    //         },
                    //         cache: false,
                    //         contentType: false,
                    //         processData: false
                    //     });

                    //     return false;
                    // });

                    $("#files").on('submit', (function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "https://icandefine.com/api/service/admin/excelimportAsset.php",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                //$("#preview").fadeOut();
                                $("#err").fadeOut();
                            },
                            success: function(data) {
                                $('#page').html(data);
                                $('[data-bs-dismiss="modal"]').click();
                            },
                            error: function(e) {
                                $("#err").html(e).fadeIn();
                            }
                        });
                    }));
                    </script>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Asset ID</th>
                                        <th class="text-center">Asset Name</th>
                                        <th class="text-center">Type</th>
                                        <!-- <th class="text-center">Purpose</th> -->
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="page">



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<script>
$.ajax({
    url: "page/table/table_asset.php",
    type: "POST",
    cache: false,
    success: function(data) {
        $('#page').html(data);
    }
});
</script>