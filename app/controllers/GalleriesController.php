<?php

class GalleriesController extends BaseController {

	/**
	 * Country Repository
	 *
	 * @var Country
	 */
	protected $model;


	public function __construct(Gallery $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$galleries = $this->model->with(array('photos','videos'))->get();
		return $this->view('site.galleries.index',compact('galleries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('countries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Country::$rules);

		if ($validation->passes())
		{
			$this->model->create($input);

			return Redirect::route('countries.index');
		}

		return Redirect::route('countries.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$model = $this->model->findOrFail($id);

		return View::make('countries.show', compact('country'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$model = $this->model->find($id);

		if (is_null($model))
		{
			return Redirect::route('countries.index');
		}

		return View::make('countries.edit', compact('country'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Country::$rules);

		if ($validation->passes())
		{
			$model = $this->model->find($id);
			$model->update($input);

			return Redirect::route('countries.show', $id);
		}

		return Redirect::route('countries.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->model->find($id)->delete();

		return Redirect::route('countries.index');
	}

    public function getEvents($id) {
         $this->model->find($id)->events;
    }

}
