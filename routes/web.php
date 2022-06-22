<?php


// Load the home page
Route::get('/', 'PagesController@index')->name('home');

// Post potential client
Route::post('/', 'PotentialsController@index')->name('potential');

// Register authentication routes
Auth::routes();

// Post the contacts message
Route::get('/contact', 'ContactController@create')->name('contact.create');
Route::post('/contact', 'ContactController@store')->name('contact.store');

// Show the page indicating news letter sign up
Route::post('/newsletter-sign-up', 'NewsLetterSignUpController@signUp')->name('news-letters.sign-up');

// Show the page indicating registration is complete
Route::get('/complete', 'Auth\RegisterController@complete')->name('complete');

// Confirm registration
Route::get('/confirm/{code}', 'Auth\RegisterController@confirm')->name('confirm');

// Load the dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Check Email
Route::post('check-email', 'ProfileController@checkEmail');
Route::post('check-writer', 'ProfileController@checkWriter');

// Orders
Route::get('order/{level?}', 'OrdersController@index')->name('orders.create');
Route::post('order', 'OrdersController@store')->name('orders.store');
Route::get('order-enquiry', 'OrderEnquiryController@create')->name('enquiry.create');
Route::post('order-enquiry', 'OrdersController@enquiry')->name('enquiry.store');
Route::group(['middleware' => 'auth'], function () {
    Route::get('orders/pending', 'OrdersController@pending')->name('orders.pending');
    Route::get('orders/assigned', 'OrdersController@assigned')->name('orders.assigned');
    Route::get('orders/submitted', 'OrdersController@submitted')->name('orders.submitted');
    Route::get('orders/reviewed', 'OrdersController@reviewed')->name('orders.reviewed');
    Route::get('orders/disputed', 'OrdersController@disputed')->name('orders.disputed');
    Route::get('orders/archived', 'OrdersController@archived')->name('orders.archived');
    Route::get('orders/download/{mediaItem}', 'OrdersController@download')->name('orders.download');
    Route::post('orders/add-new-files/{id}', 'OrdersController@addNewFiles')->name('orders.add-new-files');
    Route::get('orders/{id}/edit', 'OrdersController@edit')->name('orders.edit');
    Route::post('orders/complete/{id}', 'OrdersController@complete')->name('orders.complete');
    Route::post('orders/accept/{id}', 'OrdersController@accept')->name('orders.accept');
    Route::post('orders/review/{id}', 'OrdersController@review')->name('orders.review');
    Route::post('orders/dispute/{id}', 'OrdersController@dispute')->name('orders.dispute');
    Route::post('orders/solve-dispute/{id}', 'OrdersController@solveDispute')->name('orders.solve-dispute');
    Route::get('orders/{id}', 'OrdersController@show')->name('orders.show');
});

// Order Notifications
Route::post('order-submitted', 'OrdersController@orderSubmitted');
//payments
Route::get('payment', 'PaymentController@index')->name('payment');
Route::get('tpayment', 'TpaymentsController@payment')->name('create.payment');


// Gateway Result
Route::get('paypal-complete', 'GatewayResultController@payPalComplete')->name('paypal-complete');
Route::get('paypal-cancel', 'GatewayResultController@payPalCancel')->name('paypal-cancel');

Route::get('flutterwave-callback', 'GatewayResultController@flutterwave')->name('flutterwave.callback');

// Wallet
Route::get('wallet', 'WalletController@index')->name('wallet');
Route::post('wallet-deposit', 'WalletController@deposit')->name('wallet-deposit');
Route::post('check-wallet', 'WalletController@checkWallet')->name('check-wallet');

// Messages
Route::get('messages', 'MessagesController@index')->name('messages.index');
Route::get('messages/download/{mediaItem}', 'MessagesController@download')->name('messages.download');
Route::post('messages', 'MessagesController@store')->name('create-message');
Route::post('messages/read', 'MessagesController@doRead')->name('read-message');
Route::post('messages/reply', 'MessagesController@replyMessage')->name('reply-message');

// Notifications
Route::get('notifications', 'NotificationsController@index')->name('notifications');
Route::post('read-notifications', 'NotificationsController@read')->name('read-notifications');
Route::post('delete-notifications', 'NotificationsController@delete')->name('delete-notifications');

// Profile
Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('update-profile', 'ProfileController@update')->name('profile.update');
Route::get('settings', 'ProfileController@settings')->name('settings');
Route::put('update-password', 'ProfileController@updatePassword')->name('update-password');

// Blog
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'PostsController@index')->name('posts.index');
    Route::get('/search', 'PostsController@search')->name('search');
    Route::get('/{slug}', 'PostsController@show');
});
//writers
Route::group(['prefix' => 'writer'], function () {
    Route::get('/', 'ExpertController@index')->name('experts.index');
    Route::get('/{id}', 'ExpertController@show')->name('experts.show');
});

//samples

Route::group(['prefix' => 'samples'], function () {
    Route::get('/', 'SampleController@index')->name('samples.index');
    Route::get('/search', 'SampleController@search')->name('samples.search');
    Route::get('/{slug}', 'SampleController@show')->name('samples.show');
});

//expert
Route::group(['prefix' => 'writers'], function () {
    Route::get('/', 'ExpertController@index')->name('experts.index');
    Route::get('/{id}', 'ExpertController@show')->name('experts.show');
});
// Pricing
Route::get('/pricing', 'PricesController@index')->name('pricing.index');

// Handle Notification
Route::group(['prefix' => 'notifications'], function () {
    Route::post('new-message', 'NotificationsController@newMessage');
    Route::post('order-submitted', 'NotificationsController@orderSubmitted');

    Route::post('account-suspended', 'NotificationsController@accountSuspended');
    Route::post('account-un-suspended', 'NotificationsController@accountUnSuspended');
    Route::post('account-activated', 'NotificationsController@accountActivated');
    Route::post('account-deactivated', 'NotificationsController@accountDeactivated');
});

// This should be the last item
Route::get('{page}', 'PagesController@page');

