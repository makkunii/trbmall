<?php

namespace App\Http\Controllers\Web;


use App\Models\Otp;
use App\Models\User;
use App\Models\UserRole;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller

{

    public function login(){

        return view('login');

    }

    public function signup()
    {
        return view('login');
    }

    public function otp(Request $request)
    {
        if ($request->user()->email_verified_at != null) {
            return redirect()->route('dashboard');
        }

        if ($request->user()->contact == null) {
            return redirect()->route('verification.notice');
        }

        return view('auth.verify-otp');
    }

    public function otp_verify(Request $request)
    {
        if ($request->user()->email_verified_at != null) {
            return redirect()->route('dashboard');
        }

        $otp = Otp::where('user_id', $request->user()->id)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->where('isActive', 1)
            ->first();

        if ($otp == null) {
            return back()->withErrors([
                'otp' => 'Invalid OTP',
            ]);
        }

        $user = User::find($request->user()->id);
        $user->email_verified_at = now();
        $user->save();

        $otp->isActive = 0;
        $otp->save();

        return redirect()->route('dashboard');
    }

    public function otp_resend(Request $request)
    {
        if ($request->user()->email_verified_at != null) {
            return redirect()->route('dashboard');
        }

        $user = User::find($request()->user()->id);
        Otp::where('user_id', $user->id)
            ->where('isActive', 1)
            ->update(['isActive' => 0]);

        $sms = new SmsService();
        $otp = $sms->generateOtp($user->id);
        try {
            $sms->send($user->contact, "Your OTP is $otp");
        } catch (\Throwable $th) {
            return back()->withErrors([
                'email' => 'Unable send OTP.'
            ]);
        }

        return back()->with('resent', 'OTP SMS sent!');
    }

    public function storeslogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function storesignup(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:users,email', 'unique:users,contact'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $identifier = request()->input('email');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $filepath = public_path('images/profile' . '/' . $filename);
            Image::make($file->getRealPath())
                ->fit(100, 100)
                ->save($filepath);
        }
        else {
            $filename = null;
        }

        if(is_numeric($identifier)){
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'contact' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
                'type_id' => 4, // 4 == Mobile
                'role_id' => 5, // 5 == Patient
                'avatar' => $filename,
            ]);

            $sms = new SmsService();
            $otp = $sms->generateOtp($user->id);
            try {
                $sms->send($user->contact, "Your OTP is $otp");
            } catch (\Throwable $th) {
                return back()->withErrors([
                    'email' => "Unable send OTP. " . $th->getMessage()
                ]);
            }
        }

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
                'type_id' => 1, // 4 == Email
                'role_id' => 5, // 5 == Patient
                'avatar' => $filename,
            ]);

            event(new Registered($user));
        }


        if (Auth::attempt(['email'=>$user->email, 'password'=>$credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }


        return back()->withErrors([
            'email' => 'Unable to register.',
        ]);
    }

    public function storelogin(Request $request)
    {
        $credentials = $request->validate([
            'login-email' => ['required'],
            'login-password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['login-email'], 'password' => $credentials['login-password'], 'status_id' => 2])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'login-email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Select a google account to login with
     *
     * @return redirect
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the values from google Oauth
     *
     * @param Request $request
     * @return json
     */
    public function handleGoogleCallback(Request $request)
    {
        $DEACTIVATED = 1;

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $exception) {
            return redirect()->route('login')->withErrors([
                'login-email' => 'Error login using this google account.',
            ]);
        }

        $user = User::firstOrCreate(
            [
                'email' => $googleUser->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $googleUser->getName(),
                'type_id' => 3, // 3 == Google'
                'role_id' => 5, // 5 == Patient
            ]
        );

        if ($user->status_id == $DEACTIVATED) {
            return redirect()->route('login')->withErrors([
                'login-email' => 'Suspended Account, Contact Support To Reinstate Your Account.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Select a google account to login with
     *
     * @return redirect
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle the values from google Oauth
     *
     * @param Request $request
     * @return json
     */
    public function handleFacebookCallback(Request $request)
    {
        $DEACTIVATED = 1;

        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
        } catch (\Throwable $exception) {
            return redirect()->route('login')->withErrors([
                'login-email' => 'Error login using this facebook account.',
            ]);
        }

        $user = User::firstOrCreate(
            [
                'email' => $facebookUser->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $facebookUser->getName(),
                'type_id' => 2, // 2 == facebook
                'role_id' => 5, // 5 == Patient
            ]
        );

        if ($user->status_id == $DEACTIVATED) {
            return redirect()->route('login')->withErrors([
                'login-email' => 'Suspended Account, Contact Support To Reinstate Your Account.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }


} //end

