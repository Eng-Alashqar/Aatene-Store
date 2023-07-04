   <!--begin:Menu item-->
   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
       <!--begin:Menu link-->
       <span class="menu-link">
           <span class="menu-icon">
               {{ $icon }}
           </span>
           <span class="menu-title fs-6">{{ $lable }}</span>
           <span class="menu-arrow"></span>
       </span>
       <!--end:Menu link-->
       <!--begin:Menu sub-->
       <div @class([
           'menu-sub',
           ' menu-sub-accordion',
           ' here show menu-accordion' => Route::is($index) || Route::is($create),
       ])>
           {{ $slot }}
       </div>
       <!--end:Menu sub-->
   </div>
   <!--end:Menu item-->
