<?php

class AdminVideosController extends BaseController {

    /**
     * @var Galler
     */
    private $gallery;

    function __construct(Video $model,Gallery $gallery)
    {
        $this->model = $model;

        parent::__construct();
        $this->beforeFilter('Admin');
        $this->gallery = $gallery;
    }

	public function destroy($id)
	{
        $photo=  $this->model->findOrFail($id);
        if ($photo->delete()) {
            //  return Redirect::home();
            return Redirect::back()->with('success','Photo Deleted');
        }
        return Redirect::back()->with('error','Error: Photo Not Found');
	}

    public function attach($id,$name) {
        $gallery = $this->gallery->find($id);
        $keyword = $name;
        dd($keyword);
    }
}
