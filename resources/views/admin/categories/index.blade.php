<x-admin.master>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية" current="قائمة الأقسام" />
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
                                <form action="{{ route('admin.categories.index') }}">
                                    <div class="d-flex align-items-center">
                                        <!--begin::Input group-->
                                        <div class="position-relative w-md-400px me-md-2">
                                            <i
                                                class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <input type="text" class="form-control form-control-solid ps-10"
                                                name="search" value="{{ request()->query('search') }}" placeholder="ابحث هنا... ">
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex my-0">
                                            <!--begin::Select-->
                                            <select name="status" data-control="select2" data-hide-search="true"
                                                data-placeholder="الحالة"
                                                class="form-select form-select-sm border-body bg-body w-150px me-5">
                                                <option value="active" @selected(request()->query('status') == 'active')>قسم نشط</option>
                                                <option value="archive" @selected(request()->query('status') == 'archive')> قسم مؤرشف</option>
                                            </select>
                                            <!--end::Select-->
                                            <!--begin::Select-->
                                            <select name="count" data-control="select2" data-hide-search="true"
                                            data-placeholder="العدد"
                                            class="form-select form-select-sm border-body bg-body w-150px me-5" >
                                            <option value="7" @selected(request()->query('count') == 7)>7</option>
                                            <option value="15" @selected(request()->query('count') == 15)> 15</option>
                                            <option value="25" @selected(request()->query('count') == 25)> 25</option>
                                            <option value="50" @selected(request()->query('count') == 50)> 50</option>
                                            <option value="100" @selected(request()->query('count') == 100)> 100</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin:Action-->
                                        <div class="d-flex align-items-center">
                                            <button type="submit" class="btn btn-sm btn-light-primary fs-3 me-5"><i
                                                    class="ki-duotone ki-filter-search fs-1">
                                                    <i class="path1"></i>
                                                    <i class="path2"></i>
                                                    <i class="path3"></i>
                                                </i>فلترة</button>
                                            <a href="{{ route('admin.categories.index') }}"
                                                class="btn btn-sm btn-light-primary btn-icon fs-3 me-5"><i
                                                    class="ki-duotone ki-cross-circle fs-2">
                                                    <i class="path1"></i>
                                                    <i class="path2"></i>
                                                </i></a>
                                        </div>
                                        <!--end:Action-->
                                    </div>
                                </form>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('admin.categories.create') }}"
                                    class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-plus "></i>اضافة قسم </a>
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
                                            <th class="min-w-325px">القسم</th>
                                            <th class="min-w-100px">القسم الاساسي</th>
                                            <th class="min-w-100px">عدد المنتجات</th>
                                            <th class="min-w-100px">الحالة</th>
                                            <th class="min-w-200px text-end rounded-end px-5">العمليات</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach ($categories as $category)
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
                                                                data-src="{{ $category->image }}"
                                                                class="lozad rounded mw-100" alt="" />
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <div
                                                                class="text-dark fw-bold  mb-1 fs-6">{{ $category->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                        {{ $category->parent->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold  d-block mb-1 fs-6">
                                                        {{-- {{ $category->prodcuts->count() }} --}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-light-primary fs-7 fw-bold">{{ $category->status_ar }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    <a onclick="confirmDestroy({{ $category->id }}, this)"
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
                                            <td colspan="8"> {{ $categories->withQueryString()->links() }}</td>
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
        <x-elements.delete-script name="categories" />
    @endpush
</x-admin.master>
