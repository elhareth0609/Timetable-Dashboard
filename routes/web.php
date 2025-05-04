<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DataTabelController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;













Route::get('/', [HomeController::class, 'home'])->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('auth/forgot-password', [AuthController::class, 'forgot_password'])->name('auth.forgot-password');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login.action');
    Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register.action');
    Route::post('auth/forgot-password', [AuthController::class, 'forgot_password'])->name('auth.forgot-password.action');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Route::get('users', [DataTabelController::class, 'users'])->name('users');
    // Route::get('records', [DataTabelController::class, 'records'])->name('records');
    // Route::get('course', [DataTabelController::class, 'course'])->name('course');
    Route::get('teachers', [DataTabelController::class, 'teachers'])->name('teachers');
    // Route::get('sections', [DataTabelController::class, 'sections'])->name('sections');
    // Route::get('rooms', [DataTabelController::class, 'rooms'])->name('rooms');
    Route::get('specialties', [DataTabelController::class, 'specialties'])->name('specialties');
    Route::get('faculties', [DataTabelController::class, 'faculties'])->name('faculties');
    Route::get('structures', [DataTabelController::class, 'structures'])->name('structures');
    Route::get('levels', [DataTabelController::class, 'levels'])->name('levels');
    Route::get('faculties/departments/{id}', [DataTabelController::class, 'faculties_departments'])->name('faculties.departments');
    Route::get('departments/teachers/{id}', [DataTabelController::class, 'departments_teachers'])->name('departments.teachers');
    Route::get('departments/levels/{id}', [DataTabelController::class, 'departments_levels'])->name('departments.levels');
    Route::get('level/{id}/specialties', [DataTabelController::class, 'level_specialties'])->name('level.specialties');
    Route::get('specialty/{id}/groups', [DataTabelController::class, 'specialty_groups'])->name('specialty.groups');
    Route::get('specialty/{id}/courses', [DataTabelController::class, 'specialty_courses'])->name('specialty.courses');
    Route::get('languages', [DataTabelController::class, 'languages'])->name('languages');
    Route::get('specialty/{id}/table', [TableController::class, 'index'])->name('specialty.table');
    
    
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('auth/destroy', [AuthController::class, 'destroy'])->name('auth.destroy');
    
    // Course
    // Dashboard
    Route::get('/course/all', [CourseController::class, 'all'])->name('course.all');
    Route::get('/course/{id}', [CourseController::class, 'get'])->name('course.get');
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::delete('/course/{id}', [CourseController::class, 'delete'])->name('course.delete');
    Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update');

    // Specialties
    // Dashboard

    Route::get('/specialty/{id}/events', [TableController::class, 'events'])->name('specialty.events.all');
    Route::delete('/table/events/{event_id}', [TableController::class, 'delete'])->name('table.events.delete');
    Route::put('/table/events', [TableController::class, 'update'])->name('table.events.update');
    Route::post('/table/events', [TableController::class, 'create'])->name('table.events.save');

    Route::get('/specialty/all', [SpecialtyController::class, 'all'])->name('specialty.all');
    Route::get('/specialty/{id}', [SpecialtyController::class, 'get'])->name('specialty.get');
    Route::post('/specialty/create', [SpecialtyController::class, 'create'])->name('specialty.create');
    Route::delete('/specialty/{id}', [SpecialtyController::class, 'delete'])->name('specialty.delete');
    Route::put('/specialty/{id}', [SpecialtyController::class, 'update'])->name('specialty.update');

    // specialty/2/events
    // Groups
    // Dashboard
    Route::get('/group/all', [GroupController::class, 'all'])->name('group.all');
    Route::get('/group/{id}', [GroupController::class, 'get'])->name('group.get');
    Route::post('/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::delete('/group/{id}', [GroupController::class, 'delete'])->name('group.delete');
    Route::put('/group/{id}', [GroupController::class, 'update'])->name('group.update');

    // faculties
    // Dashboard
    Route::get('/faculty/all', [FacultyController::class, 'all'])->name('faculty.all');
    Route::get('/faculty/{id}', [FacultyController::class, 'get'])->name('faculty.get');
    Route::post('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::delete('/faculty/{id}', [FacultyController::class, 'delete'])->name('faculty.delete');
    Route::put('/faculty/{id}', [FacultyController::class, 'update'])->name('faculty.update');

    // departments
    // Dashboard
    Route::get('/department/all', [DepartmentController::class, 'all'])->name('department.all');
    Route::get('/department/{id}', [DepartmentController::class, 'get'])->name('department.get');
    Route::post('/department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::delete('/department/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
    Route::put('/department/{id}', [DepartmentController::class, 'update'])->name('department.update');

    // levels
    // Dashboard
    Route::get('/level/all', [LevelController::class, 'all'])->name('level.all');
    Route::get('/level/{id}', [LevelController::class, 'get'])->name('level.get');
    Route::post('/level/create', [LevelController::class, 'create'])->name('level.create');
    Route::delete('/level/{id}', [LevelController::class, 'delete'])->name('level.delete');
    Route::put('/level/{id}', [LevelController::class, 'update'])->name('level.update');
    
    // Stractures
    // Dashboard
    Route::get('/structure/all', [StructureController::class, 'all'])->name('structure.all');
    Route::get('/structure/{id}', [StructureController::class, 'get'])->name('structure.get');
    Route::post('/structure/create', [StructureController::class, 'create'])->name('structure.create');
    Route::delete('/structure/{id}', [StructureController::class, 'delete'])->name('structure.delete');
    Route::put('/structure/{id}', [StructureController::class, 'update'])->name('structure.update');

    // Sections
    // Dashboard
    // Route::get('/section/{id}', [SectionController::class, 'get'])->name('section.get');
    // Route::post('/section/create', [SectionController::class, 'create'])->name('section.create');
    // Route::delete('/section/{id}', [SectionController::class, 'delete'])->name('section.delete');
    // Route::put('/section/{id}', [SectionController::class, 'update'])->name('section.update');

    // Users
    // Dashboard
    Route::get('/user/all', [UserController::class, 'all'])->name('user.all');
    Route::get('/user/{id}', [UserController::class, 'get'])->name('user.get');
    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    
    // Table
    // Dashboard
    // Route::get('time-table', [TableController::class, 'index'])->name('time-table');
    // Route::get('/user/all', [TableController::class, 'all'])->name('table.all');
    // Route::get('/table/{id}', [TableController::class, 'get'])->name('table.get');
    // Route::post('/table/create', [TableController::class, 'create'])->name('table.create');
    // Route::delete('/table/{id}', [TableController::class, 'delete'])->name('table.delete');
    // Route::put('/table/{id}', [TableController::class, 'update'])->name('table.update');
    
    // Records
    // Dashboard
    Route::get('/teacher/all', [TeacherController::class, 'all'])->name('teacher.all');
    Route::get('/teacher/{id}', [TeacherController::class, 'get'])->name('teacher.get');
    Route::post('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::delete('/teacher/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');
    Route::put('/teacher/{id}', [TeacherController::class, 'update'])->name('teacher.update');

    Route::post('/language', [LanguageController::class, 'create'])->name('language.create');
    Route::get('/language/{word}', [LanguageController::class, 'get'])->name('language.get');
    Route::put('/language/{word}', [LanguageController::class, 'update'])->name('language.update');
    Route::delete('/language/{word}', [LanguageController::class, 'destroy'])->name('language.destroy');


    Route::get('settings/account', [SettingController::class, 'get_account'])->name('settings.account.get');
    Route::get('settings/password', [SettingController::class, 'get_password'])->name('settings.password.get');

    Route::post('settings/account/update', [SettingController::class, 'update_account'])->name('settings.account.update');
    Route::post('settings/password/update', [SettingController::class, 'update_password'])->name('settings.password.update');

    Route::post('settings/account/upload/image', [SettingController::class, 'upload_image'])->name('settings.account.uploadImage');


    Route::get('/change-language/{locale}', [LanguageController::class, 'change'])->name('change.language');

});

Route::get('/ddd', function () {
    // Clear cache
    Artisan::call('cache:clear');
    // Clear configuration cache
    Artisan::call('config:cache');
    // Clear configuration
    Artisan::call('config:clear');
    // Clear routes
    Artisan::call('route:clear');
    // Cache routes
    Artisan::call('route:cache');
    // Cache views
    Artisan::call('view:cache');
    // Clear views
    Artisan::call('view:clear');
    // back to past page
    return 'ok';
});
