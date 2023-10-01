<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية" current="قائمة طلبات الاعلانات" />
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
                                @include('admin.advertisements.store._filters')
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
                                        <th class="min-w-200px"> المتجر</th>
                                        <th class="min-w-200px">صاحب المتجر</th>
                                        <th class="min-w-50px"> تاريخ بدء الاعلان</th>
                                        <th class="min-w-50px"> تاريخ انتهاء الاعلان</th>
                                        <th class="min-w-50px">السعر</th>
                                        <th class="min-w-50px">حالة الاعلان</th>
                                        <th class="min-w-300px text-end rounded-end px-5">العمليات</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>

                                    @foreach ($store_advertisements as $store_advertisement)
                                        <tr>
                                            <td>
                                                <div
                                                    class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                    {{ $loop->iteration }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="{{ route('admin.stores.show', $store_advertisement->store->id) }}"
                                                           class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $store_advertisement->store->name }}
                                                        </a>
                                                        <span
                                                            class="text-muted fw-semibold text-muted d-block fs-7">{{ $store_advertisement->store->store_level }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                    {{ $store_advertisement->store->seller->name }}</div>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                    {{ $store_advertisement->start_at }}</div>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-primary fs-7 fw-bold"> {{ $store_advertisement->end_at }}</span>
                                            </td>
                                            <td>
                                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                    {{$store_advertisement->price}} {{'شيكل'}}
                                                </div>
                                            </td>
                                            <td>
                                                @if($store_advertisement->status == 'Active')
                                                    <span class="badge badge-success">{{ 'الاعلان فعال' }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ 'الاعلان غير فعال' }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                <a onclick="confirmDestroy({{ $store_advertisement->id }}, this)"
                                                   class="btn btn-bg-danger text-white btn-sm me-1">
                                                    حذف الاعلان (طلب مرفوض)
                                                </a>
                                                <form action="{{ route('admin.advertisement-store.accept', $store_advertisement->id) }}"
                                                      method="POST" class="d-inline ">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-bg-primary text-white btn-sm">
                                                        قبول
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8">
                                            {{ $store_advertisements->WithQueryString()->links() }}
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
        <x-elements.delete-script name="advertisements" />
    @endpush
</x-admin.master>
