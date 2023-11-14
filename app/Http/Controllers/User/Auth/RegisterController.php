<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Providers\Admin\BasicSettingsProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\UserWallet;
use App\Traits\User\RegisteredUsers;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    use RegistersUsers, RegisteredUsers;

    protected $basic_settings;

    public function __construct()
    {
        $this->basic_settings = BasicSettingsProvider::get();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm() {
        $client_ip = request()->ip() ?? false;
        $user_country = geoip()->getLocation($client_ip)['country'] ?? "";

        $page_title = setPageTitle("User Registration");
        return view('user.auth.register',compact(
            'page_title',
            'user_country',
        ));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validated = $this->validator($request->all())->validate();
        try{
            $validated['phone_code'] = get_country_phone_code($validated['country']);
        }catch(Exception $e) {
            return $this->breakAuthentication($e->getMessage());
        }
        $basic_settings             = $this->basic_settings;
        $validated['mobile']        = remove_speacial_char($validated['phone']);
        $validated['mobile_code']   = remove_speacial_char($validated['phone_code']);
        $complete_phone             = $validated['mobile_code'] . $validated['mobile'];

        if(User::where('full_mobile',$complete_phone)->exists()) {
            throw ValidationException::withMessages([
                'phone'     => 'Phone number is already exists',
            ]); 
        }

        $validated['full_mobile']       = $complete_phone;
        $validated = Arr::except($validated,['agree','phone_code','phone']);
        $validated['email_verified']    = ($basic_settings->email_verification == true) ? false : true; 
        $validated['sms_verified']      = ($basic_settings->sms_verification == true) ? false : true;
        $validated['kyc_verified']      = ($basic_settings->kyc_verification == true) ? false : true;
        $validated['password']          = Hash::make($validated['password']);
        $validated['username']          = make_username($validated['firstname'],$validated['lastname']);
        $validated['address']           = ['country' => $validated['country']];

        event(new Registered($user = $this->create($validated)));
        $this->guard()->login($user);

        return $this->registered($request, $user);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {

        $basic_settings = $this->basic_settings;
        $passowrd_rule = "required|string|min:6";
        if($basic_settings->secure_password) {
            $passowrd_rule = ["required",Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()];
        }

        return Validator::make($data,[
            'firstname'     => 'required|string|max:60',
            'lastname'      => 'required|string|max:60',
            'email'         => 'required|string|email|max:150|unique:users,email',
            'password'      => $passowrd_rule,
            'country'       => 'required|string|max:15',
            'phone_code'    => 'required|string|max:10',
            'phone'         => 'required|string|max:20',
            'agree'         => 'required|in:on',
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
        return User::create($data);
    }


    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->createUserWallets($user);
        return redirect()->intended(route('user.dashboard'));
    }
}
