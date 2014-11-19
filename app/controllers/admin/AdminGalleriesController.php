<?php

class AdminGalleriesController extends AdminBaseController {

    private $galleryRepository;

    /**
     * @param \Acme\Gallery\GalleryRepository $galleryRepository
     */
    public function __construct(\Acme\Gallery\GalleryRepository $galleryRepository)
	{

        parent::__construct();
        $this->beforeFilter('Admin');
        $this->galleryRepository = $galleryRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->galleryRepository->getAll();
		return View::make('admin.galleries.index', compact('categories'));
	}

    public function show($id){

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }

}
