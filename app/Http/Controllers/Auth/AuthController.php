<?php

namespace App\Http\Controllers\Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\Acl\Entities\User;
use Modules\Acl\Entities\Role;
use Validator;
use Flash;

use App\Events\UserSignup;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Lang;
use App\Models\EmailTemplate;

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

//    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use ThrottlesLogins;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
	
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone'    => empty(!$data['phone']) ? $data['phone'] : null,
            'company_name'    => empty(!$data['company_name']) ? $data['company_name'] : null,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => config('project_settings.users.confirm_email') ? 0 : 1,	
        ]);
		$user = User::find($user->id);
		$user->status = $data['status'];
        $user->save();
		

        $user->roles()->attach($data['role']);

        event(new UserSignup($user));

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data['roles'] = Role::where('slug', '!=', 'admin')->get();       
        if (property_exists($this, 'registerView')) {
            return view($this->registerView, $data);
        }

        return view('auth.register', $data);
    }
	
	 public function showWriterRegistrationForm()
    {
         $data['roles'] = Role::where('slug', '!=', 'admin')->get();  
		 if (property_exists($this, 'registerView')) {
            return view($this->registerView, $data);
        }

        return view('auth.writer_register', $data);
    }

    public function register(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }       
		if($request->role == 3){
			$this->create($request->except(['check']));
			\Laracasts\Flash\Flash::message('Thank you for signing up! Please check your email.');
			
		}
		else{
        Auth::guard($this->getGuard())->login($this->create($request->except(['check'])));

//        Auth::logout();

        \Laracasts\Flash\Flash::message('Thank you for signing up! Please check your email.');

//        return view('auth.login');      
		}
		  return redirect($this->redirectPath());
    }

    public function confirmAccount($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();
        
        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
				
		// send welcome message to User
        $confirm =EmailTemplate::find(2);
		$subjectmessage = $confirm->subject;	
		$emailmessage = $confirm->text;
		$emailmessage = str_replace('{{username}}',$user->name, $emailmessage);		
		$emailmessage = str_replace('{{useremail}}',$user->email, $emailmessage);
		$data = array('user'=>$user, 'subject'=>$subjectmessage);		
        Mail::send('auth.emails.welcomeemail', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user']->email, $data['user']->name)->subject($data['subject']); 
        });
		
       // send notification to admin

        $confirm =EmailTemplate::find(5); 
		$subjectmessage = $confirm->subject;	
		$emailmessage = $confirm->text;
		$emailmessage = str_replace('{{username}}',$user->name, $emailmessage);		
		$emailmessage = str_replace('{{useremail}}',$user->email, $emailmessage);		
        		
		$data = array('user'=>$user, 'subject'=>$subjectmessage);			
         Mail::send('auth.emails.newuser', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to('admin@writerarmy.com', 'admin')->subject($data['subject']); 
        });
		
		

//        \Laracasts\Flash\Flash::message('Thank you for confirming your account, please log in to order now.');

//        return redirect('login');
        return view('auth.emails.welcome_msg');
    }




//  Newly Added For login Confirmation

    public function getLogin()
    {
        return $this->showLoginForm();
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        
        $this->validateLogin($request);
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
         {
        $secret = '6LdWRL8UAAAAAOhyIfZYG1CS-eDJEaS255aXfkrB';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
          {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = array_add($this->getCredentials($request), 'confirmed', 1);
		 $credentials = array_add($this->getCredentials($request), 'status', 0);
//        dd($credentials);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
         if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
          }
        }
      }
    
   

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->logout();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }


    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
