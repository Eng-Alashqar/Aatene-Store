<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ url('/') }}">
            <x-images.logo-light-lg />
            <x-images.logo-light />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2 ">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title  fs-6">لوحة القيادة</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div @class([
                        'menu-sub',
                        ' menu-sub-accordion ',
                        'here show menu-accordion' => Route::is('admin.home'),
                    ])>
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a @class(['menu-link', 'active' => Route::is('admin.home')]) href="{{ route('admin.home') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fs-5">الصفحة الرئيسية</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <x-elements.sidebar-li-sub-menu route="admin.stores.index"
                            title=" متابعة الإحصائيات والزيارت" />
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6"> المتاجر
                            والمستخدمين</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة المتاجر " index="admin.stores.index"
                    create="admin.stores.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-shop fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                            <i class="path4"></i>
                            <i class="path5"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.stores.index" title="قائمة المتاجر" />
                    <x-elements.sidebar-li-sub-menu route="admin.stores.create" title="إضافة متجر " />
                    <x-elements.sidebar-li-sub-menu route="admin.stores.pending" title="طلبات فتح متجر" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة المستخدمين " index="admin.users.index"
                    create="admin.users.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-people fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                            <i class="path4"></i>
                            <i class="path5"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.users.index" title="قائمة المستخدمين" />
                    <x-elements.sidebar-li-sub-menu route="admin.users.create" title="إضافة مستخدم " />

                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <x-elements.sidebar-menu-item lable="إدارة المحادثات " index="admin.users.index"
                     create="admin.users.create">
                     <x-slot name="icon">
                         <i class="ki-duotone ki-people fs-2">
                             <i class="path1"></i>
                             <i class="path2"></i>
                             <i class="path3"></i>
                             <i class="path4"></i>
                             <i class="path5"></i>
                         </i>
                     </x-slot>
                     <x-elements.sidebar-li-sub-menu route="admin.chat.index" title="قائمة المستخدمين" />

                 </x-elements.sidebar-menu-item>
                 <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6"> المناطق
                            والاقسام</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة المناطق " index="admin.regions.index"
                    create="admin.regions.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-map fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.regions.index" title="قائمة المناطق" />
                    <x-elements.sidebar-li-sub-menu route="admin.regions.create" title="إضافة منطقة" />

                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة الأقسام " index="admin.categories.index"
                    create="admin.categories.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-category fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                            <i class="path4"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.categories.index" title="قائمة الأقسام" />
                    <x-elements.sidebar-li-sub-menu route="admin.categories.create" title="إضافة قسم" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6"> نظام الوظائف والإعلانات</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة اعلانات الوظائف  " index="admin.stores.index"
                    create="admin.stores.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-call fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                            <i class="path4"></i>
                            <i class="path5"></i>
                            <i class="path6"></i>
                            <i class="path7"></i>
                            <i class="path8"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.stores.index" title="متابعة الوظائف " />
                    <x-elements.sidebar-li-sub-menu route="admin.stores.create" title="إضافة وظيفة " />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة اعلانات الموقع  " index="admin.stores.index"
                    create="admin.stores.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-chart-line-star fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.stores.index" title="متابعة الاعلانات " />
                    <x-elements.sidebar-li-sub-menu route="admin.stores.create" title="إضافة اعلان " />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6"> الموظفين
                            والأدوار</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة الموظفين " index="admin.admins.index"
                    create="admin.admins.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-security-user fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.admins.index" title="قائمة الموظفين" />
                    <x-elements.sidebar-li-sub-menu route="admin.admins.create" title="إضافة موظف" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="إدارة الأدوار " index="admin.roles.index"
                    create="admin.roles.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-key-square fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.roles.index" title="قائمة الأدوار" />
                    <x-elements.sidebar-li-sub-menu route="admin.roles.create" title="إضافة دور" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->


                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6">نظام الإشعارات</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="https://preview.keenthemes.com/metronic8/demo1/layout-builder.html">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-notification fs-2">
                                <i class="path1"></i>
                                <i class="path2"></i>
                                <i class="path3"></i>
                            </i>
                        </span>
                        <span class="menu-title fs-6">إدارة الإشعارات</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="https://preview.keenthemes.com/metronic8/demo1/layout-builder.html">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-send fs-2">
                                <i class="path1"></i>
                                <i class="path2"></i>
                            </i>
                        </span>
                        <span class="menu-title fs-6">إرسال الإشعارات</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-6"> الدعم والإعدادت</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable=" الدعم الفني " index="admin.categories.index"
                    create="admin.categories.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-support-24 fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="admin.categories.index" title="قائمة طلبات الدعم" />
                    <x-elements.sidebar-li-sub-menu route="admin.categories.create"
                        title="قائمة الابلاغات والتقارير" />
                    <x-elements.sidebar-li-sub-menu route="admin.faqs.index" title=" اسئلة شائعة" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="https://preview.keenthemes.com/metronic8/demo1/layout-builder.html">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-setting-2 fs-2">
                                <i class="path1"></i>
                                <i class="path2"></i>
                            </i>
                        </span>
                        <span class="menu-title fs-6">الإعدادت</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="https://preview.keenthemes.com/html/metronic/docs"
            class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
            title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label ">الدعم الفني</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
