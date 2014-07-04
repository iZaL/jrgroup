<?php
/**
 * Created by PhpStorm.
 * User: ZaL
 * Date: 2/27/14
 * Time: 6:57 PM
 */

class NewslettersController extends BaseController{


    public function __contstruct() {
        parent::__construct();
    }

    /**
     * @internal param array $email Add a user to the newsletter list* Add a user to the newsletter list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store() {
        $getEmail = Input::get('email');
        $email['email'] = $getEmail;
        try {
            Notify::subscribeUser('76f171b4b9',$email);
            return Redirect::home()->with('success','Please confirm your Subscription in the email we have sent you');
        } catch (\Exception $e) {
            return Redirect::home()->with('error',$e->getMessage());
        }
    }

} 