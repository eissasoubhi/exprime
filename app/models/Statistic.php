<?php
class Statistic extends Eloquent    {

	protected $fillable = array('city','country','url','time','count');

	protected $table = 'statistic';

	public function clipedUrl()
	{
		return str_limit($this->url, 50);
	}
}