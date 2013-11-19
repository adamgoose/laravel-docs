<!DOCTYPE html>
<html>
  <head>
    <title>{{ucwords($page)}} | Laravel Crowdsourced Documentation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div id="banner">

      <div class="container">
        <h1>
          Laravel Crowdsourced Documentation
          <small class="pull-right">
            <a href="http://laravel.com" target="_blank">
              Laravel.com
            </a>
            |
            <a href="http://laravel.com/api" target="_blank">
              API
            </a>
            |
            <a href="http://github.com/laravel/laravel" target="_blank">
              GitHub
            </a>
            |
            <a href="http://forums.laravel.io" target="_blank">
              Forums
            </a>
            |
            <a href="http://twitter.com/laravelphp" target="_blank">
              Twitter
            </a>
            |
            <a href="/">
              <span class="glyphicon glyphicon-home"></span>
            </a>
          </small>
        </h1>
      </div>

    </div>

    <div class="container">

      <div class="row-fluid">
        
        <div class="col-md-3" id="navigation-container">

          <div id="navigation" data-spy="affix" data-offset-top="50">
          
            {{$navigation}}

          </div>

        </div>

        <div class="col-md-6" id="content">
          
          @yield('content')

        </div>

        <div class="col-md-3" id="entries-container">

          <div id="entries" data-spy="affix" data-offset-top="50">
            
            <h2>Welcome!</h2>

            <p class="lead">To get started, click on a paragraph of the documentation!</p>

            <p>This is a place where you can share your blog articles, videos, tutorials, packages, etc. that are related to any particular documentation item.</p>

            <p>Say, for example, you write a blog article about Laravel's Caching system, specifically the <code>Cache::forever()</code> method. You could click on the code example in the documentation for that method, and add a link to your blog article. That way, when users are reading the documentation and come across the method, they'll find your blog article too!</p>

            <p>Please use this collection to your advantage, both while learning and while trying to share your passion for Laravel.</p>

          </div>

        </div>

      </div>

      <div class="row-fluid">
        
        <div class="col-md-6 col-md-offset-3">

          <hr>

          <div id="disqus_thread"></div>
          <script type="text/javascript">
              /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
              var disqus_shortname = 'docscrowdcom'; // required: replace example with your forum shortname

              /* * * DON'T EDIT BELOW THIS LINE * * */
              (function() {
                  var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                  dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                  (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
              })();
          </script>
          <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
          <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
        </div>

      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <script>
      $(function(){
        $("#navigation a[href='/{{Request::path()}}']").addClass('active');

        $("#content > *:not(p:has(a[name]))").each(function(key, item)
        {
          $(item).data('key', key);
        });

        $("#content > *:not(p:has(a[name]))").click(function()
        {
          var classes = "active";
          var progressbar = $("<div />").addClass('progress progress-striped active').html($("<div />").addClass('progress-bar progress-bar-laravel').attr('role', 'progressbar').attr('aria-valuenow', 100).attr('aria-valuemin', 0).attr('aria-valuemax', 100).css('width', '100%').html($("<span />").addClass('sr-only').text('Loading...')));

          $("#content *").removeClass(classes);
          $(this).addClass(classes);

          $("#entries").html(progressbar);

          $.get(
            '/docs/{{$page}}/entries/' + $(this).data('key'),
            {},
            function(data)
            {
              $("#entries").html(data);
            }
          );
        });

        $("#content h1").append($("<small />").text(' (View all)'));

        $("#entries").width($("#entries-container").width());
      });
    </script>

    @yield('scripts')

    <script>
      !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
      arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
      d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
      insertBefore(d,q)}(window,document,'script','_gs');
      
      _gs('GSN-904017-A');
    </script>
  </body>
</html>