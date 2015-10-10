<?php
class Email extends Eloquent    {

	protected $fillable = array('email', 'fullname', 'subject', 'content');

	protected $table = 'mail';

	public function clipedContent()
	{
		return str_limit($this->content, 50);
	}
}
