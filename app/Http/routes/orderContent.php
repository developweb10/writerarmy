<?php
Route::group(['middleware' => ['auth']], function() {
Route::get('content/menu', 'OrderContentController@index')->name('dashboard.order_content.menu');

Route::get('content/{id}', 'OrderContentController@createOrders');
Route::get('content/confirmation/{id}', 'OrderContentController@orderConfirmation');
Route::post('content/{id}', 'OrderContentController@storeOrders');
Route::post('updateContent','OrderContentController@updateContent');
Route::delete('content-delete/{id}',['as'=>'order.destroy','uses'=>'OrderContentController@destroyOrders']);
Route::get('depositFunds', 'DepositController@depositfund');
Route::post('depositFunds', 'DepositController@depositfund');
Route::get('transactions', 'DepositController@transaction');
Route::post('/postDepositFund', 'DepositController@postDepositFund');
Route::get('paymentMethod', 'DepositController@paymentMethod');
Route::post('/postPaymentMethod', 'DepositController@postPaymentMethod');
Route::post('/autoDeposit', 'DepositController@autoDeposit');
Route::delete('deleteCard/{id}','DepositController@deleteCard');
Route::get('thank-you/{id}','DepositController@thankYou');
});
?>

