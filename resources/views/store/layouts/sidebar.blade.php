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
        <!--begin::Minimized sidebar setup:-->
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
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
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
                        <span class="menu-title fs-2">لوحة القيادة</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    {{-- <div class="menu-sub menu-sub-accordion"> --}}
                    <div @class([
                        'menu-sub',
                        ' menu-sub-accordion ',
                        'here show menu-accordion' => Route::is('dashboard.home'),
                    ])>
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a @class(['menu-link', 'active' => Route::is('dashboard.home')]) href="{{ route('dashboard.home') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title fs-5">الصفحة الرئيسية</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-3">المنتجات والخدمات </span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="المنتجات" customClass="menu-title fs-4"
                    index="dashboard.products.index" create="dashboard.products.create">
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
                    <x-elements.sidebar-li-sub-menu route="dashboard.products.index" title="عرض المنتجات" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.products.create" title="إضافة منتج جديد" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="المبيعات" customClass="menu-title fs-4"
                    index="dashboard.orders.index" create="">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-chart-line-star fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="dashboard.orders.index" title="الطلبات" />
                    {{-- <x-elements.sidebar-li-sub-menu route="dashboard.orders.create" title="إضافة خدمة جديدة" /> --}}
                </x-elements.sidebar-menu-item>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="الخدمات" customClass="menu-title fs-4"
                    index="dashboard.services.index" create="dashboard.services.create">
                    <x-slot name="icon">
                        <i class="ki-duotone ki-chart-line-star fs-2">
                            <i class="path1"></i>
                            <i class="path2"></i>
                            <i class="path3"></i>
                        </i>
                    </x-slot>
                    <x-elements.sidebar-li-sub-menu route="dashboard.services.index" title="عرض الخدمات" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.services.create" title="إضافة خدمة جديدة" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-3">الوظائف والإعلانات</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="الوظائف" customClass="menu-title fs-4"
                    index="dashbaord.jobs.index" create="dashboard.jobs.create">
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
                    <x-elements.sidebar-li-sub-menu route="dashboard.jobs.index" title="متابعة الوظائف" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.jobs.create" title="إضافة وظيفة" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <x-elements.sidebar-menu-item lable="المدونة" customClass="menu-title fs-4"
                    index="dashbaord.blogs.index" create="dashbaord.blogs.create">
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
                    <x-elements.sidebar-li-sub-menu route="dashboard.blogs.index" title="المدونات" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.blogs.create" title="تدوين" />
                </x-elements.sidebar-menu-item>

                <x-elements.sidebar-menu-item lable="الاعلانات" customClass="menu-title fs-4"
                                              index="dashboard.advertisements.index" create="dashboard.advertisements.create">
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
                    <x-elements.sidebar-li-sub-menu route="dashboard.advertisements.index" title="اعلانات المتجر" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.product-advertisements.index" title="إعلانات المنتج" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.products-list.index" title="اعلانات قائمة المنتجات "/>
                    <x-elements.sidebar-li-sub-menu route="dashboard.main-banners.index" title="اعلانات البنر الرئيسي "/>
                    <x-elements.sidebar-li-sub-menu route="dashboard.sub-banners.index" title="اعلانات البنر الفرعي "/>
                </x-elements.sidebar-menu-item>


                <x-elements.sidebar-menu-item lable="دفع الاشعارات" customClass="menu-title fs-4"
                                              index="dashboard.index.noti" create="dashboard.create.noti">
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
                    <x-elements.sidebar-li-sub-menu route="dashboard.create.noti" title="انشاء اشعار" />
                    <x-elements.sidebar-li-sub-menu route="dashboard.index.noti" title="عرض الاشعارات" />
                </x-elements.sidebar-menu-item>
                <!--end:Menu item-->

                {{--
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-3">إعدادت عامة</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <div class="separator separator-dashed mx-lg-5 mt-2 mb-6"></div>
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-address-book fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title fs-4">الملفات الشخصية </span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="../../demo1/dist/pages/user-profile/overview.html">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-heading fs-5">نظرة عامة</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                --}}
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="" id="kt_app_sidebar_footer">
        <div class="pt-2 pb-6 px-6">
            <a href="{{ route('dashboard.topics.create') }}"
                class="btn btn-flex flex-center justify-content-around btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click">
                <span class="btn-label fs-3">كتابة موضوع</span>
                <i class="ki-duotone ki-document btn-icon fs-1 m-0">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </div>
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
