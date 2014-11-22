<?php

use Acme\Photo\ImageService;
use Acme\Photo\PhotoRepository;
use Illuminate\Support\Facades\Redirect;

class AdminVideosController extends AdminBaseController {

    private $videoRepository;

    private $photoImageService;

    function __construct(\Acme\Video\VideoRepository $videoRepository, ImageService $photoImageService)
    {
        $this->videoRepository   = $videoRepository;
        $this->photoImageService = $photoImageService;
        parent::__construct();
    }

    public function index()
    {
        $videos = $this->videoRepository->getAll();
        $this->render('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $videoableType = Input::get('videoable_type');
        $videoableId   = Input::get('videoable_id');
        if ( empty($videoableType) || empty($videoableId) ) {
            return Redirect::action('AdminVideosController@index')->with('warning', trans('word.error'));
        }

        $this->render('admin.videos.create', compact('videoableType', 'videoableId'));
    }

    /**
     * Store the Image
     * Resolve the Dependent class for polymorphic relation
     *
     */
    public function store()
    {
        $val = $this->videoRepository->getCreateForm();

        if ( !$val->isValid() ) {

            if ( Request::ajax() ) return false;

            return Redirect::back()->withInput()->withErrors($val->getErrors());
        }

        if (! $this->isYoutubeVideo(Input::get('url')) ) {

            return Redirect::action('AdminVideosController@index')->with('error', 'Not a Valid Youtube URL');
        }

        $this->videoRepository->create(array_merge(['videoable_id'=>Input::get('id'),'videoable_type'=>Input::get('videoable_type')],$val->getInputData())) ;
        return Redirect::action('AdminVideosController@index')->with('success', trans('word.saved'));


    }

    /**
     * @param $id Photo ID
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy($id)
    {
        $photo = $this->photoRepository->findById($id);
        if ( $photo->delete() ) {

            $this->photoImageService->destroy($photo->name);

            return Redirect::back()->with('success', 'Photo Deleted');
        }

        return Redirect::back()->with('error', 'Error: Photo Not Found');
    }

    /**
     * @param $value
     * @return bool
     * @todo Implenet
     */
    private function isYoutubeVideo($value)
    {
        return true;
    }

}
