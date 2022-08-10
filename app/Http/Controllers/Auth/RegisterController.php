<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Enums\UserType;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use App\Requests\RegisterRequest;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        dd($request->all());
        $name = \Request::input('identity');
        dd($name);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'identity' => ['required', 'image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        dd(json_encode($data));
        $name = $data['identity']->getClientOriginalName();
        $path = $data['identity']->store('public/images/identity');

        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => 0,
            'identity' => $path,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {

        if ($request->role == 2) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validated) {
                return User::create([
                    'name' => $request->name,
                    'role' => $request->role,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => 0,
                    'password' => Hash::make($request->password),
                ]);
            }
        } else {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'identity' => ['required', 'image'],
            ]);


            if ($validated) {
                $name = $request->file('identity')->getClientOriginalName();
                $path = $request->file('identity')->store('public/images/identity');
                return User::create([
                    'name' => $request->name,
                    'role' => $request->role,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => 0,
                    'identity' => $path,
                    'password' => Hash::make($request->password),
                ]);
            }
        }
    }
}
