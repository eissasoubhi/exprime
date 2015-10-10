<?php
class Article extends Eloquent    {

	protected $fillable = array('name', 'content');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'article';

	public function contentWithoutNL()
	{
		return preg_replace('~[\r\n]+~', '', $this->content);
	}

}
