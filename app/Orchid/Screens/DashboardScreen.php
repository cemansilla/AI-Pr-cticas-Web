<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DashboardScreen extends Screen
{
  /**
   * Fetch data to be displayed on the screen.
   *
   * @return array
   */
  public function query(): iterable
  {
    return [];
  }

  /**
   * The name of the screen displayed in the header.
   *
   * @return string|null
   */
  public function name(): ?string
  {
    return 'Dashboard';
  }

  /**
   * Display header description.
   *
   * @return string|null
   */
  public function description(): ?string
  {
    return 'Lorem ipsum dolor sit amet.';
  }

  /**
   * The screen's action buttons.
   *
   * @return \Orchid\Screen\Action[]
   */
  public function commandBar(): iterable
  {
    return [
      Link::make('Documentación')
        ->href('#')
        ->icon('docs'),

      Link::make('Notificaciones')
        ->href('notifications')
        ->icon('bell'),
    ];
  }

  /**
   * The screen's layout elements.
   *
   * @return \Orchid\Screen\Layout[]
   */
  public function layout(): iterable
  {
    return [
      Layout::view('dashboard.custom'),
      Layout::columns([
        Layout::view('platform::dummy.block'),
        Layout::view('platform::dummy.block'),
        Layout::view('platform::dummy.block'),
      ]),
    ];
  }
}
