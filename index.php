<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='shortcut icon' href='fav.png' type='image/x-icon'/ >
    <title>Starbucks Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/resources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <div class="row">
        <div class="col-sm-12">
            <img src="logo.png" href="/" style="width:120px;"/>
        </div>
        <div style="padding-top: 15%;"></div>
        <!-- panel preview -->
        <div class="col-sm-5">
            <h4>Place Order</h4>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="location" name="location">
                                <option>San Francisco</option>
                                <option>Los Angeles</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" class="form-control" id="quantity" name="quantity" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="milk" class="col-sm-3 control-label">Milk</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="milk" name="milk">
                                <option>--Choose One--</option>
                                <option>Coconut Milk</option>
                                <option>Soy Milk</option>
                                <option>Half N Half</option>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="name" name="name">
                                <option>--Choose One--</option>
                                <option>Latte Macchiato</option>
                                <option>Americano</option>
                                <option>Expresso Macchiato</option>
                                <option>Cappuccino</option>
                                <option>Latte</option>
                                <option>Caramel Macchiato</option>
                                <option>Mocha</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="size" class="col-sm-3 control-label">Size</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="size" name="size">
                                <option>--Choose One--</option>
                                <option>Short</option>
                                <option>Tall</option>
                                <option>Grande</option>
                                <option>Venti</option>
                            </select>
                        </div>
                    </div>          
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default preview-add-button">
                                <span class="glyphicon glyphicon-plus"></span> Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>            
        </div> <!-- / panel preview -->
        <div class="col-sm-7">
            <h4>Preview:</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table preview-table">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Name</th>
                                    <th>Milk</th>
                                    <th>Size</th>
                                    <th>Pickup Location</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody></tbody> <!-- preview content goes here-->
                        </table>
                    </div>                            
                </div>
            </div>
            <div class="row text-right">
                <div class="col-xs-12">
                    <h4>Total: $<strong><span class="preview-total"></span></strong></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr style="border:1px dashed #dddddd;">
                    <button type="button" class="btn btn-block" style="background: #006341; color: white; font-size: 15px; font-weight: 600;">Pay Now</button>
                </div>                
            </div>
        </div>
  </div>
</div>

  <script src="../resources/jquery/jquery.min.js"></script> <!-- jQuery -->
  <script src="../resources/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap Core JavaScript -->
  <script src="form-script.js"></script>
  
</body>
</html>