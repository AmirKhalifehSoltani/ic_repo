<div class="col-md-6 offset-md-3">
    <form id="simple-form" role="form" method="post" action="">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label for="device_name">نام دستگاه
                    <small> (الزامی)</small>
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                    <input id="device_name" class="form-control" name="device_name" type="text"
                           value="{{ old('device_name', isset($deviceItem)? $deviceItem->name: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="device_code">کد دستگاه
                    <small> (الزامی)</small>
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-barcode"></i>
                    </span>
                    <input id="device_code" class="form-control" name="device_code" type="text"
                           value="{{ old('device_code', isset($deviceItem)? $deviceItem->code: '') }}" {{ isset($deviceItem->code) && intval($deviceItem->code) > 0 ? 'disabled': '' }}>
                </div>
            </div>
            <div class="form-group">
                <label for="device_user">کاربر دستگاه
                    <small> (الزامی)</small>
                </label>
                <div class="input-group">
                    <select name="device_user" id="device_user" class="form-control select2">
                        <option value="0">کاربر را انتخاب کنید.</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{isset($deviceItem) && $deviceItem->user->id == $user->id? 'selected': '' }}>{{ $user->first_name.' '.$user->last_name.' ( '.$user->user_name.' )' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-actions">
            <button type="submit" class="btn btn-lg btn-success col-md-6 offset-md-3">
                <i class="icon-check"></i>
                ذخیره اطلاعات
            </button>
        </div>
    </form>
</div>
