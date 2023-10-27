<?php

use App\Http\Controllers\SearchController;
use App\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Livewire\Admin\AdminAddServiceComponent;
use App\Livewire\Admin\AdminAddSliderComponent;
use App\Livewire\Admin\AdminContactComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminEditServiceCategoryComponent;
use App\Livewire\Admin\AdminEditServiceComponent;
use App\Livewire\Admin\AdminEditSliderComponent;
use App\Livewire\Admin\AdminServiceByCategoryComponent;
use App\Livewire\Admin\AdminServiceCategoryComponent;
use App\Livewire\Admin\AdminServiceProvidersComponent;
use App\Livewire\Admin\AdminServicesComponent;
use App\Livewire\Admin\AdminSliderComponent;
use App\Livewire\ChangeLocationComponent;
use App\Livewire\ContactComponent;
use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ServiceCategoriesComponent;
use App\Livewire\ServiceDetailsComponent;
use App\Livewire\ServicesByCategoryComponent;
use App\Livewire\Sprovider\SproviderDashboardComponent;
use App\Livewire\Sprovider\SproviderEditProfileComponent;
use App\Livewire\Sprovider\SproviderProfileComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", HomeComponent::class)->name("home");
Route::get("/service-categories", ServiceCategoriesComponent::class)->name('home.service_categories');
Route::get('/{category_slug}/services', ServicesByCategoryComponent::class)->name('home.service_by_category');
Route::get('/service/{service_slug}', ServiceDetailsComponent::class)->name('home.service_details');

Route::get('/autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');
Route::post('/search', [SearchController::class, 'searchService'])->name('search_service');

Route::get('/change-location', ChangeLocationComponent::class)->name('home.change_location');

Route::get('/contact-us', ContactComponent::class)->name('home.contact');

// For Customer
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/customer/dashboard', CustomerDashboardComponent::class )->name('customer.dashboard');
});

// For Service Provider
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified', 'authsprovider'])->group(function () {
    Route::get('/service-provider/dashboard', SproviderDashboardComponent::class )->name('sprovider.dashboard');
    Route::get('/service-provider/profile', SproviderProfileComponent::class)->name('sprovider.profile');
    Route::get('/service-provider/profile/edit', SproviderEditProfileComponent::class)->name('sprovider.edit_profile');
});

// For Admin
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class )->name('admin.dashboard');
    Route::get('/admin/service-categories', AdminServiceCategoryComponent::class)->name('admin.service_categories');
    Route::get('/admin/service-categories/add', AdminAddServiceCategoryComponent::class)->name('admin.add_service_categories');
    Route::get('/admin/service-categories/edit/{category_id}', AdminEditServiceCategoryComponent::class)->name('admin.edit_service_categories');
    Route::get('/admin/all-services', AdminServicesComponent::class)->name('admin.all_services');
    Route::get('/admin/{category_slug}/services', AdminServiceByCategoryComponent::class)->name('admin.services_by_category');
    Route::get('/admin/service/add', AdminAddServiceComponent::class)->name('admin.add_service');
    Route::get('admin/service/edit/{service_slug}', AdminEditServiceComponent::class)->name('admin.edit_service');

    Route::get('/admin/slider', AdminSliderComponent::class)->name('admin.slider');
    Route::get('admin/slider/add', AdminAddSliderComponent::class)->name('admin.add_slide');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditSliderComponent::class)->name('admin.edit_slide') ;

    Route::get('/admin/contacts', AdminContactComponent::class)->name('admin.contacts');

    Route::get('/admin/service-providers', AdminServiceProvidersComponent::class)->name('admin.service_providers');
});
