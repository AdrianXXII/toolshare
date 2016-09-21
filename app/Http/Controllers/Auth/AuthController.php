<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:50|confirmed|regex:/(?=^.{6,50}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_+:;.,]).*$/',
            'company' => 'required|max:255',
            'street' => 'required|regex:/^([a-zA-Z0-9\.\-\säöüÄÖÜ])+$/|max:255',
            'zip' => 'required|max:8',
            'city' => 'required|regex:/^([a-zA-Z\.\-\säöüÄÖÜ])+$/|max:255',
            'country' => 'required|regex:/^([a-zA-Z\.\-\säöüÄÖÜ])+$/|max:255',
        ],[
            'email.required' => 'Die E-Mail muss angegeben werden!',
            'email.email' => 'Die E-Mail Adresse ist invalid!',
            'email.max' => 'Die E-Mail Adresse ist zu lange, sie darf nicht länger als 255 Zeichen sein!',
            'email.unique' => 'Diese E-Mail ist schon in gebrauch!',
            'password.required' => 'Das Password muss angegeben werden!',
            'password.regex' => 'Das Passwort muss ein Kleinbuchstaben, ein Grossbuchstaben, eine Zahl und ein Sonderzeichen enthalten! Valide Sonderzeichen sind: !@#$%^&*_+:;.,',
            'password.min' => 'Das Passwort muss länger als 6 Zeichen sein!',
            'password.max' => 'Das Passwort ist zu lange, sie darf nicht länger als 50 Zeichen sein! !',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein!',
            'company.required' => 'Die Firma muss angegeben werden!',
            'company.max' => 'Die Firma ist zu lange, sie darf nicht länger als 255 Zeichen sein! !',
            'street.required' => 'Die Strasse muss angegeben werden!',
            'street.regex' => 'Die Strasse ist invalid!',
            'street.max' => 'Die Strasse ist zu lange, sie darf nicht länger als 255 Zeichen sein! !',
            'zip.required' => 'Die Postleitzahl muss angegeben werden!',
            'zip.max' => 'Die Postleitzahl ist zu lange, sie darf nicht länger als 8 Zeichen sein! !',
            'city.required' => 'Die Stadt muss angegeben werden!',
            'city.regex' => 'Die Stadt ist invalid!',
            'city.max' => 'Die Stadt ist zu lange, sie darf nicht länger als 255 Zeichen sein! !',
            'country.required' => 'Das Land muss angegeben werden!',
            'country.regex' => 'Das Land ist invalid!',
            'country.max' => 'Das Land ist zu lange, sie darf nicht länger als 255 Zeichen sein! !',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'company' => $data['company'],
            'street' => $data['street'],
            'zip' => $data['zip'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);
    }
}
