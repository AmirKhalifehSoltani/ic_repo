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
            </div><div class="form-group">
                <label for="user2">شماره همراه کاربر ۲
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-barcode"></i>
                    </span>
                    <input id="user2" class="form-control" name="user2" type="text"
                           value="{{ old('user2', isset($device_user_phone_numbers[0]) && $device_user_phone_numbers[0] != ''? $device_user_phone_numbers[0]: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="user3">شماره همراه کاربر ۳
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-barcode"></i>
                    </span>
                    <input id="user3" class="form-control" name="user3" type="text"
                           value="{{ old('user3', isset($device_user_phone_numbers[1]) && $device_user_phone_numbers[1] != ''? $device_user_phone_numbers[1]: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="user4">شماره همراه کاربر ۴
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-barcode"></i>
                    </span>
                    <input id="user4" class="form-control" name="user4" type="text"
                           value="{{ old('user4', isset($device_user_phone_numbers[2]) && $device_user_phone_numbers[2] != ''? $device_user_phone_numbers[2]: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="user5">شماره همراه کاربر ۵
                </label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-barcode"></i>
                    </span>
                    <input id="user5" class="form-control" name="user5" type="text"
                           value="{{ old('user5', isset($device_user_phone_numbers[3]) && $device_user_phone_numbers[3] != ''? $device_user_phone_numbers[3]: '') }}">
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
