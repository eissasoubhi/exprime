<?php
namespace frontend;
use View; use Picture; use Input; use Redirect; use Validator; use Session; use Auth; use Hash; use Resize;
use File; use Keyword; use PictureKeyword; use Route; use Error; use Request; use Like; use Paginator;
class PictureController extends \BaseController {

	public function index()
	{
		Session::flash('jscroll_resources', '1');
		Session::flash('freewall_resources', '1');
		Session::flash('visible_resources', '1');
        $pictures = Picture::orderBy('created_at', 'DESC')->simplePaginate(16);
		return View::make('frontend.picture.index', compact('pictures'));
	}

	public function create()
	{
		Session::flash('feather', '1');
		Session::flash('ajax_file_upload_resources', '1');
		return View::make('frontend.picture.create');
	}

	public function keywords()
	{
		 // header("Access-Control-Allow-Origin: *");

		$keywords =  Keyword::all();
		$pictures =  Picture::all();
		$keywords_name = array();
		foreach ($keywords as $kw)
		{
			$keywords_name[] = $kw->keyword;
		};
		foreach ($pictures as $pic)
		{
			$keywords_name[] = $pic->name();
		}
		return $keywords_name;
	}

	public function store()
	{
		$picture = Input::all();
		$name =  str_replace(array(' ',"'","__" ), "-",$picture['img-name']);
		$search_keywors =  $picture['search-keywors'];
		$img_url =  $picture['img-url'];
		// $token =  $picture['token'];
		// $timestamp =  $picture['timestamp'];
		$fileTypes = array('jpg','jpeg','png');
		// $verifyToken = "}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".$timestamp ;

		// if (Hash::check($verifyToken, $token)) {
		if (Input::file('Filedata')) {
			list($width, $height) = getimagesize(Input::file('Filedata')->getRealPath());
			$size = Input::file('Filedata')->getSize();
			$extension = Input::file('Filedata')->getClientOriginalExtension();
		}
		elseif($img_url)
		{
			$imageinfos = getimagesize($img_url);
			$width = $imageinfos[0];
			$height = $imageinfos[1];
			$extension = strtolower(str_replace("image/", "", $imageinfos['mime']));
			$tmp_img = public_path()."/uploadtemp/".time().".".$extension;

			ini_set('max_execution_time', 3000);
			$size = strlen(file_get_contents($img_url));
			// return dd($size);

		}
		else
		{

		}
		if (in_array($extension, $fileTypes)) {

			$targetFolder = '/content'; // Relative to the root

			$full_name = $name."__".time()."_".Auth::id().".".$extension;

			$targetPath = public_path() . $targetFolder;

			$validator = Validator::make(
		    array('full_name' => $full_name,
					'width' => $width,
					'height' => $height,
					'extension' => $extension,
					'size' => $size),
		    array('full_name' => 'min:1',
		    		'width' => 'required|integer|min:207',
		    		'extension' => 'required|min:3',
		    		'height' => 'required|integer|min:207',
		    		'size' => 'required|integer|max:1048576') // 1MB
			);

			if ($validator->fails())
			{
				$messages = $validator->messages();

			    return Redirect::back()->withInput()->withErrors($messages);
			}
			if (Input::file('Filedata')) {
				Input::file('Filedata')->move($targetPath, $full_name);
			}
			else
			{
				copy($img_url, rtrim($targetPath,'/')."/".$full_name);
			}


			if ($width > 550 || $height > 400) {

				$targetFile = rtrim($targetPath,'/') . '/' . $full_name;

				$resizeObj = new Resize($targetFile);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(550, 400, 'auto');

				$resizeObj -> saveImage($targetFile, 100);

				list($width, $height) = getimagesize($targetFile);

				$size = filesize($targetFile);
			}

			$picture = Picture::create(array('name' => $full_name,
							'user_id' => Auth::id(),//Auth::id()
							'dimension' => $width."x".$height,
							'url_origin' => $full_name,
							'validated' => 1,
							'size' => $size));
			$search_keywors = explode(",", $search_keywors);
			$keyword = array();
			foreach ($search_keywors as $kw) {
				$keyword = Keyword::whereKeyword($kw)->first();
				if (!$keyword) {
					$keyword = Keyword::create(array('keyword' => $kw,
											'user_id' => Auth::id()));
				}
				PictureKeyword::create(array('picture_id' => $picture->id,
										  		'keyword_id'=> $keyword->id));
			}
			return Redirect::to("explorer")->with("new_added_pic_id", $picture->id);
		}
	}

