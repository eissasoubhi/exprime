<?php
class PictureKeyword extends Eloquent    {

	protected $fillable = array('keyword_id', 'picture_id');

	protected $table = 'keyword_picture';


}
