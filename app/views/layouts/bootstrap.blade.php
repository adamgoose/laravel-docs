<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">


      <h1>Documentation</h1>

      <hr>

      <div class="row-fluid">
        
        <div class="col-md-3" id="navigation">
          
          {{$navigation}}

        </div>

        <div class="col-md-6" id="content">
          
          @yield('content')

        </div>

        <div class="col-md-3" id="entries-container">

          <div id="entries" data-spy="affix" data-offset-top="50"></div>

        </div>

      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <script>
      $(function(){
        $("#navigation a[href='/{{Request::path()}}']").addClass('active');

        $("#content > *").each(function(key, item)
        {
          $(item).data('key', key);
        });

        $("#content > *").click(function()
        {
          var classes = "alert alert-info";
          $("#content *").removeClass(classes);
          $(this).addClass(classes);

          $.get(
            '/docs/{{$page}}/entries/' + $(this).data('key'),
            {},
            function(data)
            {
              $("#entries").html(data);
            }
          );
        });

        $("#entries").width($("#entries-container").width());
      });
    </script>
  </body>
</html>