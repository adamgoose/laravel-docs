@section('content')

  {{$html}}

@stop

@section('scripts')
  <script src="/js/prettify.js"></script>
  <script>
  $(function()
  {
    $("#content pre").addClass('prettyprint');
    prettyPrint();
  });
  </script>
@stop