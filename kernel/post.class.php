<?php defined('BLUDIT') or die('Bludit CMS.');

class Post extends fileContent
{
	function __construct($key)
	{
		// Database Key
		$this->setField('key', $key);

		parent::__construct(PATH_POSTS.$key.DS);
	}

	// Returns the post title.
	public function title()
	{
		return $this->getField('title');
	}

	// Returns the post content.
	// This content is markdown parser.
	public function content($html=true)
	{
		// This content is not sanitized.
		$content = $this->getField('content');

		if($html) {
			return $content;
		}

		return Sanitize::html($content);
	}

	// Returns the post content.
	// This content is not markdown parser.
	public function contentRaw($html=true)
	{
		// This content is not sanitized.
		$contentRaw = $this->getField('contentRaw');

		if($html) {
			return $contentRaw;
		}

		return Sanitize::html($contentRaw);
	}

	public function key()
	{
		return $this->getField('key');
	}

	// Returns TRUE if the post is published, FALSE otherwise.
	public function published()
	{
		return ($this->getField('status')==='published');
	}

	public function username()
	{
		return $this->getField('username');
	}

	public function authorFirstName()
	{
		return $this->getField('authorFirstName');
	}

	public function authorLastName()
	{
		return $this->getField('authorLastName');
	}

	public function description()
	{
		return $this->getField('description');
	}

	public function unixTimeCreated()
	{
		return $this->getField('unixTimeCreated');
	}

	public function unixTimeModified()
	{
		return $this->getField('unixTimeModified');
	}

	public function dateCreated($format=false)
	{
		if($format===false) {
			return $this->getField('date');
		}

		$unixTimeCreated = $this->unixTimeCreated();

		return Date::format($unixTimeCreated, $format);
	}

	public function dateModified($format=false)
	{
		if($format===false) {
			return $this->getField('date');
		}

		$unixTimeModified = $this->unixTimeModified();

		return Date::format($unixTimeModified, $format);
	}

	public function timeago()
	{
		return $this->getField('timeago');
	}

	public function tags()
	{
		return $this->getField('tags');
	}

	public function slug()
	{
		return $this->getField('key');
	}

	public function permalink($absolute=false)
	{
		global $Url;
		global $Site;

		$url = trim($Site->url(),'/');
		$key = $this->key();
		$filter = trim($Url->filters('post'), '/');
		$htmlPath = trim(HTML_PATH_ROOT,'/');

		if(empty($filter)) {
			$tmp = $key;
		}
		else {
			$tmp = $filter.'/'.$key;
		}

		if($absolute) {
			return $url.'/'.$tmp;
		}

		if(empty($htmlPath)) {
			return '/'.$tmp;
		}

		return '/'.$htmlPath.'/'.$tmp;
	}

}
