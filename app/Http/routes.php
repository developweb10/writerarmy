<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*function blog_image_upload_path()
{
    return '/uploads/blog/';
}*/

function user_photo_path()
{
    return '/uploads/user/';
}

/**
 * These reoutes require the user NOT be logged in
 */
Route::group(['middleware' => ['guest']], function () {
    Route::get('register/verify/{token}', 'Auth\AuthController@confirmAccount')->name('account.confirm');
    Route::get('register/verify/resend/{user_id}', 'Auth\AuthController@resendConfirmationEmail')->name('account.confirm.resend');	
	
});

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('register/writer', 'Auth\AuthController@showWriterRegistrationForm');
    Route::get('/', function() {
        if ( !Auth::check()) {
            return redirect('login');
        }
        return redirect()->route('dashboard');
    }); 
    // Route::get('/', 'Frontend\FrontendController@index')->name('home');
     
     Route::post('postDepositFund', 'DepositController@postDepositFund');

     Route::get('template/edit/{id}', 'Backend\TemplateController@edit');
	 Route::post('updateTemplate', 'Backend\TemplateController@update');
   
    Route::get('/profile', 'UsersController@profile');
    Route::get('/profile/edit', 'UsersController@edit')->name('user.edit');
    Route::resource('user', 'UsersController',
                            ['only' => ['update']]);

    Route::get('/user/password/{id}',['as'=>'access.user.password','uses'=>'UsersController@changeUserPassword']);
    Route::post('/user/password/{id}',['as'=>'access.user.updatePassword','uses'=>'UsersController@updateUserPassword']);
	
	Route::get('/writers', 'UsersController@allWriters'); 
	Route::post('/updatewriter', 'UsersController@updateWriter'); 
	Route::get('/editwriter/{id}', 'UsersController@editWriter'); 

	Route::get('/users', 'UsersController@allUsers'); 
	
    Route::resource('blog', 'Frontend\BlogsController',
                            ['only' => ['index', 'show']]);

    Route::resource('package', 'Backend\PackagesController');
    
    Route::resource('jobs', 'Backend\JobController');
    Route::get('allJobs', 'Backend\JobController@allJobs');

    Route::resource('assignedJobs', 'Backend\AssignedJobController');
    Route::post('assignedJobs','Backend\AssignedJobController@assignedJobSearch');

    Route::post('assignedJobs/updateReview','Backend\AssignedJobController@updateReview');

    Route::post('assignedJobs/updateChat','Backend\AssignedJobController@updateChat');

    Route::delete('assignedJobs/{id}/delete',['as'=>'assignedJobs.destroy','uses'=>'Backend\AssignedJobController@destroyAssignedJob']);
    Route::get('assignedJobs/{id}/delete',['as'=>'assignedJobs.destroy','uses'=>'Backend\AssignedJobController@destroyAssignedJob']);
    Route::get('myJobs/screeningView', 'Backend\JobsProgressController@screening_view');
    Route::get('myJobs/writingView', 'Backend\JobsProgressController@writing_view');
    Route::get('myJobs/draftReadyView', 'Backend\JobsProgressController@draft_ready_view');
    Route::get('myJobs/revisingView', 'Backend\JobsProgressController@revision_view');
    Route::get('myJobs/finalReadyView', 'Backend\JobsProgressController@final_ready_view');
    Route::get('myJobs/acceptedView', 'Backend\JobsProgressController@order_accepted_view');

    Route::get('assignedOrders', 'Backend\AssignedJobController@client_view');
    Route::post('assignedOrders','Backend\AssignedJobController@assignedOrderSearch');
    Route::get('allOrders', 'Backend\OrderContentController@allOrders');	     
   Route::get('/payToWriter/{id}',  'Backend\OrderContentController@payToWriter'); 
   Route::post('notifyWriter',  'Backend\OrderContentController@notifyWriter'); 
   Route::post('paymentstatus',  'Backend\OrderContentController@paymentstatus'); 

    Route::get('addService', 'Backend\PackagesController@addPackage'); 
	Route::post('postAddPackage', 'Backend\PackagesController@postAddPackage');
	Route::get('list', 'Backend\PackagesController@listPackage');
	Route::get('packagedelete/{id}', 'Backend\PackagesController@deletePackage');
	Route::get('service/edit/{id}', 'Backend\PackagesController@editPackage');

    Route::get('assignedOrders/screeningView', 'Backend\OrderProgressController@screening_view');
    Route::get('assignedOrders/writingView', 'Backend\OrderProgressController@writing_view');
    Route::get('assignedOrders/draftReadyView', 'Backend\OrderProgressController@draft_ready_view');
    Route::get('assignedOrders/revisingView', 'Backend\OrderProgressController@revision_view');
    Route::get('assignedOrders/finalReadyView', 'Backend\OrderProgressController@final_ready_view');
    Route::get('assignedOrders/acceptedView', 'Backend\OrderProgressController@order_accepted_view');
	
     Route::get('messages', 'Backend\AssignedJobController@allmessages');
    Route::get('editmessage/{id}', 'Backend\AssignedJobController@editMessage'); 
	Route::post('updatemessage','Backend\AssignedJobController@updatemessage');
//    Route::post('final/payment', 'Backend\PaymentController@doPayment');
    Route::get('/emailtemplates', 'Backend\TemplateController@index'); 

    Route::get('/home', 'HomeController@index');


     Route::get('payment', 'Backend\PaypalController@index');
     Route::post('paypal', 'Backend\PaypalController@payWithpaypal');
     Route::get('status', 'Backend\PaypalController@getPaymentStatus');
     Route::post('status', 'Backend\PaypalController@getPaymentStatus');

    Route::group(['prefix' => 'dashboard'], function() {

        Route::get('/', 'ThemeController@dashboard')->name('dashboard');
        Route::resource('blog', 'Backend\BlogsController');

    });

    Route::group(['prefix' => 'theme'], function() {

        Route::get('/dashboard', 'ThemeController@dashboard_v1')->name('dashboard1');
        Route::get('/dashboard-2', 'ThemeController@dashboard_v2')->name('dashboard2');
        Route::get('/chartjs', 'ThemeController@chartjs')->name('chartjs');
        Route::get('/widgets', 'ThemeController@widgets')->name('widgets');

    });


    Route::group(['namespace' => 'Backend'], function ()
    {
        /********************************************
        *                                           *
        *    Get All routes from /routes folder     *
        *                                           *
        ********************************************/

        foreach (File::allFiles(__DIR__.'/routes') as $partial)
        {
          require_once $partial->getPathname();
        }
    });
});
