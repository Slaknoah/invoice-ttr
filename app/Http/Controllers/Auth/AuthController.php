<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    public function login(Request $request) {

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        $http = new Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username'      => $request->username,
                    'password'      => $request->password,
                    'scope'         => '*',
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        }
        catch (BadResponseException $e) {
            if ($e->getCode() === 401)
                abort($e->getCode(), __('auth.failed'));
            else 
                abort($e->getCode(), __('general.server_error'));
        }
    }
    
    public function refreshToken(Request $request) {

        $request->validate([
            'refresh_token' => 'required|string',
        ]);
        $http = new Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'refresh_token', 
                    'refresh_token' => $request->refresh_token,
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'scope' => '*',
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        }
        catch (BadResponseException $e) {
            if ($e->getCode() === 401)
                abort($e->getCode(), __('auth.failed'));
            else 
                abort($e->getCode(), __('general.server_error'));
        }
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user_role = Role::findOrFail(config('auth.default_user_role_id'));
        $user->role()->associate($user_role)->save();
        $user->sendApiEmailVerificationNotification();

        return $user;
    }

    public function logout() {
        auth()->user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'You are logged out.'], 200);
    }

}
