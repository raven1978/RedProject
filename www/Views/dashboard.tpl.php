<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/Views/css/bootstrap.css">
    <link rel="stylesheet" href="/Views/css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
      <a class="navbar-brand" href="/dashboard">MANAGE TRANSACTIONS</a>
      <ul class="nav navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/dashboard">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/create">New Transaction</a>
        </li>
      </ul>
    </nav>

    <div class="container">
   <?=$this->response?>
    </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="/Views/js/jquery.js" ></script>
      <script src="/Views/js/tether.js" ></script>
     <script src="/Views/js/bootstrap.min.js"></script>
  </body>
</html>