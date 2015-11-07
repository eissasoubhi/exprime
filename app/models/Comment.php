<?php
class Comment extends Eloquent    {

	protected $fillable = array('user_id','picture_id','content');

	protected $table = 'comment';

	public function user()
	{
		return $this->belongsTo('user');
	}

    public function belongsToUser(User $user)
    {
        return $this->user_id == $user->id;
    }
}
