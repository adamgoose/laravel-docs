<?php

Route::get('/', function()
{
  return Redirect::to('docs');
});

Route::group(['prefix' => 'docs'], function()
{

  Route::get('{page?}', 'DocumentationController@getPage');
  Route::get('{page}/entries/{key}', 'EntriesController@getEntries');
  Route::post('{page}/entries/{key}', 'EntriesController@postEntry');

});