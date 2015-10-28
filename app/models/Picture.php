<?php
class Picture extends Eloquent    {

	protected $fillable = array('user_id', 'name', 'size', 'dimension','url_origin', 'url_with_txt', 'date_last_modif', 'validated');

	protected $table = 'picture';

	public function user()
	{
		return $this->belongsToUser('User');
	}

    public function clipedName()
    {
        return str_limit($this->name, 20);
    }

    public function keywords()
    {
        return $this->belongsToMany('Keyword');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function likes()
    {
        return $this->hasMany('Like');
    }

    public function width()
    {
    	$dimension = explode("x", $this->dimension);
    	return $dimension[0];
    }

    public function height()
    {
    	$dimension = explode("x", $this->dimension);
    	return $dimension[1];
    }

    public function name()
    {
    	$fullname = explode("__", $this->name);
    	// return dd($fullname);
    	return (strrpos($this->name, "__")) ? $fullname[0] : "" ;
    }

	public function sizeUnit()
	{
		$bytes = $this->size;
	    $label = array( 'octet(s)', 'Ko', 'Mo', 'Go', 'To', 'Po' );
	    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
	    return( round( $bytes, 2 ) . " " . $label[$i] );
	}

    public function like($user_id)
    {
        $like  = new Like(array("user_id" => $user_id, "picture_id" => $this->id));
        return $this->likes()->save($like);
    }

    public function unlike($user_id)
    {
        return Like::whereRaw('user_id = ? and picture_id = ?', array($user_id, $this->id))->delete();
    }

    public function isLiked($user_id)
    {
        $picture = $this;
        return Picture::whereHas('likes', function($q) use ($picture, $user_id)
        {
            $q->whereRaw('user_id = ? and picture_id = ?', array($user_id, $picture->id));

        })->exists();
    }

    public function belongsToUser(User $user)
    {
        return $this->user_id == $user->id;
    }
}
