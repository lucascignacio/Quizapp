<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('user/quiz/{quizId}', [ExamController::class, 'getQuizQuestions'])->middleware('auth');

Route::post('quiz/create', [ExamController::class, 'postQuiz'])->middleware('auth');

Route::get('/result/user/{userId}/quiz/{quizId}', [ExamController::class, 'viewResult'])->middleware('auth');



Route::group(['middleware' => 'isAdmin'], function(){

    Route::get('/', function () {
        return view('admin.index');
    });
    
    Route::resource('quiz', QuizController::class);
    Route::resource('user', UserController::class);
    Route::resource('question', QuestionController::class);

    Route::get('/quiz/{id}/questions', [QuizController::class, 'question'])->name('quiz.question');

    Route::get('exam/assign', [ExamController::class, 'create'])->name('user.exam');
    Route::post('exam/assign', [ExamController::class, 'assignExam'])->name('exam.assign');
    Route::get('exam/user', [ExamController::class, 'userExam'])->name('view.exam');
    Route::post('exam/remove', [ExamController::class, 'removeExam'])->name('exam.remove');

    Route::get('result', [ExamController::class, 'result'])->name('result');
    Route::get('result/{userId}/{quizId}', [ExamController::class, 'userQuizResult']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