	public function show($id)
	{
		$image = Picture::find($id);
		$picture_keywords = array();
		foreach ($image->keywords as $key => $kw) {
			$picture_keywords[] = $kw->keyword;
		}
		// return dd($image->comments()->get()[0]);
		$keywords = implode(",", $picture_keywords);
		return View::make('frontend.picture.show',compact('image','keywords'));
	}

	public function edit($id)
	{
		$image = Picture::find($id);
		$picture_keywords = array();
		foreach ($image->keywords as $key => $kw) {
			$picture_keywords[] = $kw->keyword;
		}
		$keywords = implode(",", $picture_keywords);
		Session::flash('feather', '1');
		Session::flash('ajax_file_upload_resources', '1');
		return View::make('frontend.picture.edit',compact('image','keywords'));
	}

	public function update($id)
	{
		$picture = Input::all();
		// dd($picture);
		$image = Picture::find($id);
		$name =  str_replace(array(' ',"'","__"), "-",$picture['img-name']);
		$search_keywors =  $picture['search-keywors'];
		$img_url =  $picture['img-url'];
		$editedImgUrl =  $picture['editedImg'];
		$targetFolder = '/content'; // Relative to the root
		$targetPath = public_path() . $targetFolder;
		// $token =  $picture['token'];
		// $timestamp =  $picture['timestamp'];
		$fileTypes = array('jpg','jpeg','png');
		// $verifyToken = "}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".$timestamp ;

		// if (Hash::check($verifyToken, $token)) {
		if (Input::file('Filedata')) {
			list($width, $height) = getimagesize(Input::file('Filedata')->getRealPath());
			$size = Input::file('Filedata')->getSize();
			$extension = Input::file('Filedata')->getClientOriginalExtension();
		}
		elseif($img_url)
		{
			$imageinfos = getimagesize($img_url);
			$width = $imageinfos[0];
			$height = $imageinfos[1];
			$extension = strtolower(str_replace("image/", "", $imageinfos['mime']));
			$tmp_img = public_path()."/uploadtemp/".time().".".$extension;

			ini_set('max_execution_time', 3000);
			$size = strlen(file_get_contents($img_url));
			// return dd($size);

		}
		elseif ($editedImgUrl) {
			$imageinfos = getimagesize($editedImgUrl);
			$width = $imageinfos[0];
			$height = $imageinfos[1];
			$extension = strtolower(str_replace("image/", "", $imageinfos['mime']));
			$tmp_img = public_path()."/uploadtemp/".time().".".$extension;

			ini_set('max_execution_time', 3000);
			$size = strlen(file_get_contents($editedImgUrl));
		}
		else
		{
			$dimension = explode("x", $image->dimension);
			$width = $dimension[0];
			$height = $dimension[1];
			$extension = pathinfo(rtrim($targetPath,'/')."/".$image->name, PATHINFO_EXTENSION);

			ini_set('max_execution_time', 3000);
			$size = $image->size;
		}
		if (in_array($extension, $fileTypes)) {

			$full_name = $name."__".time()."_".Auth::id().".".$extension;

			$validator = Validator::make(
		    array('full_name' => $full_name,
					'width' => $width,
					'height' => $height,
					'extension' => $extension,
					'size' => $size),
		    array('full_name' => 'min:1',
		    		'width' => 'required|integer|min:207',
		    		'extension' => 'required|min:3',
		    		'height' => 'required|integer|min:207',
		    		'size' => 'required|integer|max:1048576') // 1MB
			);

			if ($validator->fails())
			{
				$messages = $validator->messages();

			    return Redirect::back()->withInput()->withErrors($messages);
			}
			$delete_old_pic = true;
			if (Input::file('Filedata')) {
				Input::file('Filedata')->move($targetPath, $full_name);
			}
			elseif($img_url)
			{
				copy($img_url, rtrim($targetPath,'/')."/".$full_name);
			}
			elseif($editedImgUrl)
			{
				copy($editedImgUrl, rtrim($targetPath,'/')."/".$full_name);
			}
			else
			{
				$delete_old_pic = false;
				rename(rtrim($targetPath,'/')."/".$image->name, rtrim($targetPath,'/')."/".$full_name);
			}
			if (File::exists(rtrim($targetPath,'/')."/".$image->name) && $delete_old_pic) {
				if (!File::delete(rtrim($targetPath,'/')."/".$image->name))
				{

				}
			}
			if ($width > 550 || $height > 400) {

				$targetFile = rtrim($targetPath,'/') . '/' . $full_name;
				// return dd($targetFile);
				$resizeObj = new Resize($targetFile);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(550, 400, 'auto');

				$resizeObj -> saveImage($targetFile, 100);

				list($width, $height) = getimagesize($targetFile);

				$size = filesize($targetFile);
			}

			$image->name = $full_name;
			$image->user_id = Auth::id();
			$image->dimension = $width."x".$height;
			$image->url_origin = $full_name;
			$image->size = $size;

			$image->save();

			$search_keywors = explode(",", $search_keywors);
			$keyword = $keyword_ids = array();
			foreach ($search_keywors as $kw) {
				$keyword = Keyword::whereKeyword($kw)->first();
				if (!$keyword) {
					$keyword = Keyword::create(array('keyword' => $kw,
											'user_id' => Auth::id()));
				}
				$keyword_ids[] = $keyword->id;
			}
			$image->keywords()->sync($keyword_ids);
			$picCount = Picture::where('id','<=',$image->id)->count();
			$page = ceil($picCount/16);
			$param = ($page !=0 && $page != 1) ? "?page=".$page : "" ;
			// return "id : ".$image->id.", count : ".$picCount.", floor : ".$page;
			// return "explorer".$param;
			// dd($full_name);
			return Redirect::to("explorer".$param)->with("new_added_pic_id", $image->id);
		}
	}

