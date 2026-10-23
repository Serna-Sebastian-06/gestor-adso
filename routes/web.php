<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AprendizController;
Route::redirect('/', '/aprendices');
Route::resource('aprendices', AprendizController::class);
// TEMP: Rutas de práctica (comentar antes de producción)
// Route::get('/ping', fn() => 'pong');
// Route::get('/hola/{nombre}', fn($nombre) => "Hola, $nombre");
// Route::get('/suma/{a}/{b}', fn($a,$b) => (int)$a + (int)$b);