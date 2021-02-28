<?php
require 'config.php';
?>
<html>

<head>
    <title>Simple CRUD Operation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="js/ajax.js"></script>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2>List Employees</h2>
                    <button class="btn btn-success float-right" data-toggle="modal" data-target="#create-modal">Add new employee</button>
                </div>
                <table class="table mt-2 table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <ul id="pagination" class="pagination-sm"></ul>

                <!-- Create Item Modal start-->
                <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="ModalLabel">Add Employee</h4>
                            </div>

                            <div class="modal-body">
                                <form data-toggle="validator" action="api/create.php" method="POST">

                                    <div class="form-group">
                                        <label class="control-label" for="firstname">First name:</label>
                                        <input type="text" name="firstname" class="form-control" data-error="Please enter first name." required />
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="lastname">Last name:</label>
                                        <input type="text" name="lastname" class="form-control" data-error="Please enter last name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="email">Email:</label>
                                        <input type="text" name="email" class="form-control" data-error="Please enter email." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn crud-submit btn-success">Submit</button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- Create Item Modal end-->

                <!-- Edit Item Modal Start -->
                <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="ModalLabel">Edit Employee</h4>
                            </div>


                            <div class="modal-body">
                                <form data-toggle="validator" action="api/update.php" method="put">
                                    <input type="hidden" name="id" class="edit-id">

                                    <div class="form-group">
                                        <label class="control-label" for="firstname">First name:</label>
                                        <input type="text" name="firstname" class="form-control" data-error="Please enter first name." required />
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="lastname">Last name:</label>
                                        <input type="text" name="lastname" class="form-control" data-error="Please enter last name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="email">Email:</label>
                                        <input type="text" name="email" class="form-control" data-error="Please enter email." required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Item Modal End -->

            </div>
        </div>
    </div>

</body>

</html>