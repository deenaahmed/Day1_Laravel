<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register(Request $request)
    {
        $requestData = $request->all();

        $data = $this->registerMethod($requestData);

        if ($result = $this->validator($data)) {
            return $result;
        }

        event(new Registered($user = $this->create($data)));

        return response()->json([
            'data' => [
                'message' => 'Register success!'
            ],
        ]);
    }

    /**
     * Check register method: (phone or email) or username
     * @param $data
     * @return mixed
     */
    protected function registerMethod($data)
    {
        if (empty($data['username'])) {
            $data['phone'] = empty($data['phone']) ? null : clear_phone($data['phone']);
        } else {
            $username = $data['username'];
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $data['email'] = $username;
            } else {
                $data['phone'] = clear_phone($username); //TODO: add check valid Phone
            }
        }
        return $data;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
