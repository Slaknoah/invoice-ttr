<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource as UserResource;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Storage;
use App\Search\UserSearch;

class UserController extends Controller
{
    /**
     * @param $request
     * @return bool|string
     */
    private function saveAvatar($request) {
        $avatar     =   $request->file('avatar');
        $filename   =   time() . '.' . $avatar->getClientOriginalExtension();
        $resize     =   Image::make($avatar)->fit(300, 300, function($constraint) {
            $constraint->aspectRatio();
        })->encode();
        Storage::put( "uploads/{$filename}", $resize);

        return $filename;
    }

    /**
     * @param FormRequest $request
     * @param User $user
     * @return User
     */
    private function saveUserFields(FormRequest $request, User $user) {
        $data = $request->validated();

        if ($request->filled('name'))
            $user->name = $data['name'];

        if ($request->filled('email'))
            $user->email = $data['email'];

        if ($request->filled('password'))
            $user->password = Hash::make($data['password']);

        if ($request->filled('phone'))
            $user->phone = $data['phone'];

        if($user->avatar) {
            if ($request->hasFile('avatar'))
                $user->avatar = $this->saveAvatar($request);
        } else {
            $avatar = $request->hasFile('avatar') ? $this->saveAvatar($request) : config('filesystems.default_file_name');
            $user->avatar = $avatar;
        }

        if ($request->has('isVerified')) {
            $verify = json_decode($data['isVerified']);
            if($verify) {
                if(!isset($user->email_verified_at))
                    $user->email_verified_at = date("Y-m-d g:i:s");
            } else {
                $user->email_verified_at = null;
            }
        }

        $roleIsset = $request->filled('role') && (int)$data['role'] > 0;
        if($user->role_id) {
            if ($roleIsset && $data['role'] !== $user->role_id)
                $user->role()->associate( Role::findOrFail($data['role']) );
        } else {
            $roleID = ($roleIsset) ? $data['role'] : config('auth.default_user_role_id');
            $user->role()->associate( Role::findOrFail($roleID) );
        }

        $user->save();
        return $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUser(Request $request) {
        return response()->json(new UserResource($request->user()));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getUsers(Request $request) {
        $this->authorize('list', User::class);
        $userSearch = new UserSearch;
        return UserResource::collection($userSearch->apply($request));
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAuthUser(UserUpdateRequest $request) {
        return $this->update($request, Auth::user());
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserUpdateRequest $request, User $user) {
        $this->authorize('update', $user);

        $user = $this->saveUserFields($request, $user);

        return response()->json([
            'message' => __('responses.user.updated'),
            'response' => new UserResource($user)
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserStoreRequest $request) {
        $this->authorize('create', User::class);
        $user = $this->saveUserFields($request, new User);

        return response()->json([
            'message' => __('responses.user.stored'),
            'response' => new UserResource($user)
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAuthUser() {
        $this->authorize('delete', Auth::user());

        return $this->destroy(Auth::user());
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user) {
        $this->authorize('delete', $user);

        $user->tokens->each(function($token, $key) {
            $token->delete();
        });
        $user->delete();

        return response()->json(['message' => __('responses.user.destroyed')], 201);
    }
}
