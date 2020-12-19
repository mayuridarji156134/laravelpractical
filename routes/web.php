<?php

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
//rout to load home page that will display list of students
Route::get('/home', 'StudentController@index')->name('student.index');

// Load data of studeents using ajax
Route::get('student-data', 'StudentController@getdata')->name('student.data');

// Load form of student details
Route::get('/student/add', 'StudentController@create')->name('student.add');

// store student data
Route::post('/student/store', 'StudentController@store')->name('student.store');
