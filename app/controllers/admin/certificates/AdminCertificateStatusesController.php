<?php

use Acme\Mail\SubscriptionMailer;
use Acme\Repo\Statuses\StatusInterface;

class AdminCertificateStatusesController extends AdminBaseController {

    protected $user;
    protected $mailer;
    protected $category;
    protected $status;
    protected $repo;
    /**
     * @var CertificateRequest
     */
    private $request;

    function __construct( User $user,  User $user, CertificateStatus $status, SubscriptionMailer  $mailer, CertificateRequest $request )
    {
        $this->user = $user;
        $this->status = $status;
        $this->mailer = $mailer;
        parent::__construct();
        $this->beforeFilter('admin');
        $this->request = $request;
    }

    public function create(StatusInterface $repo)
    {
        $this->repo = $repo;
        return $this;
    }

    public function edit($id)
    {
        $request = $this->status->with(array('user','request','request.type'))->find($id);
        if (is_null($request))
        {
            return parent::redirectToAdmin();
        }

        return View::make('admin.certificates.statuses.edit', compact('request'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $setStatus = Input::get('status');
        $reason = Input::get('body');
        $status = $this->status->findOrFail($id);
        $request  = $this->request->findOrFail($status->request_id);
        $user   = $this->user->findOrFail($request->user_id);
        // filter the input value ..
        // make the input value classname convention
        // instantiate the class
        // set status
        $class = 'Acme\\Repo\\CertificateStatuses\\'. ucfirst(strtolower($setStatus));
        return $this->create(new $class)->setStatus($request,$user,$status,$reason);
    }

    public function destroy($id)
    {
        $status = $this->status->findOrFail($id);
        $request  = $this->request->findOrFail($status->request_id);
        $user   = $this->user->findOrFail($status->user_id);
        if ($request->find($id)->delete()) {
            $request->subscriptions()->detach($user);
            return Redirect::action('AdminStatusesController@index')->with(array('success'=>'Request Deleted'));
        } else {
            return Redirect::action('AdminStatusesController@index')->with(array('error'=>'Request Could not be Deleted'));
        }

    }

    /**
     * @param $event
     * @param $user
     * @param $status
     * @return mixed
     * Set the Status of an Event
     */
    public function setStatus($request,$user,$status,$reason) {
        return $this->repo->setAction($request,$user,$status,$reason);
    }
}