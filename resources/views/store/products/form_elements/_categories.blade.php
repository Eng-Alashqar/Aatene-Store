      <!--begin::Input group-->
      <div class="mb-5">
        <label class="required form-label">تصنيف المنتج</label>
        <!--begin::Menu wrapper-->
        <div>
            <!--begin::Toggle-->
            <button type="button" class="btn btn-dark w-100  rotate" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-end" data-kt-menu-offset="30px, 30px">
                اختر القسم
            </button>
            <!--end::Toggle-->

            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">الاقسام</div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mb-3 opacity-75"></div>
                <!--end::Menu separator-->
                <script>
                    const saveCategory = (name, id, referances) => {
                        console.log(name, id);
                        document.querySelector('#category_id').value = id;
                        document.querySelector('#category_name').value = name;
                    }
                </script>
                @foreach ($categories as $category)
                    <!--begin::Menu item-->
                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                        data-kt-menu-placement="left-start">
                        <!--begin::Menu item-->
                        <a href="#" class="menu-link px-3"
                            onclick="saveCategory('{{ $category->name }}','{{ $category->id }}')">
                            <span class="menu-title">{{ $category->name }}</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--end::Menu item-->
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            @foreach ($category->children as $child)
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                    data-kt-menu-placement="left-start">
                                    <!--begin::Menu item-->
                                    <a href="#" class="menu-link px-3"
                                        onclick="saveCategory('{{ $child->name }}','{{ $child->id }}')">
                                        <span class="menu-title"> {{ $child->name }}</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        @foreach ($category->children as $child)
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                @forelse ($child->children()->get() as $supChild)
                                                    <a href="#" class="menu-link px-3"
                                                        onclick="saveCategory('{{ $supChild->name }}','{{ $supChild->id }}')">
                                                        {{ $supChild->name }}
                                                    </a>
                                                @empty
                                                @endforelse
                                            </div>
                                        @endforeach
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                            @endforeach
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                @endforeach
            </div>
            <!--end::Menu-->

            <input id="category_id" name="category_id" type="hidden" value="{{ old('category_id') }}">

            <input id="category_name" name="category_name" type="text" value="" readonly disabled
                placeholder=" القسم المختار " value="{{ old('category_name') }}"
                class="form-control my-4 @error('category_id') is-invalid @enderror">
        </div>
        <!--end::Dropdown wrapper-->


    </div>
    <!--end::Input group-->
