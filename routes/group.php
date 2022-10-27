<?php
/**
 * -----------------------------------------------------------------
 * NOTE : There is two routes has a name (user & group),
 * any change in these two route's name may cause an issue
 * if not modified in all places that used in (e.g Chatify class,
 * Controllers, chatify javascript file...).
 * -----------------------------------------------------------------
 */

use App\Http\Controllers\CallingController;
use App\Http\Controllers\GroupChatingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupMessagnerController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'messanger'], function () {

/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/', [GroupMessagnerController::class,'index'])->name('group.messanger');



Route::post('profile/update',[HomeController::class,'profileUpdate'])->name('profile.update');

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', [GroupMessagnerController::class,'idFetchData'])->name('group.info');

/**
 * Send message route
 */
Route::post('/sendMessage',[GroupMessagnerController::class,'send'])->name('group.send.message');
Route::post('/sendCall',[CallingController::class,'groupSendcallingRequest'])->name('group.send.call');
Route::get('/join/{messageId}/{groupId}',[CallingController::class,'groupJoinCalling'])->name('group.join.call');
// Route::get('/join/request/{id}',[CallingController::class,'joinRequest'])->name('join.request.modal');
Route::get('start/call/{id}',[CallingController::class,'groupStartCall'])->name('group.start.call');
Route::get('end/call/{id}',[CallingController::class,'groupEndCall'])->name('group.end.call');
/**
 * Fetch messages
 */
Route::post('/fetchMessages',[GroupMessagnerController::class,'fetch'])->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}',[GroupMessagnerController::class,'download'])->name(config('chatify.attachments.download_route_name'));


/**
 * Make messages as seen
 */
Route::post('/makeSeen', [GroupMessagnerController::class,'seen'])->name('group.messages.seen');

/**
 * Get contacts
 */
Route::get('/getContacts', [GroupMessagnerController::class,'getContacts'])->name('group.contacts.get');

/**
 * Update contact item data
 */
Route::post('/updateContacts',[GroupMessagnerController::class,'updateContactItem'])->name('contacts.update');




/**
 * Search in messenger
 */
Route::get('/search', [GroupMessagnerController::class,'search'])->name('group.search');

/**
 * Get shared photos
 */
Route::post('/shared', [GroupMessagnerController::class,'sharedPhotos'])->name('group.file.shared');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', [GroupMessagnerController::class,'deleteConversation'])->name('conversation.delete');

/**
 * Delete Message
 */
Route::post('/deleteMessage', [GroupMessagnerController::class,'deleteMessage'])->name('message.delete');

/**
 * Update setting
 */
Route::post('/updateSettings', [GroupMessagnerController::class,'updateSettings'])->name('avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', [GroupMessagnerController::class,'setActiveStatus'])->name('activeStatus.set');






/*
* [Group] view by id
*/
Route::get('/group/{id}', [GroupMessagnerController::class,'index'])->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', [GroupMessagnerController::class,'index'])->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id

});


//group routes
Route::get('create',[GroupChatingController::class,'create'])->name('group.create');
Route::post('store',[GroupChatingController::class,'store'])->name('group.store');
Route::get('add/user/{id}',[GroupChatingController::class,'addUser'])->name('add.users');
Route::get('remove/from/group/{id}/{userId}',[GroupChatingController::class,'removeFormGroup'])->name('remove.from.group');
// Route::post('add/users',[GroupChatingController::class,'addUser'])->name('add.users');