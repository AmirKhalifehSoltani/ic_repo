<div class="col-md-6 offset-md-3">
    <form id="simple-form" role="form" method="post" action="">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label for="first_name">نام <small> (الزامی)</small></label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                    <input id="first_name" class="form-control" name="first_name" type="text"
                           value="{{ old('first_name', isset($userItem)? $userItem->first_name: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="last_name">نام خانوادگی <small> (الزامی)</small></label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                    <input id="last_name" class="form-control" name="last_name" type="text"
                           value="{{ old('last_name', isset($userItem)? $userItem->last_name: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="user_name">نام کاربری <small> (الزامی)</small></label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                    <input id="user_name" class="form-control" name="user_name" type="text"
                           value="{{ old('user_name', isset($userItem)? $userItem->user_name: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email">ایمیل</label></label>
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="icon-envelope"></i>
                </span>
                    <input id="email" class="form-control ltr text-left" type="email" name="email"
                           value="{{ old('email', isset($userItem)? $userItem->email: '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور<small> (الزامی، حداقل ۴ و حداکثر ۱۲
                        کارکتر) </small></label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-key"></i>
                    </span>
                    <input type="password" id="password" minlength="5" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group">
                <label>نقش</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-options"></i>
                    </span>
                    <select class="form-control" name="role">
                        <option value="0" {{ isset($userItem) && $userItem->role === 0 ? 'selected': ''}}>کاربر</option>
                        <option value="1" {{ isset($userItem) && $userItem->role === 1 ? 'selected': ''}}>مدیر</option>
                    </select>
                </div><!-- /.input-group -->
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
