<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
	if(Auth::check()){
		return redirect()->route('social.users.show', Auth::id());
	}else{
		return view('welcome');
	}
})->name('glavn');
Route::get('/reg', function () {
    return view('reg');
})->name('registr');
//рекомендации
Route::get('/home/{id}', 'HomeController@index')->name('home');
Auth::routes();
$groupData = [
	'namespace'	=>	'Social',
];	
Route::group($groupData, function() {
//Маршрут к Контролеру для Пользователей 
 Route::resource('users' , 'SocialUserController')
    ->middleware('auth')
    ->except(['show'])
    ->names('social.users');
Route::Get('/user/{id}','SocialUserController@show')
 ->middleware('auth')->name('social.users.show');
 //Маршрут для Обновления фото и имени пользователя
 Route::post('/users/{id}/name', 'SocialUserController@updateNamePhoto')
 ->name('social.user.name');
 //Запрос на подгрузку пользователей 
 Route::Get('/ajax/users/{id}','SocialAjaxUserController@UseraUpload')
 ->middleware('auth')->name('social.users.ajax.upload');
//Маршрут для подписки 
 Route::Get('/ajax/users/sub/{suber}','SocialAjaxUserController@UserSubscrube')
 ->middleware('auth')->name('social.users.ajax.subscrube');
 //Маршрут для отписок 
 Route::Get('/ajax/users/unsub/{suber}','SocialAjaxUserController@UserUnSubscrube')
 ->middleware('auth')->name('social.users.ajax.unsubscrube');
// Маршрут для поиска пользоватилей 
 Route::Post('/users/search','SocialUserController@searchUser')
 ->middleware('auth')->name('social.users.serach.user');
// Маршрут на страницу Подписок 
 Route::Get('/users/frends/{id}','SocialUserController@frends')
 ->middleware('auth')->name('social.users.frends.user');
// Маршрут на страницу Подписчиков 
 Route::Get('/users/subers/{id}','SocialUserController@subers')
 ->middleware('auth')->name('social.users.subers.user');
//Маршрут к Контролеру для Постов Пользователй 
  Route::resource('posts' , 'SocilaPostController')
    ->middleware('auth')
    ->names('social.posts');
 //Звгрузка постов на стрвнице пользователей 
 Route::Get('/ajax/posts/{id}','SocialAjaxPostController@PostsUpload')
 ->middleware('auth')->name('social.posts.ajax.upload');
//Подрузка постов в новости 
 Route::get('/ajax/posts/news/{skip}','SocialAjaxPostController@NewsUpload')
 ->name('social.posts.ajax.news');
 //Получение одного поста 
 Route::get('/ajax/posts/onepost/{id}','SocialAjaxPostController@Post')
 ->name('social.posts.ajax.onepost');
//Сохранение коементариев 
  Route::get('/ajax/comment/{id_post}/{text_com}','SocialAjaxCommentController@SaveComment')
 ->middleware('auth')->name('social.comments.ajax.save');
 //Получение комментариев
   Route::get('/ajax/comment/{id_post}','SocialAjaxCommentController@SendComments')
 ->middleware('auth')->name('social.comments.ajax.send');
 //Новости
 Route::Get('/news','SocilaPostController@news')
 ->middleware('auth')->name('social.posts.news');	
});