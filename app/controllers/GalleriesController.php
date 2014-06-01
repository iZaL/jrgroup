<?php

class GalleriesController extends BaseController {

	/**
	 * Country Repository
	 *
	 * @var Country
	 */
	protected $model;
    /**
     * @var Category
     */
    private $category;
    /**
     * @var EventModel
     */
    private $event;


    public function __construct(Gallery $model,Category $category, EventModel $event)
	{
		$this->model = $model;
        $this->category = $category;
        $this->event = $event;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//		$galleries = $this->model->with(array('photos'))->paginate(9);
//		return $this->view('site.galleries.index',compact('galleries'));
        //return gallery categories;
//        $galleries = $this->model->with(['category','photos'])->paginate(9);
//        $galleries = $this->category->where('type','=','Gallery')->get();
//        $categories = $this->category
//                        ->with(array('galleries.photos'))
//                        ->whereHas('galleries.photos',function($q){
//                            $q->where('id','>','0');
//                        })
//                        ->where('type','=','Gallery')
//                        ->get();
        $categories = $this->category
                        ->with(array('galleries'))
                        ->where('type','=','Gallery')
                        ->paginate(9);
//        foreach($categories as $category) {
//            var_dump($category->toArray());
//            foreach($category->galleries as $gallery) {
//                var_dump($gallery->toArray());
//                foreach($gallery->photos as $photo) {
//                    var_dump($photo->toArray());
//                }
//            }
//        }

        return $this->view('site.galleries.index',compact('categories'));

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
//		$model = $this->model->findOrFail($id);
		$galleries = $this->category->with('galleries')->find($id);
//        dd($galleries->toArray());
        return $this->view('site.galleries.view',compact('galleries'));
	}


    public function getDate($galleryId) {
        $date = '';
        $gallery = $this->model->find($galleryId);
        if($gallery) {
            if( $gallery->date_start ) {
                $date = $gallery->date_start;
            } else {
                if($gallery->event_id) {
//                    dd('event_attached');
                    $event = $this->event->find($gallery->event_id);
                    if($event) {
//                        dd('event_found');
                        if(!empty($event->date_start)) {
                            $date = $event->date_start;
                        }
                    }
                }
            }
        }
        return $date->format('D, M d Y');
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


    public function showAlbum($id)
    {
//		$model = $this->model->findOrFail($id);
        $album = $this->model->with('photos')->find($id);
        return $this->view('site.galleries.album', compact('album'));
    }

}
