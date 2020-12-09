@if($user->id == 6)
    <a href="#" class="btn btn-secondary" title="ویرایش"><i class="icon-pencil"></i></a>
    <a href="#" class="btn btn-secondary" title="حذف"><i class="icon-trash"></i></a>
@else
<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info" title="ویرایش"><i class="icon-pencil"></i></a>
<a href="{{ route('admin.users.delete', $user->id) }}" onclick="return confirm('آیا از حذف دستگاه مطمئن هستید؟')" class="btn btn-danger" title="حذف"><i class="icon-trash"></i></a>
@endif