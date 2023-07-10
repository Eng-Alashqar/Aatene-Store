<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="dashboard.home" previews="الرئيسية" current="قائمة الوظائف" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">قائمة الوظائف</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">اكثر من {{ $jobs->total() }}
                                    وظيفة</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="{{ route('dashboard.jobs.create') }}"
                                    class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-plus "></i>اضافة وظيفة </a>
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
                                            <th class="min-w-150px">اسم الشركة</th>
                                            <th class="min-w-200px">العنوان الوظيفي</th>
                                            <th class="min-w-100px">الموقع</th>
                                            <th class="min-w-150px">طبيعة العمل</th>
                                            <th class="min-w-100px">نوع العمل</th>
                                            <th class="min-w-100px">الراتب</th>
                                            <th class="min-w-100px text-end rounded-end px-5">العمليات</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @forelse ($jobs as $job)
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
                                                                data-src="{{ $job->company_logo }}"
                                                                class="lozad rounded mw-100" alt="" />
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $job->company }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                        {{ $job->title }}</div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                        {{ $job->location }}</div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge @if ($job->place === 'office') badge-light-success
                                                            @else badge-light-warning @endif fs-7 fw-bold"
                                                            >{{ $job->place }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge @if ($job->type === 'full-time') badge-light-success
                                                            @elseif ($job->type === 'part-time') badge-light-warning
                                                            @else badge-light-info @endif fs-7 fw-bold"
                                                            >{{ $job->type }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                                        {{ $job->salary }}</div>
                                                </td>
                                                <td class="text-end">
                                                    {{-- <a href="{{ route('dashboard.jobs.edit', $job->id) }}" --}}
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    <a onclick="confirmDestroy({{ $job->id }}, this)"
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
                                            <td colspan="8"
                                                class="text-primary fw-bold text-center mb-1 fs-6">
                                                لا يوجد وظائف، انقر على اضافة وظيفة لاضافة وظيفة جديدة
                                            </td>
                                        @endforelse
                                        <tr>
                                            <td colspan="8"> {{ $jobs->links() }}</td>
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
        <x-elements.delete-script name="jobs" />
    @endpush
</x-admin.master>
