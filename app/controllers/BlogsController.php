<?php

use Acme\Blog\BlogRepository;
use Acme\Category\CategoryRepository;
use Acme\Tag\TagRepository;
use Acme\User\UserRepository;

class BlogsController extends BaseController {

    protected $model;
    /**
     * @var Acme\Blog\BlogRepository
     */
    private $blogRepository;
    /**
     * @var Acme\Users\UserRepository
     */
    private $userRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @param BlogRepository $blogRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(BlogRepository $blogRepository, UserRepository $userRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {

        $this->blogRepository     = $blogRepository;
        $this->userRepository     = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository      = $tagRepository;
        parent::__construct();
    }

    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function index()
    {
        // Get all the blog posts
        $this->title = trans('word.blog');

        $posts = $this->blogRepository->getAllPaginated(['category', 'photos', 'author'], 1);

        $categories = $this->categoryRepository->getBlogCategories()->get();

        $tags = $this->tagRepository->getBlogTags();
        // Show the page
        $this->render('site.blogs.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * View a blog post.
     *
     * @param $id
     * @internal param string $slug
     * @return View
     */
    public function show($id)
    {
        // Get this blog post data
        $post = $this->blogRepository->findById($id, ['category', 'photos', 'author']);

        $this->title = $post->title;

        $this->render('site.blogs.view', compact('post'));
    }

    public function create()
    {
        // Title
        $category = ['' => trans('word.choose_category')] + $this->categoryRepository->getBlogCategories()->lists('name_ar', 'id');
        $this->render('site.blogs.create', compact('category'));
    }

    public function store()
    {
        // Validate the inputs
        $val = $this->blogRepository->getCreateForm();

        if ( !$val->isValid() ) {
            return Redirect::back()->withInput()->withErrors($val->getErrors());
        }

        if ( !$record = $this->blogRepository->create($val->getInputData()) ) {
            return Redirect::back()->with('errors', $this->blogRepository->errors())->withInput();
        }

//        return Redirect::action('AdminPhotosController@create', ['imageable_type' => 'Blog', 'imageable_id' => $record->id]);
        if ( Input::hasFile('name') ) {

            $photoService = App::make('PhotosController');

            // workaround to pass imageable_id to photos
            $upload               = $photoService->store();
            $upload->imageable_id = $record->id;
            $upload->save();

        }

        return Redirect::action('BlogsController@index')->with('success', trans('word.created'));
    }

    public function edit($id)
    {
        $post     = $this->blogRepository->findById($id, ['category', 'photos', 'author']);
        $category = ['' => trans('word.choose_category')] + $this->categoryRepository->getBlogCategories()->lists('name_ar', 'id');
        $this->render('site.blogs.edit', compact('post', 'category'));
    }

    public function update($id)
    {
        $record = $this->blogRepository->findById($id);

        $val = $this->blogRepository->getEditForm($id);

        if ( !$val->isValid() ) {

            return Redirect::back()->with('errors', $val->getErrors())->withInput();
        }

        if ( !$this->blogRepository->update($id, $val->getInputData()) ) {

            return Redirect::back()->with('errors', $this->blogRepository->errors())->withInput();
        }

        if ( Input::hasFile('name') ) {

            $photoService = App::make('PhotosController');

            // workaround to pass imageable_id to photos
            $photoService->store();
        }

        return Redirect::action('BlogsController@edit', $id)->with('success', trans('word.created'));
    }

}
