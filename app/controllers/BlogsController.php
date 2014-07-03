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
     * @var Category
     */
    private $category;
    /**
     * @var Photo
     */
    private $photo;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $model, User $user, Category $category, Photo $photo)
    {
        parent::__construct();
        $this->model = $model;
        $this->user = $user;
        $this->category = $category;
        $this->photo = $photo;
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
    public function show($id)
    {
        // Get this blog post data
        $post = $this->model->with(array('category','photos','author'))->find($id);
        return $this->view('site.blogs.view',compact('post'));
    }

    public function create(){
        // Title
        $category = [''=>'select a category'] + $this->category->getPostCategories()->lists('name', 'id');
        $this->view('site.blogs.create',compact('category'));
    }

    public function store()
    {
        // Validate the inputs
        $validation = new $this->model(array_merge(['user_id'=>Auth::user()->id],Input::except('thumbnail')));
        $validation->slug = Str::slug(Input::get('title'));
        if (!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        if(Input::hasFile('thumbnail')) {
            // call the attach image function from Photo class
            if(!$this->photo->attachImage($validation->id,Input::file('thumbnail'),'Post','0')) {
                return Redirect::action('BlogsController@edit',$validation->id)->with('error',$this->photo->getErrors());
            }
        }

        return Redirect::action('BlogsController@index')->with('success','Added Blog to the Database');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @internal param $post
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->getPostCategories()->lists('name', 'id');
        $post = $this->model->find($id);
        $this->view('site.blogs.edit',compact('category','post'));
        // Show the page
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @internal param $post
     * @return Response
     */
    public function update($id)
    {
        $validation = $this->model->find($id);
        $validation->fill(Input::except('thumbnail'));
        if (!$validation->save()) {
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        }
        if (Input::hasFile('thumbnail')) {
            if(!$this->photo->attachImage($validation->id,Input::file('thumbnail'),'Post','0')) {
                return Redirect::back()->withErrors($this->photo->getErrors());
            }
        }
        $post = $this->model->find($validation->id);
        $post->slug = Str::slug(Input::get('title'));
        $post->save();
        return Redirect::action('BlogsController@index')->with('success','Updated Blog '. $validation->title);
    }
}
