<?php

class BaseController extends Controller {

	public $markdown;

	public function __construct(Markdown $markdown)
	{
		$this->markdown = $markdown;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$navigation = $this->markdown->transformMarkdown(File::get(app_path().'/docs/documentation.md'));

			$this->layout = View::make($this->layout)
				->withNavigation($navigation);
		}
	}

}