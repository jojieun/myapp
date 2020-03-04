<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Reviewer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Http\{RedirectResponse, Request, Response};
//use Laravel\Socialite\Facades\Socialite;
use Socialite;
use Laravel\Socialite\Two\User as SocialUser;

class SocialController extends Controller
{
    use AuthenticatesUsers;
    /**
     * SocialController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 주어진 provider에 대하여 소셜 응답을 처리합니다.
     *
     * @param Request $request
     * @param string  $provider
     * @return RedirectResponse|Response
     */
    public function execute(Request $request, string $provider)
    {

        if (! $request->has('code')) {
            return $this->redirectToProvider($provider);
        }

        return $this->handleProviderCallback($request, $provider);
    }

    /**
     * 사용자를 주어진 공급자의 OAuth 서비스로 리디렉션합니다.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    protected function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 소셜에서 인증을 받은 후 응답입니다.
     *
     * @param Request $request
     * @param string  $provider
     * @return RedirectResponse|Response
     */
    protected function handleProviderCallback(Request $request, string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        if ($user = Reviewer::where('email', $socialUser->getEmail())->first()) {
            $this->guard('web')->login($user, true);

            return redirect()->intended(route('reviewers.mypage'));
        }
//        return view('reviewers.social_create',['socialUser'=>$socialUser]);
        return redirect()->route('reviewers.social_register', ['social_email'=>$socialUser->getEmail(),'social_name'=>$socialUser->getName()]);
//        
//        return $this->social_register($request, $socialUser);
    }
    
    /**/
    protected function social_register($social_email, $social_name){
        return view('reviewers.social_create',['social_email'=>$social_email, 'social_name'=>$social_name]);
    }
    
     /**
     * 주어진 소셜 회원을 응용 프로그램에 등록합니다.
     *
     * @param Request    $request
     * @param SocialUser $socialUser
     * @return mixed
     */
    protected function register(Request $request, SocialUser $socialUser)
    {
        event(new Registered($user = Reviewer::create($socialUser->getRaw())));

//        $user->email_verified_at = Date::now();
//        $user->remember_token = Str::random(60);
        $user->save();

        $this->guard()->login($user, true);

        return $this->sendLoginResponse($request);
    }

    /**
     * 사용자 인증을 받았습니다.
     *
     * @param Request $request
     * @param User    $user
     */
    protected function authenticated(Request $request, Reviewer $user): void
    {
        flash()->success(__('auth.welcome', ['name' => $user->name]));
    }

    /**
     * 지원하지 않는 소셜 공급자에 대한 응답입니다.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    protected function sendNotSupportedResponse(string $provider): RedirectResponse
    {
        flash()->error(trans('auth.social.not_supported', ['provider' => $provider]));

        return back();
    }
}
