<?php
class Role extends Eloquent    {

	protected $fillable = array('name');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'role';

	public function users()
	{
		return $this->hasMany('User');
	}

}
