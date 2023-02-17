<?php

declare(strict_types=1);

use App\Orchid\Screens\DashboardScreen;
use App\Orchid\Screens\ChatScreen;
use App\Orchid\Screens\BrainstormingScreen;

use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

/*
- Dashboard: Mostrar gráficos de barras, pie, etc.
- Página 1: Debe tener 2 inputs de texto, y que al hacer click en un botón haga una petición a la aplicación FastAPI, procesar la respuesta y mostrar el resultado.
- Página 2: Debe tener una interfaz para grabación de audio y que al terminar de grabar haga una petición a la aplicación FastAPI, procesar la respuesta y mostrar el resultado.
- Página 3: Debe tener una interfaz de chat, donde hay un input de texto y al dar a enter debe hacer una petición y con la respuesta mostrarla como mensaje. Similar a Whatsapp Web por ejemplo.
- Página 4: Debe tener un input de texto y un botón que al clickearlo debe hacer una petición a FastAPI y con la respuesta generar un archivo markdown para descarga.
*/

// Main
Route::screen('/dashboard', DashboardScreen::class)
  ->name('platform.main');

Route::screen('/chat', ChatScreen::class)
  ->name('page.chat');

Route::screen('/brainstorming', BrainstormingScreen::class)
  ->name('page.brainstorming');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));