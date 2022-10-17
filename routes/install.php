<?php

use App\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {

    return redirect()->route('install');
});


 Route::get('/', [InstallerController::class, 'welcome'])->name('home');
 Route::get('permission', [InstallerController::class, 'permission'])->name('permission');
 Route::get('setup/db', [InstallerController::class, 'create'])->name('create');
 Route::post('setup/database', [InstallerController::class, 'dbStore'])->name('db.setup');
 Route::get('check/database', [InstallerController::class, 'checkDbConnection'])->name('check.db');
 Route::get('setup/import/sql', [InstallerController::class, 'importSql'])->name('sql.setup');
 Route::get('setup/create', [InstallerController::class, 'sqlUpload'])->name('org.create');
 Route::post('setup/store', [InstallerController::class, 'orgSetup'])->name('org.setup');
 Route::get('setup/admin', [InstallerController::class, 'adminCreate'])->name('admin.create');
 Route::post('setup/admin/store', [InstallerController::class, 'adminStore'])->name('admin.store');
