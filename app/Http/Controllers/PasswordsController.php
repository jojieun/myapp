<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PasswordsController extends Controller
{
    /**
     * Create new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRemind()
    {
        return view('remind');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postRemind(Request $request)
    {
        $email = $request->get('email');
        
        if(App\Reviewer::where('email', $email)->first()){
            $this->validate($request, [
            'email' => 'required|email|exists:reviewers',
            ]);
            $who='Reviewer';
        } else{
            $this->validate($request, [
            'email' => 'required|email|exists:advertisers',
            ]);
            $who='Advertiser';
        }
        
        return redirect(route('reset.create'))->with([
            'email'=>$email,
            'who'=>$who,
        ]);
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReset()
    {
        return view('pwreset', [
            'email'=>session()->get('email'),
            'who'=>session()->get('who'), 
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
        ]);
        $who='App\\'.$request->input('who');
        
        $who::whereEmail($request->input('email'))->first()->update([
            'password' => bcrypt($request->input('password'))
        ]);

        return view('pwresetdone');
    }

    /**
     * Make an error response.
     *
     * @param     $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function respondError($message)
    {
        flash()->error($message);

        return back()->withInput(\Request::only('email'));
    }

    /**
     * Make a success response.
     *
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function respondSuccess($message)
    {
        flash($message);

        return redirect('/');
    }
}
