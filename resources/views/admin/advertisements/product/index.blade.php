<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية" current="قائمة اعلانات المنتجات"/>
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
{{--                                @include('admin.advertisements.store._filters')--}}
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('admin.product-advertisements.create') }}"
                                   class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-plus "></i>اضافة اعلان المنتج </a>
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
                                        <th class="min-w-50px"> تاريخ بدء الاعلان</th>
                                        <th class="min-w-50px"> تاريخ انتهاء الاعلان</th>
                                        <th class="min-w-50px"> سعر الاعلان</th>
                                        <th class="min-w-50px">الاجمالي</th>
                                        <th class="min-w-100px">حالة الاعلان</th>
                                        <th class="min-w-100px text-end rounded-end px-5">العمليات</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>

                                    @foreach ($product_ads as $product_ad)
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
{{--                                                             data-src="{{ $product_ad->product->image }}"--}}
                                                             class="lozad rounded mw-100" alt=""/>
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                            {{ $product_ad->product->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                    {{ $product_ad->start_at }}</div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-light-primary fs-7 fw-bold"> {{ $product_ad->end_at }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-info fs-7 fw-bold">
                                                    {{$product_ad->price}} {{'شيكل'}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-info fs-7 fw-bold">
                                                    {{$product_ad->total}} {{'شيكل'}}
                                                </span>
                                            </td>
                                            <td>
                                                @if($product_ad->status == 'Active')
                                                    <span class="badge badge-success">{{ 'الاعلان فعال' }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ 'الاعلان غير فعال' }}</span>
                                                @endif

                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.product-advertisements.edit',$product_ad->id) }}"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <a onclick="confirmDestroy({{$product_ad->id}}, this)"
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
                                    @endforeach
                                    <tr>
                                        <td colspan="8">
                                            {{ $product_ads->WithQueryString()->links() }}
                                        </td>
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
        <x-elements.delete-script name="product-advertisements"/>
    @endpush
</x-admin.master>
