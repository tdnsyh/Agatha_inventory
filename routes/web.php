<?php

use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\PriorityAnalysis;
use Illuminate\Support\Facades\Route;
use App\Livewire\ManageSales\SalesShow;
use App\Livewire\ManageAccess\UserIndex;
use App\Livewire\ManageSales\SalesIndex;
use App\Livewire\ManageAccess\UserCreate;
use App\Livewire\ManageAccess\UserUpdate;
use App\Livewire\ManageInventory\InventoryIn\InventoryCreate as InventoryInInventoryCreate;
use App\Livewire\ManageSales\SalesCreate;
use App\Livewire\ManageSales\SalesReport;
use App\Livewire\ManageSales\SalesUpdate;
use App\Livewire\ManageProduct\ProductShow;
use App\Livewire\ManageProduct\ProductIndex;
use App\Livewire\ManageProduct\ProductCreate;
use App\Livewire\ManageProduct\ProductUpdate;
use App\Livewire\ManageProduction\ProductionShow;
use App\Livewire\ManageProduction\ProductionIndex;
use App\Livewire\ManageProduction\ProductionCreate;
use App\Livewire\ManageProduction\ProductionReport;
use App\Livewire\ManageProduction\ProductionUpdate;
use App\Livewire\ManageProduction\ProductionRequest;
use App\Livewire\ManageProduct\ProductBarcodeScanner;
use App\Livewire\ManageInventory\InventoryIn\InventoryShow as InventoryInInventoryShow;
use App\Livewire\ManageInventory\InventoryIn\InventoryIndex as InventoryInInventoryIndex;
use App\Livewire\ManageInventory\InventoryIn\InventoryUpdate as InventoryInInventoryUpdate;
use App\Livewire\ManageInventory\InventoryOut\InventoryCreate as InventoryOutInventoryCreate;
use App\Livewire\ManageInventory\InventoryOut\InventoryIndex as InventoryOutInventoryIndex;
use App\Livewire\ManageInventory\InventoryOut\InventoryShow as InventoryOutInventoryShow;
use App\Livewire\ManageInventory\InventoryOut\InventoryUpdate as InventoryOutInventoryUpdate;
use App\Livewire\ManageInventory\InventoryReport;
use App\Livewire\ManageInventory\InventoryRequest\InventoryRequest;
use App\Livewire\ManageInventory\InventoryRequest\InventoryRequestCreate;
use App\Livewire\ManageInventory\InventoryRequest\InventoryRequestShow;
use App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdate;
use App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdateStatus;
use App\Livewire\ManageProduction\ProductionRequestCreate;
use Illuminate\Support\Facades\Auth;

// Login
Route::get('/', Login::class)->name('auth.login');
Route::get('/register', Register::class)->name('register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('/');
})->name('logout');

// Dashboard
Route::middleware('auth')->get('/dashboard', Dashboard::class)->name('dashboard');

// Priority Analysis
Route::get('/priority-analysis', PriorityAnalysis::class)->name('priority-analysis');

// Manage Product 
Route::get('/product/create', ProductCreate::class)->name('product.create');
Route::get('/product/update', ProductUpdate::class)->name('product.update');
Route::get('/product/index', ProductIndex::class)->name('product.index');
Route::get('/product/{id}', ProductShow::class)->name('product.show');
Route::get('/product/{id}/update', ProductUpdate::class)->name('product.update');
Route::delete('/products/{product}', [ProductCreate::class, 'destroy'])->name('products.destroy');
Route::get('/product/barcode_scanner', ProductBarcodeScanner::class)->name('barcode-scanner');

// Manage Production
Route::get('/production/index', ProductionIndex::class)->name('production.index');
Route::get('/production/show/{id}', ProductionShow::class)->name('production.show');
Route::get('/production/create', ProductionCreate::class)->name('production.create');
Route::get('/production/{id}/update', ProductionUpdate::class)->name('production.update');
Route::get('/production/request', ProductionRequest::class)->name('production.request');
Route::get('/production/request/{productionRequestId}/create', ProductionRequestCreate::class)->name('production.request.create');
Route::get('/production/report', ProductionReport::class)->name('production.report');

// Manage Sales
Route::get('/sales/index', SalesIndex::class)->name('sales.index');
Route::get('/sales/show', SalesShow::class)->name('sales.show');
Route::get('/sales/create', SalesCreate::class)->name('sales.create');
Route::get('/sales/update', SalesUpdate::class)->name('sales.update');
Route::get('/sales/report', SalesReport::class)->name('sales.report');

// Manage Inventory
Route::get('/inventory/in/index', InventoryInInventoryIndex::class)->name('inventory.in.index');
// Route::get('/inventory/in/show', InventoryInInventoryShow::class)->name('inventory.in.show');
// Route::get('/inventory/in/create', InventoryInInventoryCreate::class)->name('inventory.in.create');
// Route::get('/inventory/in/update', InventoryInInventoryUpdate::class)->name('inventory.in.update');

Route::get('/inventory/out/index', InventoryOutInventoryIndex::class)->name('inventory.out.index');
// Route::get('/inventory/out/show', InventoryOutInventoryShow::class)->name('inventory.out.show');
Route::get('/inventory/out/create', InventoryOutInventoryCreate::class)->name('inventory.out.create');
// Route::get('/inventory/out/update', InventoryOutInventoryUpdate::class)->name('inventory.out.update');

Route::get('/inventory/request', InventoryRequest::class)->name('inventory.request.index');
Route::get('/inventory/request/create', InventoryRequestCreate::class)->name('inventory.request.create');
Route::get('/inventory/request/{id}', InventoryRequestShow::class)->name('inventory.request.show');
Route::get('/inventory/request/{id}/edit', InventoryRequestUpdate::class)->name('inventory.request.update');
Route::get('/inventory/request/{id}/update-status', InventoryRequestUpdateStatus::class)->name('inventory.request.update-status');
Route::get('/inventory/{id}/update-status', InventoryRequestUpdateStatus::class)->name('inventory.request.update-status');

Route::get('/inventory/report', InventoryReport::class)->name('inventory.report');

// Manage Access
Route::get('/user/index', UserIndex::class)->name('manage-access.user.index');
Route::get('/user/create', UserCreate::class)->name('manage-access.user.create');
Route::get('/user/update', UserUpdate::class)->name('manage-access.user.update');
