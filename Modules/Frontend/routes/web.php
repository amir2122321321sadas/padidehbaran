<?php

use App\Models\CourseChapterFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Modules\Frontend\Http\Controllers\FrontendController;
use Modules\Frontend\Livewire\Auth\LoginRegister;
use Modules\Frontend\Livewire\BackAuthExam\Pages\Exam\ExamFormForStart;
use Modules\Frontend\Livewire\BackAuthExam\Pages\Exam\ExamLists;
use Modules\Frontend\Livewire\BackAuthExam\Pages\Exam\ExamQuestionForms;
use Modules\Frontend\Livewire\BackAuthExam\Pages\Exam\ExamQuestuinForms;
use Modules\Frontend\Livewire\Client\Pages\ContactUs\ContactUsPage;
use Modules\Frontend\Livewire\Client\Pages\Course\CoursesDetail;
use Modules\Frontend\Livewire\Client\Pages\Course\CoursesDetailFile;
use Modules\Frontend\Livewire\Client\Pages\CourseCategory\CategorySingleWithCoursesPage;
use Modules\Frontend\Livewire\Client\Pages\Faq\FaqPage;
use Modules\Frontend\Livewire\Client\Pages\Profile\CourseLikedListPage;
use Modules\Frontend\Livewire\Client\Pages\Profile\CoursesProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\CreateInsurancePoliciesProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\CreateTicketProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\EditProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\InsurancePoliciesProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\MainProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\NotificationProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\ProfileBase;
use Modules\Frontend\Livewire\Client\Pages\Profile\ShowInsurancePoliciesProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\ShowTicketProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Profile\TicketListProfilePage;
use Modules\Frontend\Livewire\Client\Pages\Term\TermPage;
use Modules\Frontend\Livewire\Client\Welcome;


Route::middleware(['authCheck' , 'changerLevel' , 'checkerInsurancePolicyAndExcel' ,'check.insurance' , 'checkRepairMode'])->group(function () {
    Route::get('/', Welcome::class)->name('home');
    Route::get('/contactUs', ContactUsPage::class)->name('contactUs');
    Route::get('/faq', FaqPage::class)->name('faq');
    Route::get('/profile' , MainProfilePage::class)->name('profile');
    Route::get('/edit-profile', EditProfilePage::class)->name('edit-profile');
    Route::get('/notification-profile', NotificationProfilePage::class)->name('notification-profile');
    Route::get('/insurance-policies' , InsurancePoliciesProfilePage::class)->name('insurance-policy');
    Route::get('/create-insurance-policy' , CreateInsurancePoliciesProfilePage::class)->name('create-insurance-policy');
    Route::get('/show-insurance-policy/{insurance_policies_number}' , ShowInsurancePoliciesProfilePage::class)->name('show-insurance-policy');
    Route::get('/user-courses' , CoursesProfilePage::class)->name('user-courses');
    Route::get('/favorite-courses' , CourseLikedListPage::class)->name('favorite-courses');
    Route::get('/course-detail/{course:slug}' , CoursesDetail::class)->name('course-detail')->middleware(['canWatchCourse']);
    Route::get('/course/{course:slug}/file/{courseChapterFile:slug}' , CoursesDetailFile::class )->name('course-detail-file')->middleware(['canWatchCourse']);
    Route::get('/course-category/{courseCategory:slug}' , CategorySingleWithCoursesPage::class)->name('course-category');
    Route::get('/ticket-list' , TicketListProfilePage::class)->name('ticket-list');
    Route::get('/create-ticket' , CreateTicketProfilePage::class)->name('create-ticket');
    Route::get('/show-ticket/{ticket:uuid}' , ShowTicketProfilePage::class)->name('show-ticket');
});


Route::get('/terms' , TermPage::class)->name('terms');


Route::get('admin/login', function (){
  return redirect(route('auth'));
})->name('login');

Route::get('/auth' , LoginRegister::class)->name('auth')->middleware('guest');

Route::get('/exam/list' , ExamLists::class)->name('exam.list')->middleware(['guest']);;

Route::get('/exam/{exam:slug}' , ExamFormForStart::class)->name('exam.start')->middleware(['guest']);

Route::get('/user-exam/{userExam:token}/exam/{exam:slug}' ,ExamQuestionForms::class)->name('exam-questions')->middleware(['guest']);


// routes/web.php
Route::get('/clear-cache', function() {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');

    return 'Cache cleared successfully!';
});



