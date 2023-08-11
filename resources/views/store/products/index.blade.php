<x-store.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="dashboard.home" previews="الرئيسية" current="قائمة المتاجر"/>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <div class="card-title align-items-start flex-column">
                                @include('store.products._filters')
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('dashboard.products.create') }}"
                                   class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-plus "></i>اضافة منتج </a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="fw-bold text-muted bg-light fs-5">
                                        <th class="ps-4 min-w-50px rounded-start">#</th>
                                        <th class="min-w-200px">المنتج</th>
                                        <th class="min-w-150px">الفئة</th>
                                        <th class="min-w-70px">الكمية</th>
                                        <th class="min-w-100px">السعر</th>
                                        <th class="min-w-100px">التقييم</th>
                                        <th class="min-w-100px">الحالة</th>
                                        <th class="min-w-100px text-end rounded-end px-5">العمليات</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <div
                                                    class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                    {{ $loop->iteration }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-5">
                                                        <img src="{{ asset('assets/media/misc/spinner.gif') }}"
                                                             data-src="{{ $product->image }}"
                                                             class="lozad rounded mw-100" alt=""/>
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#"
                                                           class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ $product->category->name }}</div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ $product->quantity }}</div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ $product->price }}</div>
                                            </td>
                                            <td class="text-end fw-bold">
                                                <div class="rating">
                                                    {{$product->rating}}%
                                                </div>
                                            </td>
                                            <td>
                                                    <span
                                                        class="badge @if ($product->status === 'active') badge-light-success
                                                            @elseif ($product->status === 'draft') badge-light-primary
                                                            @else badge-light-danger @endif fs-7 fw-bold"
                                                    >@if($product->status === 'active')
                                                            فعال
                                                        @elseif($product->status === 'draft')
                                                            مسودة
                                                        @else
                                                            مؤرشف
                                                        @endif
                                                    </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <a onclick="confirmDestroy({{ $product->id }}, this)"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                    <i class="ki-duotone ki-trash fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="7"
                                            class="text-primary fw-bold text-center mb-1 fs-6">
                                            لا يوجد منتجات، انقر على اضافة منتج لاضافة منتج جديد
                                        </td>
                                    @endforelse
                                    <tr>
                                        <td colspan="8"> {{ $products->withQueryString()->links() }}</td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 11-->


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
        <x-elements.delete-script name="products" dashboard="dashboard"/>
        @endpush
</x-store.master>
