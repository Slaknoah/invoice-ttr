<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationApiController extends Controller
{
    use VerifiesEmails;
    /**
    * Show the email verification notice.
    *
    */
    public function show()
    {
        //
    }
    /**
    * Mark the authenticated user’s email address as verified.
     *
     * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request) {
        if( $request['id']) {
            $userID = $request['id'];
            $user = User::findOrFail($userID);
            if($request['is_verification_link'] && !$user->email_verified_at) {
                $date = date("Y-m-d g:i:s");
                $user->email_verified_at = $date; 
                $user->save();
            }
        }
        return view('index');
    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            abort(422, __('responses.verification.verified'));
        }
        $request->user()->sendApiEmailVerificationNotification(); 
        return response()->json([
            'message' => __('responses.verification.sent')
        ]);
    }
}
