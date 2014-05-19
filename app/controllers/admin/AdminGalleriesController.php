<?php

class AdminGalleriesController extends AdminBaseController {

	/**
	 * Category Repository
	 *
	 * @var Category
	 */
	protected $model;
    /**
     * @var EventModel
     */
    private $event;
    /**
     * @var Category
     */
    private $category;
    /**
     * @var Photo
     */
    private $photo;

    public function __construct(Gallery $model, EventModel $event, Category $category, Photo $photo)
	{
		$this->model = $model;
        parent::__construct();
        $this->beforeFilter('Admin');
        $this->event = $event;
        $this->category = $category;
        $this->photo = $photo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->model->all();
		return View::make('admin.galleries.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $events = $this->event->all()->lists('title','id');
        $categories = $this->category->all()->lists('name','id');
		return View::make('admin.galleries.create',compact('events','categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = new $this->model(Input::all());
		if (!$validation->save())
		{
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
		}
		return Redirect::action('AdminGalleriesController@index')->with(array('success' => 'Gallery Created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = $this->model->findOrFail($id);

		return View::make('admin.galleries.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = $this->model->find($id);
        $events = $this->event->all()->lists('title','id');
        $categories = $this->category->all()->lists('name','id');
		if (is_null($category))
		{
			return Redirect::route('admin.categories.index');
		}

		return View::make('admin.galleries.edit', compact('category','events','categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
//		$input = array_except(Input::all(), '_method');
//		$validation = Validator::make($input, Category::$rules);
//
//		if ($validation->passes())
//		{
//			$category = $this->model->find($id);
//			$category->update($input);
//
//			return Redirect::to('categories.show', $id);
//		}
//
//		return Redirect::to('categories.edit', $id)
//			->withInput()
//			->withErrors($validation)
//			->with('message', 'There were validation errors.');
        // refer davzie postEdits();
        $validation = $this->model->find($id);
        $validation->fill(Input::all());
        if(!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        return Redirect::action('AdminGalleriesController@index');
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

		return Redirect::action('AdminGalleriesController@index');
	}


    public function getEvents($id){
        $events = $this->model->find($id)->events;
        return $events;
    }

    public function getPosts($id){
        $posts = $this->model->find($id)->posts;
        return $posts;
    }

    /**
     * @param $id galleryId
     *  list all the images for this Gallery
     */
    public function getPhotos($id) {
        $gallery = $this->model->with('photos')->find($id);
        return View::make('admin.galleries.photo',compact('gallery'));
    }

    /**
     * @param $id galleryId
     */
    public function postPhotos($id) {
        $gallery = $this->model->find($id);
        if(Input::hasFile('file')) {
            // call the attach image function from Photo class
            if(!$this->photo->attachImage($gallery->id,Input::file('file'),'Gallery','1')) {
                return Redirect::to('admin/gallery/' . $gallery->id . '/photo')->withErrors($this->photo->getErrors());
            }
        }
        // attach images
        // foreach new images upload the image
    }

}
