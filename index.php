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

    
    <link href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap Core CSS -->
    <link href="/resources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"><!-- Custom Fonts -->
    <style>
      .default-bar{
        background-color: #006341;
        height: 40px;
      }
      #heading{
        color: #006341;
        font-weight: 600;
        font-size: 25px;
      }
      .panel{
        background-color: #006341;
        color: white;
        font-weight: 600;
        font-size: 15px;
        border-radius: 20px;
      }
      dt{
        font-size: 18px;
        padding-top: 6%;
      }
      dd{
        font-size: 12px;
        font-style: italic;
        line-height: 0.5;

      }
      .results{
        background-color: #DCDDDF;
        padding: 2% 5%;
        padding-bottom: 1%;
        border-radius: 8%;
        width:40%;
        margin-right:15px;
      }
      .navbar-nav{
        margin-left:20%;
      }
    </style>
</head>
<body>
<div class="default-bar"></div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/" style="margin-left:5%"><img src="logo.png" style="width:8%;"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Order Online</a></li>
        <li><a href="#">Menu</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <!-- panel preview -->
    <div class="col-sm-5" id="choose-coffee" >
        <h4 id="heading">Choose your coffee</h4>
        <div class="panel panel-default">
            <div class="panel-body form-horizontal payment-form">
              <form class="add-item" value="Send" type="submit">
                <div class="form-group">
                    <label for="quantity" class="col-sm-3 control-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" min="1" class="form-control" id="quantity" name="quantity" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="milk" class="col-sm-3 control-label">Milk</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="milk" name="milk" required>
                            <option value=""></option>
                            <option>Fat-free</option>
                            <option>Soy Milk</option>
                            <option>Half-N-Half</option>
                        </select>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="name" name="name" required>
                            <option value=""></option>
                            <option value="LM">Latte Macchiato</option>
                            <option value="A">Americano</option>
                            <option value="EM">Expresso Macchiato</option>
                            <option value="C">Cappuccino</option>
                            <option value="L">Latte</option>
                            <option value="CM">Caramel Macchiato</option>
                            <option value="M">Mocha</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="size" class="col-sm-3 control-label">Size</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="size" name="size" required>
                            <option value=""></option>
                            <option>Short</option>
                            <option>Tall</option>
                            <option>Grande</option>
                            <option>Venti</option>
                        </select>
                    </div>
                </div>          
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-default preview-add-button">
                            <span class="glyphicon glyphicon-plus"></span> Add
                        </button>
                    </div>
                </div>
              </form>
            </div>
        </div>            
    </div> <!-- / panel preview -->
    <div class="col-sm-7">
        <h4 id="heading">Looks good?</h4>
        <form class="order-now" type="submit">
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
                <h4>Total: $<strong><span class="preview-total">0.00</span></strong></h4>
            </div>
        </div>
        <div class="row text-right">
            <label for="location" class="col-sm-3 control-label">Pickup Location</label>
            <div class="col-sm-4">
                <select class="form-control" id="location" name="location" required>
                    <option value=""></option>
                    <option>San Francisco</option>
                    <option>Los Angeles</option>
                </select>
            </div>
            <div class="col-xs-12">
                <hr style="border:1px dashed #dddddd;">
                <button type="submit" class="btn btn-block" style="background: #006341; color: white; font-size: 15px; font-weight: 600;">ORDER NOW</button>
            </div>                
        </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-5 results">
      <p class="result"></p>
    </div>
  </div>
</div>

  <script src="../resources/jquery/jquery.min.js"></script> <!-- jQuery -->
  <script src="../resources/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap Core JavaScript -->
  <script src="form-script.js"></script>
  
</body>
</html>