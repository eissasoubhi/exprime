<?php
namespace frontend;
use View; use Article; use Input; use Redirect; use Validator; use Session; use Email; use Mail;
class ArticleController extends \BaseController {

	public function index($name)
	{
		$page_title = str_replace(array('-','_'),' ',$name);
		$article = Article::where('name','=', $name)->get()->first();
		if (!$article) {
			return "404 :(";
		}
		return View::make('frontend.article.index', compact('article','page_title'));
	}

	public function contact()
	{
		$page_title = "Contact";
		return View::make('frontend.article.contact', compact('page_title'));
	}

	public function send()
	{
		// return dd(Input::all());
		$email = Input::get('email');
		$full_name = Input::get('full-name');
		$subject = Input::get('subject');
		$message = Input::get('message');

		$validator = Validator::make(
		    array('email' => $email,
				'fullname' => $full_name,
				'subject' => $subject,
				'message' => $message),
		    array('email' => 'required|email',
		    	'fullname' => 'required|min:5',
		    	'subject' => 'required|min:5',
		    	'message' => 'required|min:5')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::back()->withErrors($messages)->withInput();
		}
		// return $content;
		Email::create(array('email' => $email,
							'fullname' => $full_name,
							'subject' => $subject,
							'content' => $message));
		Mail::queue('frontend.article.email',
			array("email" => $email,
					"fullname" => $full_name,
					"subject" => $subject,
					"content" => $message),
			function($message) {
		        $message->to("eissa.soubhi@gmail.com")
		            	->subject('exprime contact : '.Input::get('subject'));
	        });
		$messages = array('Le message a été envoyé.');
		return Redirect::back()->withMessages($messages);
	}
}
