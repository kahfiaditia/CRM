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
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-ecommerce">{{ $menu->menu }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach ($submenus as $submenu)
                                @if ($submenu->menu_id == $menu->id)
                                    <li>
                                        <a href="" key="t-products">{{ $submenu->submenu }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
