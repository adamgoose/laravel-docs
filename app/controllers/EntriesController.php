<?php

class EntriesController extends BaseController {

  public function getEntries($page, $key)
  {
    $entries = Entry::select('*', DB::raw('`ups` + `downs` as `votes`'), DB::raw('`ups`/(`ups`+`downs`) as `percent`'))->wherePage($page)->whereKey($key)->orderBy('percent', 'desc')->orderBy('votes', 'desc')->get();

    return View::make('entries')
      ->withPage($page)
      ->withKey($key)
      ->withEntries($entries);
  }

  public function postEntry($page, $key)
  {
    $entry = new Entry(Input::all());
    $entry->page = $page;
    $entry->key = $key;
    $entry->ups = 1;

    if($entry->save()) {
      $response = ['status' => true];
    } else {
      $response = ['status' => false, 'messages' => $entry->errors];
    }

    return Response::json($response);
  }

  public function postVote($id, $direction)
  {
    try {

      $voteKey = 'vote'.$id.$direction;

      if(!Session::has($voteKey)) {

        $entry = Entry::findOrFail($id);
        $entry->{$direction.'s'} = $entry->getOriginal($direction.'s') + 1;
        $entry->save();

        Session::put($voteKey, true);

      }

      return Response::json(['status' => true]);
    } catch (ModelNotFoundException $e) {
      return Response::json(['status' => false]);
    }
  }

}