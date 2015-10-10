<?php
class Error extends Eloquent    {

	protected $fillable = array('type', 'msg', 'fatal', 'file','code', 'line', 'url');

	protected $table = 'error';

	public function clipedMsg()
	{
		return str_limit($this->msg, 30);
	}

	public function clipedFile()
	{
		return str_limit($this->file, 30);
	}

}
