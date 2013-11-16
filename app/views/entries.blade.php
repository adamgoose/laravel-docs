@foreach($entries as $entry)

    <blockquote>

      <p><a href="{{$entry->href}}">{{$entry->title}}</a></p>

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