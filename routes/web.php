<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\MovingController;
use App\Http\Controllers\MovingDetailController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlantGroupController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitmodelController;
use App\Http\Controllers\UnitnoHistoryController;
use App\Http\Controllers\UnitstatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // USERS
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('data', [UserController::class, 'data'])->name('data');
        Route::put('activate/{id}', [UserController::class, 'activate'])->name('activate');
        Route::put('deactivate/{id}', [UserController::class, 'deactivate'])->name('deactivate');
        Route::put('roles-update/{id}', [UserController::class, 'roles_user_update'])->name('roles_user_update');
    });

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    // PERMISSIONS
    Route::get('permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
    Route::resource('permissions', PermissionController::class);

    // DASHBOARD
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/test', [DashboardController::class, 'test'])->name('test');
    });

    // EQUIPMENTS
    Route::get('equipments/data', [EquipmentController::class, 'index_data'])->name('equipments.index.data');
    Route::get('equipments/{equipment}/movings/data', [EquipmentController::class, 'equipment_movings_data'])->name('equipments.movings.data');
    Route::get('equipments/{equipment}/changes/data', [EquipmentController::class, 'equipment_changes_data'])->name('equipments.changes.data');
    Route::get('equipments/{equipment}/legals/data', [EquipmentController::class, 'equipment_legals_data'])->name('equipments.legals.data');
    Route::get('equipments/{equipment}/acquisitions/data', [EquipmentController::class, 'equipment_acquisitions_data'])->name('equipments.acquisitions.data');
    Route::get('equipments/{equipment}/insurance/data', [EquipmentController::class, 'equipment_insurance_data'])->name('equipments.insurance.data');
    Route::get('equipments/{equipment}/others/data', [EquipmentController::class, 'equipment_others_data'])->name('equipments.others.data');
    Route::get('equipments/{equipment}/edit_detail', [EquipmentController::class, 'edit_detail'])->name('equipments.edit_detail');
    Route::put('equipments/{equipment}/update_detail', [EquipmentController::class, 'update_detail'])->name('equipments.update_detail');
    Route::get('/equipments/export_excel', [EquipmentController::class, 'equipment_export_excel'])->name('equipments.export_excel');
    Route::resource('equipments', EquipmentController::class);

    // MOVINGS
    Route::get('movings/data', [MovingController::class, 'index_data'])->name('movings.index.data');
    Route::get('movings/{moving}/print_pdf', [MovingController::class, 'print_pdf'])->name('movings.print_pdf');
    Route::get('movings/{moving}/print2_pdf', [MovingController::class, 'print2_pdf'])->name('movings.print2_pdf');
    Route::get('movings/{moving}/before_select', [MovingController::class, 'edit_before_select_equipment'])->name('movings.before_select_equipment');
    Route::put('movings/{moving}/before_select', [MovingController::class, 'update_before_select_equipment'])->name('movings.update_before_select_equipment');
    Route::resource('movings', MovingController::class);

    Route::get('moving_details/incart/data', [MovingDetailController::class, 'unit_incart_data'])->name('moving_details.unit_incart.data');
    Route::get('moving_details/{from_project_id}/data', [MovingDetailController::class, 'available_unit_data'])->name('moving_details.available_unit.data');

    Route::get('moving_details/{moving_id}/create', [MovingDetailController::class, 'create'])->name('moving_details.create');
    Route::post('moving_details', [MovingDetailController::class, 'store'])->name('moving_details.store');
    Route::patch('moving_details/{equipment_id}/add_tocart', [MovingDetailController::class, 'add_tocart'])->name('moving_details.add_tocart');
    Route::patch('moving_details/{equipment_id}/remove_fromcart', [MovingDetailController::class, 'remove_fromcart'])->name('moving_details.remove_fromcart');

    // UNIT NUMBER HISTORIES
    Route::get('unitnohistories/data', [UnitnoHistoryController::class, 'index_data'])->name('unitno_histories.index.data');
    Route::resource('unitnohistories', UnitnoHistoryController::class);

    // DOCUMENTS
    Route::get('documents/data', [DocumentController::class, 'index_data'])->name('documents.index.data');
    Route::get('documents/{id}/extends', [DocumentController::class, 'extends_edit'])->name('documents.extends_edit');
    Route::put('documents/{id}/extends', [DocumentController::class, 'extends_update'])->name('documents.extends_update');
    Route::resource('documents', DocumentController::class);

    // ASSET CATEGORIES
    Route::get('asset_categories/data', [AssetCategoryController::class, 'index_data'])->name('asset_categories.index.data');
    Route::resource('asset_categories', AssetCategoryController::class);

    // DOCUMENT TYPES
    Route::get('doctypes/data', [DocumentTypeController::class, 'index_data'])->name('doctypes.index.data');
    Route::resource('doctypes', DocumentTypeController::class);

    // MANUFACTURES
    Route::get('manufactures/data', [ManufactureController::class, 'data'])->name('manufactures.data');
    Route::resource('manufactures', ManufactureController::class);

    // PROJECTS
    Route::get('projects/data', [ProjectController::class, 'data'])->name('projects.data');
    Route::resource('projects', ProjectController::class);

    // PLANT TYPES
    Route::get('planttypes/data', [PlantTypeController::class, 'data'])->name('planttypes.data');
    Route::resource('planttypes', PlantTypeController::class);

    // PLANT GROUPS
    Route::get('plant_groups/data', [PlantGroupController::class, 'data'])->name('plant_groups.data');
    Route::resource('plant_groups', PlantGroupController::class);

    // SUPPLIERS
    Route::get('suppliers/data', [SupplierController::class, 'data'])->name('suppliers.data');
    Route::resource('suppliers', SupplierController::class);

    // UNIT MODELS
    Route::get('unitmodels/data', [UnitmodelController::class, 'data'])->name('unitmodels.data');
    Route::resource('unitmodels', UnitmodelController::class);

    // UNIT STATUS
    Route::get('unitstatuses/data', [UnitstatusController::class, 'data'])->name('unitstatuses.data');
    Route::resource('unitstatuses', UnitstatusController::class);

    //REPORTS
    Route::get('reports/with_overdue/data', [ReportController::class, 'document_with_overdue_data'])->name('reports.document_with_overdue_data');
    Route::get('reports/with_overdue/data', [ReportController::class, 'document_with_overdue_data'])->name('reports.document_with_overdue_data');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/with_overdue', [ReportController::class, 'document_with_overdue'])->name('reports.document_with_overdue');
    Route::get('reports/report1', [ReportController::class, 'report1_create'])->name('reports.report1_create');
    Route::post('reports/report1', [ReportController::class, 'report1_display'])->name('reports.report1_display');
    Route::get('reports/report1/data', [ReportController::class, 'report1_data'])->name('reports.report1_data');
});

Route::get('/model_detail', [UnitmodelController::class, 'get_model_detail'])->name('get_model_detail');
Route::get('/get_plant_groups', [PlantGroupController::class, 'get_plant_group_by_plant_type_id'])->name('get_plant_groups');
