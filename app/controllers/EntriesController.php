<?php

class EntriesController extends BaseController {

  public function getEntries($page = 'introduction', $key)
  {
    $entries = Entry::wherePage($page)->whereKey($key)->orderBy('created_at', 'desc')->get();

    return View::make('entries')
      ->withEntries($entries);
  }

}