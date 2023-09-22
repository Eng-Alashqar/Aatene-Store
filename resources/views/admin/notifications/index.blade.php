<x-admin.master>
    <!--begin::Main-->
     <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.home" previews="الرئيسية - قائمة الاشعارات" current="{{$current}}" />
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

                                <a class="" href="{{route('admin.notification' , ['type' => 'create-store'])}}">الاشعارات انشاء متجر</a>
                                <a class="" href="{{route('admin.notification' , ['type' => 'create-product'])}}">الاشعارات انشاء منتج</a>
                                <a class="" href="{{route('admin.notification' , ['type' => 'update-product'])}}">الاشعارات تعديل منتج</a>
                            </div>
                            <div class="card-toolbar">
                                <form action="{{ route('admin.notification.mark.all.read') }}" method="post" >
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light-primary fs-3">
                                    <i class="ki-duotone ki-eye">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>تعيين الجميع كمقروءة</button>
                                </form>
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
                                        <th class="min-w-225px">نوع الاشعار</th>
                                        <th class="min-w-200px">الاشعار</th>
                                        <th class="min-w-50px">وقت الاشعار</th>
                                        <th class="min-w-100px text-end rounded-end px-5">تعيين كمقروءة</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    @php $x = 1 ; @endphp

                                    @forelse($notifications as $notification)
                                        <tr>
                                            <td>
                                                <div class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                    {{$x++}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-5">
                                                        <img src="https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg" data-src="https://t4.ftcdn.net/jpg/04/70/29/97/240_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg" class="lozad rounded mw-100" alt="" data-loaded="true">
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{explode("\\" , $notification->type)[2]}}

                                                        </a>
                                                        <span class="text-muted fw-semibold text-muted d-block fs-7">@if(is_null($notification->read_at)){{"غيرمقروءة"}} @else {{'مقروءة'}} @endif</span>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if(explode("\\" , $notification->type)[2] == 'CreateStore')
                                                  <a href="{{route('admin.stores.pending')}}">
                                                       <div class="text-dark fw-bold  d-block mb-1 fs-6">{{$notification->data['message']}}</div>
                                                   </a>
                                                @else
                                                       <div class="text-dark fw-bold  d-block mb-1 fs-6">{{$notification->data['message']}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-light-primary fs-7 fw-bold">{{$notification->created_at->diffForHumans()}} </span>
                                            </td>
                                            <td class="text-end">
                                                <form method="POST" action="{{route('admin.notification.mark.read' , ['id'=>$notification->id])}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="ki-duotone ki-eye">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i></button>
                                                </form>

                                                </i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5"><center>لا يوجد اشعارات غير مقروءة من هذا النوع ({{$current}})</center></td></tr>
                                    @endforelse
                                        <tr>
{{--                                            <td colspan="8"> {{ $notifications->links() }}</td>--}}
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

    @endpush
</x-admin.master>

