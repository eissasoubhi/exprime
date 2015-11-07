<?php
class Keyword extends Eloquent    {

	protected $fillable = array('keyword', 'user_id');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'keyword';

	public function picturesCount()
	{
		return count($this->pictures);
	}

	public function pictures()
    {
        return $this->belongsToMany('Picture');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}
