<?php

use Acme\Mail\ContactsMailer;

class ContactsController extends BaseController {

    /**
     * Contact Repository
     *
     * @var Category
     */
    protected $model;

    /**
     * @var Acme\Mail\ContactsMailer
     */
    private $mailer;

    public function __construct(Contact $model, ContactsMailer $mailer)
    {
        $this->model = $model;
        $this->mailer = $mailer;
        parent::__construct();
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $contact = $this->model->first();
        $this->view('site.partials.contact', ['contact'=> $contact]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function contact()
	{
        $args = Input::all();
        $rules = array(
            'email'=>'required|email',
            'name'=>'required',
            'comment'=>'required|min:5'
        );
        $user = $this->model->first();
        $validate = Validator::make($args,$rules);
        if($validate->passes()) {
            if($this->mailer->sendMail($user,$args)) {
                return Redirect::home()->with('success','Mail Sent');
            }
            return Redirect::home()->with('error','Error Sending Mail');
        }
        return Redirect::back()->withInput()->with('error',$validate->errors()->all());

	}
}