	public function destroy($id)
	{
		$picture = Picture::find($id);
		$errors = array();
		if (!$picture->delete()) {
			$errors[] = "Erreur de suppresssion de l'image de la base de données !";
			return Redirect::back()->withErrors($errors);
		}
		$filename = public_path()."/content/".$picture->url_origin;

		if (File::exists($filename)) {
			if (!File::delete($filename))
			{
				$url = Request::url();
				$code = -1; $file = ''; $line =-1; $fatal = -1; $type = "laravel";
				$msg = "Erreur de suppresssion de l'image ".$filename." de serveur !";
				if(!Error::whereRaw("url = ? and msg = ? ", array($url, $msg, ))->exists()){
					Error::create(array('url' => url($url),
										'code' => $code,
										'msg' => $msg,
										'file' => $file,
										'line' => $line,
										'fatal' => $fatal,
										'type' => $type));
				}
			}
		}
		return Redirect::to("explorer");

	}

	public function uploadTemp()
	{

		$targetFolder = '/uploadtemp';

		$verifyToken = "}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".Input::get('timestamp');

		$user_id = Auth::id();

		// if (Input::hasFile('Filedata') && Hash::check($verifyToken, Input::get('token'))) {

			$fileTypes = array('jpg','jpeg','png'); // File extensions

			$extension = Input::file('Filedata')->getClientOriginalExtension();

			if (in_array($extension, $fileTypes)) {

				$name = Input::file('Filedata')->getClientOriginalName();

				$full_name = time()."_".$user_id.".".$extension;

				$targetPath = public_path() . $targetFolder;

				$size = Input::file('Filedata')->getSize();

				list($width, $height) = getimagesize(Input::file('Filedata')->getRealPath());

				$validator = Validator::make(
			    array('full_name' => $full_name,
						'width' => $width,
						'height' => $height,
						'extension' => $extension,
						'size' => $size),
			    array('full_name' => 'min:1',
			    		'width' => 'required|integer|min:207',
			    		'extension' => 'required|min:3',
			    		'height' => 'required|integer|min:207',
			    		'size' => 'required|integer|max:1048576')
				);

				if ($validator->fails())
				{
					$messages = $validator->messages();

				    return "erreur d'insertion de la photo $name !";
				}

				Input::file('Filedata')->move($targetPath, $full_name);

				if ($width > 500 || $height > 350) {

					$targetFile = rtrim($targetPath,'/') . '/' . $full_name;

					$resizeObj = new Resize($targetFile);
					// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage(500, 350, 'auto');

					$resizeObj -> saveImage($targetFile, 100);

					list($width, $height) = getimagesize($targetFile);

					$size = filesize($targetFile);
				}

				$imageinfos = array('name' => $full_name,
									'extension' => $extension,
									'width' => $width,
									'height' => $height,
									'size' => $size,
									'timestamp' => Input::get('timestamp'),
									'token' => Input::get('token'));
				// return  '1';
				return  url(rtrim($targetFolder,'/') . '/' . $full_name);
			} else {
				return  'Invalid file type.';
			}
		// }
	}

