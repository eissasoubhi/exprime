<?php
namespace backend;
use View; use Picture; use Input; use Redirect; use Validator; use Session; use Auth; use Hash; use Resize;
use File; use Keyword;
class PictureController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pictures = Picture::paginate(10);
		return View::make('backend.picture.index', compact('pictures'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		Session::flash('uploadify_resources', '1');
		return View::make('backend.picture.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$picture = Input::json()->all();
		$name =  $picture['name'];
		$width =  $picture['width'];
		$height =  $picture['height'];
		$size =  $picture['size'];
		$extension =  $picture['extension'];
		$token =  $picture['token'];
		$timestamp =  $picture['timestamp'];

		$verifyToken = "}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".$timestamp ;

		if (Hash::check($verifyToken, $token)) {
			$validator = Validator::make(
			    array('name' => $name,
						'width' => $width,
						'height' => $height,
						'extension' => $extension,
						'size' => $size),
			    array('name' => 'min:1',
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


			Picture::create(array('name' => $name,
							'user_id' => Auth::id(),
							'dimension' => $width."x".$height,
							'url_origin' => $name,
							'validated' => 1,
							'size' => $size));
			return "1";
		}


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$picture = Picture::find($id);
		$all_keywords = array();
		$picture_keywords = array();

		foreach (Keyword::all() as $key => $Keyword) {
			$all_keywords[$Keyword->id] = $Keyword->keyword;
		}

		foreach ($picture->keywords as $key => $Keyword) {
			$picture_keywords[] = $Keyword->id;
		}

		Session::flash('select2_resources', '1');
		return View::make('backend.picture.edit', compact('picture','all_keywords','picture_keywords'));
	}
	public function update($id)
	{

		$picture = Picture::find($id);

		if (Input::file('new_picture')) {

			if (!Input::file('new_picture')->isValid())
			{
				$error = array();

			    $errors[] = "La photo n'est pas valide : verifiez la taille, le max : 1Mo";

				return Redirect::back()->withErrors($errors);
			}
		}

		if ( Input::hasFile('new_picture') ) {
			$fileTypes = array('jpg','jpeg','png'); // File extensions

			$extension = Input::file('new_picture')->getClientOriginalExtension();

			if (in_array($extension, $fileTypes)) {

				// $name = Input::file('new_picture')->getClientOriginalName();
				$targetFolder = '/content'; // Relative to the root

				$full_name = time()."_".Auth::id().".".$extension;

				$targetPath = public_path() . $targetFolder;

				$size = Input::file('new_picture')->getSize();

				list($width, $height) = getimagesize(Input::file('new_picture')->getRealPath());

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

				    return Redirect::to("admin/picture/$id/edit")->withInput()->withErrors($messages);
				}

				$filename = public_path().$targetFolder."/".$picture->url_origin;
				if (File::exists($filename)) {
					if (!File::delete($filename))
					{
						$errors[] = 'Erreur de suppresssion de la photo de serveur !';
						return Redirect::route("admin/picture/$id/edit")->withErrors($errors);
					}
				}

				Input::file('new_picture')->move($targetPath, $full_name);

				if ($width > 550 || $height > 400) {

					$targetFile = rtrim($targetPath,'/') . '/' . $full_name;

					$resizeObj = new Resize($targetFile);
					// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage(550, 400, 'auto');

					$resizeObj -> saveImage($targetFile, 100);

					list($width, $height) = getimagesize($targetFile);

					$size = filesize($targetFile);
				}

				$picture->name = $full_name;
				$picture->url_origin = $full_name;
				$picture->dimension = $width."x".$height;
				$picture->size = $size;

			}

		}

		$picture->validated = Input::get("validated");

		$picture->save();

		$picture->keywords()->sync(Input::get("keywords"));

		$messages = array('La photo a été bien modifiée.');

		return Redirect::route('admin.picture.index')->withMessages($messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$picture = Picture::find($id);
		$messages = array();
		$errors = array();
		if ($picture->delete()) {
			$messages[] = 'La photo a été bien supprimée.';
		}
		else
		{
			$errors[] = 'Erreur de suppresssion de la photo de la base de données !';
		}
		$filename = public_path()."/content/".$picture->url_origin;

		if (File::exists($filename)) {
			if (!File::delete($filename))
			{
				$errors[] = 'Erreur de suppresssion de la photo de serveur !';
			}
		}
		if ( count($errors) > 0	) {
			return Redirect::route('admin.picture.index')->withErrors($errors);
		}
		if ( count($messages) > 0	) {
			return Redirect::back()->withMessages($messages);
		}

	}

	public function checkExists()
	{
		$targetFolder = '/content';

		if (file_exists(public_path() . $targetFolder . '/' . Input::get('filename') )) {
			return 1;
		} else {
			return 0;
		}
	}
	public function upload()
	{
		$targetFolder = '/content'; // Relative to the root

		$verifyToken = "}&p@-n@7#)jWf[n6#Vv+2-?x%zmWK.}ERKYp59d?".Input::get('timestamp');

		$user_id = Input::get('user_id');

		if (Input::hasFile('Filedata') && Hash::check($verifyToken, Input::get('token'))) {

			$fileTypes = array('jpg','jpeg','png'); // File extensions

			$extension = Input::file('Filedata')->getClientOriginalExtension();

			if (in_array($extension, $fileTypes)) {

				// $name = Input::file('Filedata')->getClientOriginalName();

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

				if ($width > 550 || $height > 400) {

					$targetFile = rtrim($targetPath,'/') . '/' . $full_name;

					$resizeObj = new Resize($targetFile);
					// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj -> resizeImage(550, 400, 'auto');

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
				return  json_encode($imageinfos, JSON_FORCE_OBJECT );
			} else {
				return  'Invalid file type.';
			}
		}
	}
	public function withoutNameAndKeywords()
	{
		Session::flash('jscroll_resources', '1');
		$pictures = Picture::whereRaw("((LENGTH(name) - LENGTH(REPLACE(name, '_', '')))/LENGTH('_')) <= 1")->paginate(12);
		return View::make('backend.user.index', compact('pictures'));
	}

	public function withNameOrKeywords()
	{
		Session::flash('jscroll_resources', '1');
		$pictures = Picture::whereRaw("((LENGTH(name) - LENGTH(REPLACE(name, '_', '')))/LENGTH('_')) > 1")->paginate(12);
		return View::make('backend.user.index', compact('pictures'));
	}
}
