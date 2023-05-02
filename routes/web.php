<?php

use App\Http\Controllers\Classrooms\ClassroomRegistrationsController;
use App\Http\Controllers\Classrooms\ClassroomsStatesController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\EstablishmentYearController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\FamillyControllerWeb;
use App\Http\Controllers\FamillyRegistrationControllerWeb;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Rooms\RoomController;
use App\Http\Controllers\Rooms\RoomsCapacitiesController;
use App\Http\Controllers\SendPaymentEmailController;
use App\Http\Controllers\StudentCommentController;
use App\Http\Controllers\StudentInterviewController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\Users\ClientController;
use App\Http\Controllers\Users\FamilyBoardController;
use App\Http\Controllers\Users\FamilyController;
use App\Http\Controllers\Users\StudentBoardController;
use App\Http\Controllers\Users\StudentController;
use App\Http\Controllers\WebRegistrationController;
use ElaborateCode\ResourceRoute\Facades\ResourceRoute;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------
| Web Routes
|-------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/inscription', [FamillyRegistrationControllerWeb::class, 'index'])->name('web.index');
Route::post('/inscription/store', [FamillyRegistrationControllerWeb::class, 'store'])->name('web.store');
Route::get('/inscription/{family}/student', [FamillyRegistrationControllerWeb::class, 'indexStudent'])->name('web.index.student');
Route::post('/inscription/{family}/student/store', [FamillyRegistrationControllerWeb::class, 'storeStudent'])->name('web.store.student');



/*
|-------------------------------------
| Auth Routes
|-------------------------------------
*/
require __DIR__.'/auth.php';

/*
|-------------------------------------
| Ressource Routes
|-------------------------------------
*/

Route::middleware('auth')->group(function () {
    ResourceRoute::index('establishments', EstablishmentController::class);

    Route::resource('establishment-years', EstablishmentYearController::class)->only(['index', 'show', 'create', 'store']);

    Route::controller(ClassroomsStatesController::class)->prefix('establishment-year/{establishment_year}/classrooms/states')
        ->group(function () {
            Route::get('edit', 'edit')->name('classrooms_states.edit');
            Route::post('update', 'update')->name('classrooms_states.update');
        });
    Route::get('classrooms/{classroom}/registrations', ClassroomRegistrationsController::class)->name('classrooms.registrations');

    Route::controller(RoomsCapacitiesController::class)->prefix('establishment-year/{establishment_year}/rooms/capacities')
        ->group(function () {
            Route::get('edit', 'edit')->name('rooms_capacities.edit');
            Route::post('update', 'update')->name('rooms_capacities.update');
        });

    ResourceRoute::store('rooms', RoomController::class);
    ResourceRoute::destroy('rooms', RoomController::class);

    Route::resource('families', FamilyController::class)->only(['index', 'create', 'store']);
    Route::get('families/{family}/board', FamilyBoardController::class)->name('families.board');

    Route::resource('clients', ClientController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

    Route::resource('students', StudentController::class)->only(['index', 'store', 'edit', 'update']);
    Route::get('students/{student}/board', StudentBoardController::class)->name('students.board');
    ResourceRoute::store('student-comments', StudentCommentController::class);

    // ?
    Route::resource('student-registrations', StudentRegistrationController::class);

    Route::resource('student-interviews', StudentInterviewController::class)->only(['index', 'store', 'edit', 'update']);

    ResourceRoute::create('expense-types', ExpenseTypeController::class);
    ResourceRoute::store('expense-types', ExpenseTypeController::class);

    Route::resource('expenses', ExpenseController::class)->only(['index', 'edit', 'update']);

    Route::controller(ExpenseController::class)->prefix('expenses/{year}')
        ->group(function () {
            Route::get('create', 'create')->name('expenses.create');
            Route::post('store', 'store')->name('expenses.store');
        });

    ResourceRoute::edit('payments', PaymentController::class);

    ResourceRoute::update('payments', PaymentController::class);

    Route::controller(PaymentController::class)->prefix('payments')
        ->group(function () {
            Route::get('registration/{reg}/expense/{expense}', 'create')->name('payments.create');
            Route::post('registration/{reg}/expense/{expense}', 'store')->name('payments.store');
            Route::get('{payment}/receipt', 'receipt')->name('payments.receipt');
        });

    Route::post('send-payment-email', SendPaymentEmailController::class)->name('send_email.payment');
});
