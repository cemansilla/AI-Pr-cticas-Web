<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
  /**
   * @param Dashboard $dashboard
   */
  public function boot(Dashboard $dashboard): void
  {
    parent::boot($dashboard);

    // ...
  }

  /**
   * @return Menu[]
   */
  public function registerMainMenu(): array
  {
    return [
      Menu::make(__('Chat'))
        ->icon('bubble')
        ->route('page.chat')
        ->title('Laboratorio'),

      Menu::make(__('Brainstorming'))
        ->icon('chemistry')
        ->route('page.brainstorming'),

      Menu::make(__('Obsidian'))
        ->icon('diamond')
        ->route('page.obsidian'),

      Menu::make(__('Audio'))
        ->icon('earphones-alt')
        ->route('page.voice'),

      Menu::make(__('Imagen'))
        ->icon('picture')
        ->route('page.image'),

      Menu::make(__('Users'))
        ->icon('user')
        ->route('platform.systems.users')
        ->permission('platform.systems.users')
        ->title(__('Access rights')),

      Menu::make(__('Roles'))
        ->icon('lock')
        ->route('platform.systems.roles')
        ->permission('platform.systems.roles'),
    ];
  }

  /**
   * @return Menu[]
   */
  public function registerProfileMenu(): array
  {
    return [
      Menu::make(__('Profile'))
        ->route('platform.profile')
        ->icon('user'),
    ];
  }

  /**
   * @return ItemPermission[]
   */
  public function registerPermissions(): array
  {
    return [
      ItemPermission::group(__('System'))
        ->addPermission('platform.systems.roles', __('Roles'))
        ->addPermission('platform.systems.users', __('Users')),
    ];
  }
}
