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
        $this->render('admin.videos.index',compact('videos'));
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
        $val           = $this->videoRepository->getCreateForm();

        if ( !$val->isValid() ) {

            if ( Request::ajax() ) return false;

            return Redirect::back()->withInput()->withErrors($val->getErrors());
        }

        if($this->isYoutubeVideo(Input::get('url'))) {
            dd('valid');
        } else {
            dd('invalid');
        }


        // resolve the class .. imageabele_type is the class name

        // save in the database
        $this->videoRepository->create($val->getInputData());

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

    public function isYoutubeVideo($value) {
        $isValid = false;
    //validate the url, see: http://snipplr.com/view/50618/
        //code adapted from Moridin: http://snipplr.com/view/19232/
        $idLength = 11;
        $idOffset = 3;
        $idStarts = strpos($value, "?v=");
        if ($idStarts === FALSE) {
            $idStarts = strpos($value, "&v=");
        }
        if ($idStarts === FALSE) {
            $idStarts = strpos($value, "/v/");
        }
        if ($idStarts === FALSE) {
            $idStarts = strpos($value, "#!v=");
            $idOffset = 4;
        }
        if ($idStarts === FALSE) {
            $idStarts = strpos($value, "youtu.be/");
            $idOffset = 9;
        }
        if ($idStarts !== FALSE) {
            //there is a videoID present, now validate it
            $videoID = substr($value, $idStarts + $idOffset, $idLength);
            $result = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$videoID));
//            $http = new HTTP("http://gdata.youtube.com");
//            $result = $http->doRequest("/feeds/api/videos/".$videoID, "GET");
//            returns Array('headers' => Array(), 'body' => String);
            dd($result);
            dd($result);
            $code = $result['headers']['http_code'];
            //did the request return a http code of 2xx?
            if (substr($code, 0, 1) == 2) {
                $isValid = true;
            }
        }
        return $isValid;
    }

}
