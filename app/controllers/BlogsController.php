<?php

class BlogsController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $model;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $model, User $user)
    {
        parent::__construct();
        $this->model = $model;
        $this->user = $user;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function index()
	{
		// Get all the blog posts
        $posts = $this->model->with(array('category','photos','author'))->latest()->paginate(1);
        return $this->view('site.blogs.index',compact('posts'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function show($slug)
	{
		// Get this blog post data
		$post = $this->model->with(array('category','photos','author'))->where('slug', '=', $slug)->first();
        return $this->view('site.blogs.view',compact('post'));
	}


    public function consultancy() {
        $posts=  $this->model
            ->with(array('category','photos','author'))
            ->select('posts.*')
            ->leftJoin('categories','categories.id','=','posts.category_id')
////            ->leftJoin('photos','photos.imageable_id','=','posts.id')
////            ->where('photos.imageable_type','=','Post')
            ->where('categories.name_en','=','consultancy')
//            ->where('category_id','=','5')
            ->orderBy('posts.created_at','DESC')
            ->paginate(4);
//        $posts = $this->model->getConsultancies();

        $this->layout->login = View::make('site.layouts.login');
//        $this->layout->ads = view::make('site.layouts.ads');
        $this->layout->nav = view::make('site.layouts.nav');
        $this->layout->maincontent = view::make('site.blog.consultancy', compact('posts'));
        $this->layout->sidecontent = view::make('site.layouts.sidebar');
        $this->layout->footer = view::make('site.layouts.footer');
    }
}
