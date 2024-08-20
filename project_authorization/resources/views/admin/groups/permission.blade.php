<x-admin-layout>
    @section('title', 'Phân quyền nhóm')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm: {{ $group->name }}</h1>
    </div>
    <form action="{{ route('admin.groups.permission', $group) }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Module</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($modules as $module)
                    <tr>
                        <td>{{ $module->title }}</td>
                        <td>
                            <div class="row">
                                @if (!empty($roleListArray))
                                    @foreach ($roleListArray as $roleName => $roleLabel)
                                        <div class="col-2 ">
                                            <div class="">
                                                <input name="role[{{ $module->name }}][]"
                                                    type="checkbox"id="role_{{ $module->name }}_{{ $roleName }}"
                                                    value="{{ $roleName }}"{{ isRole($roleArray,$module->name,$roleName) ?'checked': false }}>
                                                <label class=""
                                                    for="role_{{ $module->name }}_{{ $roleName }}">{{ $roleLabel }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($module->name == 'groups')
                                    <div class="col-2">
                                        <div class="">
                                            <input name="role[{{ $module->name }}][]"
                                                type="checkbox"id="role_{{ $module->name }}_permission"
                                                value="permission"{{ isRole($roleArray,$module->name,'permission') ?'checked': false }}>
                                            <label class="" for="role_{{ $module->name }}_permission">Phân
                                                quyền</label>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center bg-warning">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <button class="btn btn-primary px-5 mt-4">Phân quyền</button>
    </form>
</x-admin-layout>
