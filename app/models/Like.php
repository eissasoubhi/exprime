<?php
class Like extends Eloquent    {

	protected $fillable = array('picture_id', 'user_id');

	protected $table = 'like';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function picture()
    {
        return $this->belongsTo('Picture');
    }

}
