<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Supplier;
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'fax_number' => ['required'],
            'person_in_charge' => ['required', 'string'],
            'capital_of_enterprise' => ['required'],
            'ceiling_value' => ['required'],
            'type' => ['required'],
            'national' => ['required'],
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
        return Supplier::create([
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'fax_number' => $data['fax_number'],
            'website' => $data['website'],
            'person_in_charge' => $data['person_in_charge'],
            'capital_of_enterprise' => $data['capital_of_enterprise'],
            'ceiling_value' => $data['ceiling_value'],
            'type' => $data['type'],
            'national' => $data['national'],
        ]);
    }
}
