<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['message' => 'API is working']));

Route::prefix('auth')->as('auth')->group(base_path(
    path: 'routes/api/auth.php'
));