	public function toggleLike($id)
	{
		$picture = Picture::find($id);
		// return dd($picture->isLiked(Auth::id()));
		$result = array();

		if($picture->isLiked(Auth::id()))
		{
			$picture->unlike(Auth::id());
			$result['state'] = "unliked";
		}
		else
		{
			$picture->like(Auth::id());
			$result['state'] = "liked";
		}

		if ($picture->has('likes')) {
			$result['count'] = $picture->likes()->count();
		}

		return $result;
	}

	public function likes()
	{
		Session::flash('jscroll_resources', '1');
		Session::flash('freewall_resources', '1');
		Session::flash('visible_resources', '1');
		$likes_ids = array();
		foreach (Auth::user()->likes()->get() as $like) {
			$likes_ids[] = $like->picture_id;
		}


        $pictures = Picture::whereIn('id', $likes_ids)->simplePaginate(16);
        // return $likes_ids;
		return View::make('frontend.picture.likes', compact('pictures'));
	}

	public function search()
	{
		$searched_words = Input::get("q");
		// return $keywords;
		$keywords = array_unique(explode(" ", $searched_words));
		$keywords_array = array();
		foreach ($keywords as $keyword)
		{
			$keyword = trim($keyword);
			if ($keyword && !in_array($keyword, $keywords_array))
			{
				$keywords_array[] = $keyword;
			}
		}

		$pictures = array();
		$matched_pics = array();
		foreach (Picture::all() as $key => $pic)
		{
			foreach ($keywords_array as $keyword)
			{
				similar_text($pic->name(), $keyword, $match_proportion);
				$orm_key_words = $pic->keywords;
				// matched picture keywords
				$matched_kw_proportion = 0;
				foreach ($orm_key_words as $kw)
				{
					similar_text($kw->keyword, $keyword, $kw_match_proportion);
					if ($kw_match_proportion >= 40)
					{
						if ($kw_match_proportion > $matched_kw_proportion)
						{
							$matched_kw_proportion = $kw_match_proportion;
						}
					}
				}
				// get the biggest proportion for current picture
				if ($matched_kw_proportion > $match_proportion)
				{
					$match_proportion = $matched_kw_proportion;
				}
				if ($match_proportion >= 40)
				{
					//if picture isnot set in pictures and (isnot set in matched_pics or its $match_proportion bigger than the old's)
					if (!isset($pictures[$pic->id]) and (
						!isset($matched_pics[$pic->id]) or (
							isset($matched_pics[$pic->id]) and $match_proportion > $matched_pics[$pic->id]))) {
						$matched_pics[$pic->id] = $match_proportion;
					}
				}
			}
		}
		arsort($matched_pics);

		foreach ($matched_pics as $pic_id => $pic_proportion) {
			$pictures[$pic_id] = Picture::find($pic_id);
		}
		// foreach ($pictures as $key => $pic) {
		// 	echo $pic->name;
		// 	echo "<br>";
		// 	var_dump($pic->keywords[0]->keyword);
		// 	echo "<hr>";
		// }
		// return;
		$perPage = 16;
		$currentPage = Input::get('page') - 1;
		$pagedData = array_slice($pictures, $currentPage * $perPage, $perPage);
		$pictures = Paginator::make($pagedData, count($pictures), $perPage);
		Session::flash('jscroll_resources', '1');
		Session::flash('freewall_resources', '1');
		Session::flash('visible_resources', '1');
		$pictures->appends('q',$searched_words);
		return View::make('frontend.picture.index', compact('pictures', 'searched_words'));
	}
}
