<x-store.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="dashboard.home" previews="الرئيسية" current="قائمة المنتجات" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Form-->
                    <div class="form d-flex flex-column flex-lg-row">
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin:::Tabs-->
                            <ul
                                class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                        href="#kt_ecommerce_add_product_general">تفاصيل المنتج</a>
                                </li>
                                <!--end:::Tab item-->

                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                        href="#kt_ecommerce_add_product_reviews">المراجعات</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                    role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::General options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="card-body pt-9 pb-0">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                                        <!--begin::Image-->
                                                        <div
                                                            class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                                            <img class="mw-90px mw-lg-100px rounded-3"
                                                                src="{{ $product->image }}" alt="image">
                                                        </div>
                                                        <!--end::Image-->
                                                        <!--begin::Wrapper-->
                                                        <div class="flex-grow-1">
                                                            <!--begin::Head-->
                                                            <div
                                                                class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                                                <!--begin::Details-->
                                                                <div class="d-flex flex-column">
                                                                    <!--begin::Status-->
                                                                    <div class="d-flex align-items-center mb-1">
                                                                        <a href="#"
                                                                            class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $product->name }}</a>
                                                                        <span
                                                                            class="badge badge-light-success me-auto">{{ $product->status_ar }}</span>
                                                                    </div>
                                                                    <!--end::Status-->
                                                                </div>
                                                                <!--end::Details-->
                                                            </div>
                                                            <!--end::Head-->
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-wrap justify-content-start">
                                                                <!--begin::Stats-->
                                                                <div class="d-flex flex-wrap">
                                                                    <!--begin::Stat-->
                                                                    <div
                                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                                        <!--begin::Number-->
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="fs-4 fw-bold">
                                                                                {{ $product->created_at->format('M, Y d') }}
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Number-->
                                                                        <!--begin::Label-->
                                                                        <div class="fw-semibold fs-6 text-gray-400">
                                                                            تاريخ المنتج</div>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Stat-->
                                                                    <!--begin::Stat-->
                                                                    <div
                                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                                        <!--begin::Number-->
                                                                        <div class="d-flex align-items-center">
                                                                            <i
                                                                                class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </i>
                                                                            <div class="fs-4 fw-bold counted"
                                                                                data-kt-countup="true"
                                                                                data-kt-countup-value="75"
                                                                                data-kt-initialized="1">
                                                                                {{ $product->visits_count }}</div>
                                                                        </div>
                                                                        <!--end::Number-->
                                                                        <!--begin::Label-->
                                                                        <div class="fw-semibold fs-6 text-gray-400">
                                                                            زيارات المنتج</div>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Stat-->
                                                                    <!--begin::Stat-->
                                                                    <div
                                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                                        <!--begin::Number-->
                                                                        <div class="d-flex align-items-center">
                                                                            <i
                                                                                class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </i>
                                                                            <div class="fs-4 fw-bold counted"
                                                                                data-kt-countup="true"
                                                                                data-kt-countup-value="15000"
                                                                                data-kt-countup-prefix="$"
                                                                                data-kt-initialized="1">
                                                                                ${{ $product->price }}</div>
                                                                        </div>
                                                                        <!--end::Number-->
                                                                        <!--begin::Label-->
                                                                        <div class="fw-semibold fs-6 text-gray-400">
                                                                            سعر المنتج</div>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Stat-->
                                                                </div>
                                                                <!--end::Stats-->
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->
                                        <!--begin::General options-->
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2>صور المنتج </h2>
                                                </div>
                                                <!--end::Card title-->
                                            </div>
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="card-body pt-9 pb-0">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                                        @foreach ($product->images as $image)
                                                            <!--begin::Image-->
                                                            <div
                                                                class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                                                <img class="mw-90px mw-lg-100px rounded-3"
                                                                    src="{{ $image }}" alt="image">
                                                            </div>
                                                            <!--end::Image-->
                                                        @endforeach

                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade" id="kt_ecommerce_add_product_reviews" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::Reviews-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2>Customer Reviews</h2>
                                                </div>
                                                <!--end::Card title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar">
                                                    <!--begin::Rating label-->
                                                    <span class="fw-bold me-5">Overall Rating:</span>
                                                    <!--end::Rating label-->
                                                    <!--begin::Overall rating-->
                                                    <div class="rating">
                                                        <div class="rating-label checked">
                                                            <i class="ki-duotone ki-star fs-2"></i>
                                                        </div>
                                                        <div class="rating-label checked">
                                                            <i class="ki-duotone ki-star fs-2"></i>
                                                        </div>
                                                        <div class="rating-label checked">
                                                            <i class="ki-duotone ki-star fs-2"></i>
                                                        </div>
                                                        <div class="rating-label checked">
                                                            <i class="ki-duotone ki-star fs-2"></i>
                                                        </div>
                                                        <div class="rating-label">
                                                            <i class="ki-duotone ki-star fs-2"></i>
                                                        </div>
                                                    </div>
                                                    <!--end::Overall rating-->
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Table-->
                                                <table class="table table-row-dashed fs-6 gy-5 my-0"
                                                    id="kt_ecommerce_add_product_reviews">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="w-10px pe-2">
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        data-kt-check="true"
                                                                        data-kt-check-target="#kt_ecommerce_add_product_reviews .form-check-input"
                                                                        value="1" />
                                                                </div>
                                                            </th>
                                                            <th class="min-w-125px">Rating</th>
                                                            <th class="min-w-175px">Customer</th>
                                                            <th class="min-w-175px">Comment</th>
                                                            <th class="min-w-100px text-end fs-7">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-danger">
                                                                            <span class="text-danger">M</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Melody Macy</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">I like this design</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">Today</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-1.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Max Smith</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Good product for outdoors
                                                                or indoors</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">day ago</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-4">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-5.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Sean Bean</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Awesome quality with
                                                                great materials used, but could be more comfortable</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">11:20 PM</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-25.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Brian Cox</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">This is the best product
                                                                I've ever used.</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">2 days ago</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-3">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-warning">
                                                                            <span class="text-warning">C</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Mikaela Collins</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">I thought it was just
                                                                average, I prefer other brands</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">July 25</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-9.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Francis Mitcham</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Beautifully crafted.
                                                                Worth every penny.</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">July 24</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-4">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-danger">
                                                                            <span class="text-danger">O</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Olivia Wild</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Awesome value for money.
                                                                Shipping could be faster tho.</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">July 13</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-primary">
                                                                            <span class="text-primary">N</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Neil Owen</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Excellent quality, I got
                                                                it for my son's birthday and he loved it!</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">May 25</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-23.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Dan Wilson</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">I got this for Christmas
                                                                last year, and it's still the best product I've ever
                                                                used!</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">April 15</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-danger">
                                                                            <span class="text-danger">E</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Emma Bold</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Was skeptical at first,
                                                                but after using it for 3 months, I'm hooked! Will
                                                                definately buy another!</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">April 3</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-4">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-12.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Ana Crown</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Great product, too bad I
                                                                missed out on the sale.</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">March 17</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <div class="symbol-label bg-light-info">
                                                                            <span class="text-info">A</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">Robert Doe</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Got this on sale! Best
                                                                decision ever!</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">March 12</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <div
                                                                    class="form-check form-check-sm form-check-custom form-check-solid mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </div>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                            <td data-order="rating-5">
                                                                <!--begin::Rating-->
                                                                <div class="rating">
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                    <div class="rating-label checked">
                                                                        <i class="ki-duotone ki-star fs-6"></i>
                                                                    </div>
                                                                </div>
                                                                <!--end::Rating-->
                                                            </td>
                                                            <td>
                                                                <a href="../../demo1/dist/apps/inbox/reply.html"
                                                                    class="d-flex text-dark text-gray-800 text-hover-primary">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-circle symbol-25px me-3">
                                                                        <span class="symbol-label"
                                                                            style="background-image:url(assets/media/avatars/300-13.jpg)"></span>
                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                    <!--begin::Name-->
                                                                    <span class="fw-bold">John Miller</span>
                                                                    <!--end::Name-->
                                                                </a>
                                                            </td>
                                                            <td class="text-gray-600 fw-bold">Firesale is on! Buy now!
                                                                Totally worth it!</td>
                                                            <td class="text-end">
                                                                <span class="fw-semibold text-muted">March 11</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Reviews-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary ">رجوع</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                        </ي>
                        <!--end::Form-->
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
        </div>
        <!--end:::Main-->
</x-store.master>
