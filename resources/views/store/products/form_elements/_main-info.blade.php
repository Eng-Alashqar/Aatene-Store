<div class="card card-flush py-4 ">
    <!--begin::Header-->
    <div class="card-header border-0 ">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1"> إضافة منتج</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <div class="mb-5">
            <x-form.input-with-lable lable="اسم المنتج" name="name" placeholder="ادخل اسم المنتج" />
        </div>
        <div class="mb-5">
            <label for="description" class="required form-label">وصف المنتج</label>
            <div id="kt_docs_quill_basic" name="description" class="form-control form-control-solid">
                {!! old('description') !!}</div>
            <textarea name="description" id="description" style="display: none"></textarea>
        </div>
        <div class="mb-5">
            <!--begin::Label-->
            <label class="form-label d-block">كلمات البحث</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input id="tags" name="tags" data-tagify="tagify"
                class="form-control @error('tag') is-invalid @enderror mb-2" value="{{ old('tags') }}" />
            <!--end::Input-->
        </div>
    </div>
    <!--begin::Body-->
</div>


@push('scripts')
    <script>
        new Tagify(document.querySelector('[data-tagify="tagify"]'));

        $(document).ready(
            function() {
                var toolbarOptions = [
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    ['blockquote'],

                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }], // custom button values
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'direction': 'rtl'
                    }], // text direction

                    [{
                        'size': ['small', false, 'large', 'huge']
                    }], // custom dropdown
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],

                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // dropdown with defaults from theme
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],

                ];
                var quill = new Quill('#kt_docs_quill_basic', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow'
                });
                quill.format('align', 'right');
                quill.format('direction', 'rtl');
                let formSubmitHandler = document.getElementById('form-create');
                let textarea = document.getElementById('description');
                formSubmitHandler.addEventListener("submit", (event) => {
                    event.preventDefault();
                    textarea.value = quill.root.innerHTML;
                    formSubmitHandler.submit();
                });
            }
        );
    </script>
@endpush
