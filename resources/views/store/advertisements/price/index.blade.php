<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية" current="قائمة أسعار الاعلانات" />
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
                                @include('admin.regions._filters')
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.prices.create')}}" class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-plus "></i>اضافة سعر الاعلان </a>
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
                                        <th class="min-w-225px">نوع الاعلان</th>
                                        <th class="min-w-225px">السعر/بالشيكل</th>
                                        <th class="min-w-50px">التاريخ</th>
                                        <th class="min-w-100px text-end rounded-end px-5">العمليات</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>

                                    @foreach ($prices as $price)
                                        <tr>
                                            <td>
                                                <div
                                                    class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                    {{ $loop->iteration }}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                    @if( $price->ad_type == 'store')
                                                        {{'اعلان المتجر'}}
                                                    @elseif($price->ad_type == 'product')
                                                        {{'اعلان المنتج'}}
                                                    @elseif($price->ad_type == 'products_list')
                                                        {{'اعلان قائمة منتجات'}}
                                                    @elseif($price->ad_type == 'main_banner')
                                                        {{'اعلان البنر الرئيسي'}}
                                                    @elseif($price->ad_type == 'sub_banner')
                                                        {{'اعلان البنر الفرعي'}}
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                    {{ $price->amount}} {{'شيكل'}}
                                                </div>
                                            </td>

                                            <td>
                                                <span class="fs-5 fw-bold">{{ $price->created_at->format('Y/m/d') }}</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="{{route('admin.prices.edit',$price)}}"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                                <a onclick="confirmDestroy({{$price->id}}, this)"
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
{{--                                        <td colspan="8"> {{ $regions->WithQueryString()->links() }}</td>--}}
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
        <x-elements.delete-script name="prices" />
    @endpush
</x-admin.master>
