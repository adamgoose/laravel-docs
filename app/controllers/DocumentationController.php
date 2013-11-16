<?php

class DocumentationController extends BaseController {

  protected $layout = 'layouts.bootstrap';

  public function getPage($page = 'introduction')
  {
    $html = $this->markdown->transformMarkdown(File::get(app_path().'/docs/'.$page.'.md'));

    View::share('page', $page);

    $this->layout->content = View::make('page')
      ->withHtml($html);
  }

}