{{Form::open(['url' => '/docs/'.$page.'/entries/'.$key, 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'newEntryForm', 'style' => 'display: none;'])}}

  <div class="form-group">
    {{Form::label('name', 'Your Name:', ['class' => 'col-sm-5 control-label'])}}
    <div class="col-sm-7">
      {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your Name'])}}
    </div>
  </div>

  <div class="form-group">
    {{Form::label('email', 'Your Email:', ['class' => 'col-sm-5 control-label'])}}
    <div class="col-sm-7">
      {{Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email'])}}
    </div>
  </div>

  <div class="form-group">
    {{Form::label('title', 'Article Title:', ['class' => 'col-sm-5 control-label'])}}
    <div class="col-sm-7">
      {{Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Article Title'])}}
    </div>
  </div>

  <div class="form-group">
    {{Form::label('href', 'Article URL:', ['class' => 'col-sm-5 control-label'])}}
    <div class="col-sm-7">
      {{Form::text('href', null, ['class' => 'form-control', 'placeholder' => 'Article URL'])}}
    </div>
  </div>

{{Form::close()}}

<div class="pull-right">
  <a href="#" class="btn btn-xs btn-info" id="newEntryButton"><span class="glyphicon glyphicon-plus-sign"></span> Add Item</a>
</div>

<div class="clearfix"></div>

@foreach($entries as $entry)

    <blockquote>

      <p><a href="{{$entry->href}}" target="_blank">{{$entry->title}}</a></p>

      <div class="likes pull-right">
        <span class="glyphicon glyphicon-thumbs-up"></span>
        <span class="glyphicon glyphicon-thumbs-down"></span>
      </div>

      <small>{{$entry->domain}}</small>

      <div class="progress progress-custom">
        <div class="progress-bar progress-bar-success" style="width: {{$entry->ups}}%">
          <span class="sr-only">{{$entry->ups}}% Up-votes</span>
        </div>
        <div class="progress-bar progress-bar-danger" style="width: {{$entry->downs}}%">
          <span class="sr-only">{{$entry->downs}}% Down-votes</span>
        </div>
      </div>

    </blockquote>

@endforeach

@if($entries->isEmpty())

  <p class="lead">No entries for this item.</p>

@endif

<script>
  $(function()
  {
    $("#newEntryButton").click(function()
    {
      $(this).unbind('click').click(function()
      {
        $("#newEntryForm").submit();

        return false;
      });

      $("#newEntryForm").slideDown();
      $(this).removeClass('btn-info').addClass('btn-success');

      return false;
    });

    $("#newEntryForm").submit(function()
    {
      var form = $(this);

      $("#newEntryButton").attr('disabled', 'disabled');
      $("#newEntryForm .has-error").removeClass('has-error');

      $.post(
        form.attr('action'),
        form.serialize(),
        function(data)
        {
          if(data['status'] == true)
            $("#content .alert.alert-info").click();
          else {
            $("#newEntryButton").removeAttr('disabled');
            $.each(data['messages'], function(key, item)
            {
              $("input[name="+key+"]").parent().parent().addClass('has-error');
            });
          }
        },
        "json"
      );

      return false;
    });
  });
</script>