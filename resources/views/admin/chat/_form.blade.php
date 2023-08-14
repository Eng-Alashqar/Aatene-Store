<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2> ابحث عن المحادثات </h2>
        </div>
    </div>
    <div class="row">
        <div class="card-body pt-0">
            <div class="mb-5">
                <label class="required form-label">المستخدمين</label>
                <input type="hidden" name="type" value="user" id="user-type">

                <select name="user_id" dir="rtl" class="form-select" data-control="select2"
                    data-placeholder="ابحث عن مستخدم " onchange="changeUserTpye(this)">
                    <option> - - - </option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}" d-type='admin'> {{ $admin->name }} (أدمن)</option>
                    @endforeach
                    @foreach ($sellers as $seller)
                        <option value={{ $seller->id }} d-type='seller'> {{ $seller->name }} (تاجر)</option>
                    @endforeach
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" d-type='user'> {{ $user->name }} (زبون)</option>
                    @endforeach
                </select>
                <script>
                    function changeUserTpye(referances) {
                        let type = referances.selectedOptions[0].getAttribute('d-type');
                        document.querySelector('#user-type').value = type;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<div class="my-5 text-end">
    <button type="submit" class="btn btn-primary  ">
        <span class="indicator-label"> ابحث </span>
        <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    </button>
</div>

<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>نتائج البحث </h2>
        </div>
    </div>
    <div class="row">
        <div class="card-body pt-0">
            <div class="mb-5">
                @forelse ($conversations ?? [] as $value)
                    @foreach ( $value as  $conversation )
                    <div class="card  card-bordered shadow-sm mb-4">
                        <div class="card-body fs-4 d-flex justify-content-between">
                           <div>
                            محادثة بين المستخدم :
                            {{ $conversation->Participants['participants'][0]->name }}
                            <br>
                            والمستخدم :
                            {{ $conversation->Participants['participants'][1]->name }}
                           </div>
                           <div>
                            <a href="{{ route('admin.chat.show',$conversation->id) }}" class="btn btn-primary">عرض المحادثة</a>
                           </div>
                        </div>
                    </div>
                    @endforeach
                @empty
                    <h5 class="text-center">لا يوجد محادثات لهذا المستخدم</h5>
                @endforelse
            </div>
        </div>
    </div>
</div>
