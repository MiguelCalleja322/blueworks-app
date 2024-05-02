<?php

namespace App\Http\Service;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\UserIdentification;
use App\Models\UserInformation;
use App\Models\UserRole;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function register(RegisterRequest $request) {
        $age = Carbon::now()->diffInYears($request->input('birthdate'));
        if ($age < 18) {
            return response()->json(['age' => 'You must be 18 yrs. old and above to register.'], 403);
        }

        $username = trim(preg_replace('/\s+/', '', $request->input('username')));

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $userInformation = UserInformation::create([
            'user_id' => $user->id,
            // 'avatar' => $request->input('avatar'),
            'username' => $username,
            'mobile' => $request->input('mobile'),
            'birthdate' => Carbon::parse($request->input('birthdate'))->format('Y-m-d'),
            'gender' => $request->input('gender'),
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $request->input('role_id')
        ]);

        $tokeneable = Hash::make($user);

        $token = $user->createToken($tokeneable)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'name' => $user->name,
            'username' => $userInformation->username,
            'mobile' => $userInformation->mobile,
            'avatar' => $userInformation->avatar,
            'email' => $userInformation->email,
        ], 200);
    }

    public static function login(Request $request) {
        $user = User::where('email', $request->input('email'))->first();

        if(!$user){
            return response()->json([
                'error' => 'User not Found!'
            ], 404);
        }

        if ($user && (Hash::check($request->input('password'), $user->password))) {
            $tokeneable = Hash::make($user);
        } else {
            return response()->json([
                'message' => 'Either Email is not associated to any user or incorrect password.',
            ], 404);
        }

        return $user->createToken($tokeneable)->plainTextToken;
    }

    public static function logout() {
        $authUser = Auth::user();

        $authUser->tokens()->delete();
    }

    public static function requestOTP()
    {
        $authUser = Auth::user();

        $otp = random_int(100000, 999999);

        UserVerification::where('user_id', $authUser->id)->update(['is_active' => false]);

        $userVerification = UserVerification::create([
            'user_id' => $authUser->id,
            'otp' => $otp,
            'is_active' => true,
        ]);

        $message = [
            'greeting' => 'Dear ' . $authUser->name . ',',
            'body' => 'Your verification code: '. $userVerification->otp .' and use it to verify your account.',
        ];

        // Mail::to($authUser->email)->send(new MyTestEmail($name));

        // Notification::send($authUser, new SMSNotification($message));

        return response()->json([
            'message' => 'Your OTP is underway. Please check your inbox.',
        ]);

        // Mail::to($authUser->email)->queue(new SignupVerificationMail($authUser, $userVerification));
    }

    public static function verifyAccount(Request $request) {
        $authUser = Auth::user();
        $otp = $request->input('otp') ?? null;

        if($otp) {
            $userVerify = UserVerification::where('otp', $otp)
            ->where('is_active', true)
            ->where('user_id', $authUser->id)
            ->whereDate('created_at', '=', Carbon::now())
            ->first();

            if (! $userVerify) {
                return response()->json([
                    'error_otp' => 'OTP does not exists',
                ], 404);
            }

            $authUser->update(['is_verified' => true]);

            $userVerify->update(['is_active' => false]);
        } else {
            return response()->json([
                'error_otp' => 'Missing OTP',
            ], 404);
        }

        return response()->json([
            'is_verified' => $authUser->is_verified,
            'message' => 'Account is now verified.',
        ], 200);
    }

    public static function verifyUser(Request $request) {

        $authUser = Auth::user();

        //GCP code here

        UserIdentification::updateOrCreate([
            'user_id' => $authUser->id,
            'type' => $request->input('type'),
            'id_number' => $request->input('id_number'),
            'issued_date' => $request->input('issued_date'),
            // 'url_reference' => $request->input('url_reference'),
        ]);

        return response()->json([
            'message' => 'User Verification is underway. Please wait 24 to 48 hours'
        ]);
    }
}
