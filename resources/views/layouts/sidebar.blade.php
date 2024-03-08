<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php
                $userId = Auth::user()->id;
                $user = DB::table('users')->where('id', $userId)->select('menu', 'submenu')->first();
                $userMenus = explode(',', $user->menu);
                $userSubmenus = explode(',', $user->submenu);
                
                $menus = DB::table('table_menu')->whereIn('id', $userMenus)->get();
                $submenus = DB::table('table_submenu')->whereIn('id', $userSubmenus)->get();
                
                ?>

                <li class="menu-title" key="t-menu">Menu</li>

                @foreach ($menus as $menu)
                    <li>
                        @if ($menu->route_menu == null)
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="{{ $menu->icon_menu }}"></i>
                                <span key="t-ecommerce">{{ $menu->menu }}</span>
                            </a>
                        @else
                            <a href="{{ route($menu->route_menu) }}">
                                <i class="{{ $menu->icon_menu }}"></i>
                                <span key="t-ecommerce">{{ $menu->menu }}</span>
                            </a>
                        @endif
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach ($submenus->where('menu_id', $menu->id)->groupBy('submenu') as $submenuGroup => $groupedSubmenus)
                                <li>
                                    <a href="{{ $groupedSubmenus[0]->route_submenu ? route($groupedSubmenus[0]->route_submenu) : '' }}"
                                        key="t-products">
                                        {{ $submenuGroup }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
