<x-admin.master>

    <!--end::Image input placeholder-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <x-elements.toolbar back_url="admin.chat.index" previews="قائمة المحادثات" current="عرض المحادثات" />
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                        <!--begin::Messenger-->
                        <div class="card" id="kt_chat_messenger">
                            <!--begin::Card header-->
                            <div class="card-header" id="kt_chat_messenger_header">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::User-->
                                    <div class="d-flex justify-content-around flex-row me-3">
                                        محادثة بين المستخدم :
                                        {{ $conversation->Participants['participants'][0]->name }}
                                        <br>
                                        و المستخدم :
                                        {{ $conversation->Participants['participants'][1]->name }}

                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->


                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body" id="kt_chat_messenger_body">
                                <!--begin::Messages-->
                                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                                    data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                    data-kt-scroll-offset="5px" style="max-height: 225px;">

                                    @foreach ($conversation->messages as $message)
                                        @if (($conversation->initiator_id === $message->sender_id) && ($conversation->initiator_type === $message->sender_type))
                                            <!--begin::Message(out)-->
                                            <div class="d-flex justify-content-end mb-10 ">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column align-items-end">
                                                    <!--begin::User-->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <!--begin::Details-->
                                                        <div class="me-3">
                                                            <span
                                                                class="text-muted fs-7 mb-1">{{ $message->created_at->diffForHumans() }}</span>
                                                            <a href="#"
                                                                class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">{{ $message->sender->name }}</a>
                                                        </div>
                                                        <!--end::Details-->

                                                        <!--begin::Avatar-->
                                                        <div class="symbol  symbol-35px symbol-circle "><img
                                                                alt="Pic" src="{{ $message->sender->image }}">
                                                        </div>
                                                        <!--end::Avatar-->
                                                    </div>
                                                    <!--end::User-->

                                                    <!--begin::Text-->
                                                    <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end"
                                                        data-kt-element="message-text">{{ $message->body }} </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Message(out)-->
                                        @else
                                            <!--begin::Message(in)-->
                                            <div class="d-flex justify-content-start mb-10 ">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column align-items-start">
                                                    <!--begin::User-->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol  symbol-35px symbol-circle "><img
                                                                alt="Pic" src="{{ $message->sender->image }}">
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Details-->
                                                        <div class="ms-3">
                                                            <a href="#"
                                                                class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $message->sender->name }}</a>
                                                            <span
                                                                class="text-muted fs-7 mb-1">{{ $message->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <!--end::Details-->

                                                    </div>
                                                    <!--end::User-->

                                                    <!--begin::Text-->
                                                    <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start"
                                                        data-kt-element="message-text">
                                                        {{ $message->body }}
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Message(in)-->
                                        @endif
                                    @endforeach
                                </div>
                                <!--end::Messages-->
                            </div>
                            <!--end::Card body-->
                            <!--begin:Toolbar-->
                            <div class='text-end p-5'>
                                <!--begin::Send-->
                                <a class="btn btn-primary" href="{{ route('admin.chat.index') }}">رجوع </a>
                                <!--end::Send-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Messenger-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->


</x-admin.master>
