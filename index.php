<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>



    <script type="text/javascript" src="js/script.js"></script>

</head>

<body>


    <div class="main-button">
            <div class="container">
                <div class="row">

                        <div class="col-lg-12 margin-tb">

                            <div class="pull-left">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-sms">
                                    Create New SMS
                                </button>
                            </div>

                        </div>
                </div>

            </div>
       </div>



       <!-- Create Item Modal -->
    <div class="modal fade" id="create-sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">+</span></button>
                    <h4 class="modal-title" id="myModalLabel">Send New SMS</h4>
                </div>

                <div class="modal-body">
                    <div class="main-input">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 margin-tb">

                                    <label class="control-label" for="sms-text">Enter SMS text below:</label>

                                    <form method="post" data-toggle="validator">

                                        <div class="form-group">

                                            <textarea id="sms" name="sms-text" rows="5" cols="40" required> </textarea><br>

                                            <input type="hidden" name="save" value="1">

                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <button id="send_sms" type="submit" name="addsms" value="Send" class="btn crud-submit btn-success">Send SMS</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                   </div>
                </div>

        </div>
    </div>
    </div>

    <div class="main-table">

        <div class="container">

            <div class="panel panel-primary">

                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">SMS List</h4>


                    <div class="pull-right">

                        <select class="selectpicker" name="select_result" id="select">
                            <option value="5">5</option>
                            <option>10</option>
                            <option>25</option>
                        </select>

                    </div>


                </div>

                <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>SMS</th>
                                <th>Sended</th>
                                <th width="200px">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <ul id="pagination" class="pagination-sm"></ul>
                    </div>
                </div>
        </div>

    </div>


    <!-- Edit Item Modal -->
  <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">+</span></button>
          <h4 class="modal-title" id="modalLabel">Edit Item</h4>
        </div>

        <div class="modal-body">

            <form data-toggle="validator" method="put">

                <input type="hidden" name="id" class="edit-id">

                <div class="form-group">
                  <label class="control-label" for="sms-edit">SMS Text:</label>
                  <input type="text" name="sms-edit" class="form-control" data-error="Please enter sms text." required />
                  <div class="help-block with-errors"></div>

                </div>


                <div class="form-group">
                  <button type="submit" class="btn btn-success" id="saveEdit">Save</button>
                </div>

            </form>

        </div>
      </div>
    </div>
  </div>

</body>

</html>
