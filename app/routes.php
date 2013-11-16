<?php

Route::group(['prefix' => 'docs'], function()
{

  Route::get('{page?}', 'DocumentationController@getPage');
  Route::get('{page}/entries/{key}', 'EntriesController@getEntries');

});