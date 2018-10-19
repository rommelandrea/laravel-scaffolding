<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Socialite;
use App\UserSocial;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    protected static $allowedSocials = [
        //
    ];

    public function index(Request $request)
    {
        // Return the login view.
        // return view('login');
    }

    public function social($social, Request $request)
    {
        if (! in_array($social, self::$allowedSocials)) {
            // Redirect to home/login
        }

        if ($request->user()) {
            if (! $request->query('link')) {
                // Return to user profile
            }

            Session::put('user_id', $request->user()->id);
        }

        $scopes = [];

        // Set scopes on social basis.
        // if ($social == 'facebook') {
        //     $scopes = [];
        // }

        return Socialite::driver($social)->scopes($scopes)->stateless()->redirect();
    }

    public function socialConfirmation($social, Request $request)
    {
        if (! in_array($social, self::$allowedSocials)) {
            // Redirect to home/login; access not allowed.
        }

        $socialite = Socialite::driver($social)->stateless()->user();
        $userSocial = UserSocial::{$social}()->socialId($socialite->getId())->first();
        $sessionedUser = User::with($social)->find(Session::get('user_id'));

        Session::forget('user_id');

        if ($sessionedUser) {
            if ($sessionedUser->{$social}) {
                // The social is already connected.
                // Redirect.
            }

            if ($userSocial) {
                // The social is already connected to other account.
                // Redirect.
            }

            $sessionedUser->socials()->create([
                'social_id' => $socialite->getId(),
                'social_type' => $social,
                'email' => $socialite->getEmail(),
                'nickname' => $socialite->getNickname(),
                'name' => $socialite->getName(),
                'avatar_url' => str_replace(['?sz=50', '?type=normal'], '?type=large', $socialite->getAvatar()),
                'token' => $socialite->token,
                'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                'socialite' => $socialite,
            ]);

            \Auth::login($sessionedUser);

            // Redirect the user after authentication.
        }

        if ($userSocial) {
            $user = $userSocial->user()->first();

            $userSocial->update([
                'token' => $socialite->token,
                'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
                'socialite' => $socialite,
            ]);

            \Auth::login($user);

            // Redirect the user after authentication.
        }

        $user = User::with($social)->email($socialite->getEmail())->first();

        if (! $user) {
            // Create the user.
            // $user = User::create([
            //     'email' => $socialite->getEmail(),
            //     'name' => $socialite->getName(),
            // ]);

            // Attach the social account to the user.
            // $user->socials()->create([
            //     'social_id' => $socialite->getId(),
            //     'social_type' => $social,
            //     'email' => $socialite->getEmail(),
            //     'nickname' => $socialite->getNickname(),
            //     'name' => $socialite->getName(),
            //     'avatar_url' => str_replace(['?sz=50', '?type=normal'], '?type=large', $socialite->getAvatar()),
            //     'token' => $socialite->token,
            //     'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
            //     'socialite' => $socialite,
            // ]);

            \Auth::login($user);

            // Redirect the user after authentication.
        }

        // Attach the social account to the user.
        // $user->socials()->create([
        //     'social_id' => $socialite->getId(),
        //     'social_type' => $social,
        //     'email' => $socialite->getEmail(),
        //     'nickname' => $socialite->getNickname(),
        //     'name' => $socialite->getName(),
        //     'avatar_url' => str_replace(['?sz=50', '?type=normal'], '?type=large', $socialite->getAvatar()),
        //     'token' => $socialite->token,
        //     'token_expiry' => ($socialite->expiresIn) ? now()->addSeconds($socialite->expiresIn) : null,
        //     'socialite' => $socialite,
        // ]);

        \Auth::login($user);

        // Redirect the user after authentication.
    }

    public function socialUnlink($social, Request $request)
    {
        if (! in_array($social, self::$allowedSocials)) {
            // Redirect to home/login; access not allowed.
        }

        $user = $request->user();
        $user->load(['socials', $social]);

        if (! $user->{$social}) {
            // The user does not have the social attached.
            // Redirect to user profile.
        }

        if ($user->socials->count() == 1) {
            // Cannot delete the last authentication method.
        }

        // $user->{$social}->delete();
        $user->{$social}->forceDelete();

        // Redirect the user after social unlinking.
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        // Redirect the user after logout.
    }
}
