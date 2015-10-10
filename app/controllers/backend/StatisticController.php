<?php
namespace backend;
use View; use Article; use Input; use Redirect; use Validator; use Session; use Email; use Mail; use Statistic; use Request; use DateTime;
class StatisticController extends \BaseController {

	public function index()
	{
		$statistics = Statistic::paginate(10);
		return View::make('backend.statistic.index', compact('statistics'));
	}

	public function show($id)
	{
		$statistic = Statistic::find($id);
		return View::make('backend.statistic.show', compact('statistic'));
	}

	public function destroy($id)
	{
		$statistic = Statistic::find($id);
		if ($statistic->delete()) {
			$messages = array('La statistique a été bien supprimée.');
			return Redirect::back()->withMessages($messages);
		}
	}
}
