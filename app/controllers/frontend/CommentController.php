<?php namespace frontend;
use Input; use View; use Comment; use Redirect; use Validator; use Picture; use Auth;
class CommentController extends \BaseController {

    public function store()
    {
        $validator = Validator::make(
            array('content' => Input::get('addComment'),
                  'user_id' => Auth::id(),
                  'picture_id' => Input::get('img')
            ),
            array('content' => 'max:255|min:1',
                  'picture_id' => 'integer|exists:picture,id'
                ));
        if ($validator->fails()) {
            $messages = $validator->messages();

            return Redirect::back()->withInput()->withErrors($messages);
        }

        $comment = Comment::create(array('content' => Input::get('addComment'),
                            'user_id' => Auth::id(),
                            'picture_id' => Input::get('img')
                            ));

        return Redirect::back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $messages = array();
        $errors = array();
        if (!$comment->delete()) {
            $errors[] = 'Erreur de suppresssion du commentaire !';
            return Redirect::back()->withErrors($errors);
        }

        return Redirect::back();

    }
    public function update($id)
    {
        $comment = Comment::find($id);
        // $comment->content = "ddd";
        // return dd(Input::all());
        $comment->content = Input::get('updateComment');
        $comment->save();

        return Redirect::back();

    }
}
