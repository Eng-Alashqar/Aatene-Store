<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.stores.index" previews="قائمة المتاجر"
                current=" متجر {{ $store->name }}" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Navbar-->
                    <div class="card mb-6">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{ $store->image }}" alt="image" />
                                        <div
                                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#"
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $store->name }}</a>
                                                <a href="#">
                                                    <i class="ki-duotone ki-verify fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                            </div>
                                            <!--end::Name-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                    <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>{{ $store->user->name }}</a>

                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                    <i class="ki-duotone ki-sms fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>{{ $store->user->email }}</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->

                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap flex-stack">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="4500">0
                                                        </div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold fs-6 text-gray-400">عدد المتابعين</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="80">0</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold fs-6 text-gray-400">عدد المنتجات</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="60" data-kt-countup-prefix="%">0
                                                        </div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold fs-6 text-gray-400">عدد الطلبات </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Wrapper-->

                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            <!--begin::Navs-->
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                        href="#">نظرة عامة</a>
                                </li>
                                <!--end::Nav item-->
                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                        href="#">المنتجات</a>
                                </li>
                                <!--end::Nav item-->

                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                        href="#">المتابعين</a>
                                </li>
                                <!--end::Nav item-->

                            </ul>
                            <!--begin::Navs-->
                        </div>
                    </div>
                    <!--end::Navbar-->
                    <!--begin::Followers toolbar-->
                    <div class="d-flex flex-wrap flex-stack mb-6">
                        <!--begin::Title-->
                        <h3 class="text-gray-800 fw-bold my-2"> عدد متابعينك
                            <span class="fs-6 text-gray-400 fw-semibold ms-1">(29)</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Followers toolbar-->
                    <!--begin::Row-->
                    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
                        <!--begin::Followers-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span class="symbol-label fs-2x fw-semibold text-info bg-light-info">P</span>
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Paul
                                        Marcus</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                                    <!--end::Position-->

                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-check following fs-3"></i>
                                        <i class="ki-duotone ki-plus follow fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Following</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span
                                            class="symbol-label fs-2x fw-semibold text-success bg-light-success">N</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Neil
                                        Owen</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Accountant at Numbers Co.</div>
                                    <!--end::Position-->

                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-plus follow fs-3"></i>
                                        <i class="ki-duotone ki-check following fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span
                                            class="symbol-label fs-2x fw-semibold text-primary bg-light-primary">S</span>
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Sean
                                        Paul</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Developer at Loop Inc</div>
                                    <!--end::Position-->

                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-plus follow fs-3"></i>
                                        <i class="ki-duotone ki-check following fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->

                        <!--end::Followers-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row(for show more)-->
                    <div class="row g-6 mb-6 g-xl-9 mb-xl-9 d-none" id="kt_followers_show_more_cards">
                        <!--begin::Followers-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <img src="assets/media//avatars/300-11.jpg" alt="image" />
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                        class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Patric Watson</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-check following fs-3"></i>
                                        <i class="ki-duotone ki-plus follow fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Following</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <img src="assets/media//avatars/300-6.jpg" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                        class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Olivia Larson</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Art Director at Seal Inc.</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-plus follow fs-3"></i>
                                        <i class="ki-duotone ki-check following fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span
                                            class="symbol-label fs-2x fw-semibold text-warning bg-light-warning">A</span>
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Adam
                                        Williams</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">System Arcitect at Wolto Co.</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-check following fs-3"></i>
                                        <i class="ki-duotone ki-plus follow fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Following</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span class="symbol-label fs-2x fw-semibold text-info bg-light-info">P</span>
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Paul
                                        Marcus</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light-primary btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-check following fs-3"></i>
                                        <i class="ki-duotone ki-plus follow fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Following</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span
                                            class="symbol-label fs-2x fw-semibold text-success bg-light-success">N</span>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Neil
                                        Owen</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Accountant at Numbers Co.</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-plus follow fs-3"></i>
                                        <i class="ki-duotone ki-check following fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-65px symbol-circle mb-5">
                                        <span
                                            class="symbol-label fs-2x fw-semibold text-primary bg-light-primary">S</span>
                                        <div
                                            class="bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-body h-15px w-15px ms-n3 mt-n3">
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Sean
                                        Paul</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-semibold text-gray-400 mb-6">Developer at Loop Inc</div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center flex-wrap mb-5">
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                            <div class="fw-semibold text-gray-400">Earnings</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-dashed rounded min-w-90px py-3 px-4 mx-2 mb-3">
                                            <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                            <div class="fw-semibold text-gray-400">Sales</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Follow-->
                                    <button class="btn btn-sm btn-light btn-flex btn-center"
                                        data-kt-follow-btn="true">
                                        <i class="ki-duotone ki-plus follow fs-3"></i>
                                        <i class="ki-duotone ki-check following fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                    <!--end::Follow-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--end::Col-->
                        <!--end::Followers-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Show more-->
                    <div class="d-flex flex-center">
                        <button class="btn btn-primary" id="kt_followers_show_more_button">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Show more</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Show more-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
    @push('scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        <x-elements.delete-script name="stores" />
    @endpush
</x-admin.master>
