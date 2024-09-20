<div>
    <style>
        th, td {
            white-space: nowrap;
        }

        .first-col {
            position: absolute;
            width: 20em;
            margin-left: -15em;
            background-color: #cccccc !important;
        }

        .table-wrapper {
            overflow-x: scroll;
            width: 90%;
            margin: 0 auto;
        }

    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Role & Permission</h4>
                    </div>
                    <div class="card-action">
                        <a href="#" class="mt-lg-0 mt-md-0 mt-3 btn btn-primary btn-icon" data-bs-toggle="tooltip"
                           data-modal-form="form" data-icon="person_add" data-size="{{ $modalSize }}"
                           data--href="{{ $showFromCreateRole }}"
                           data-app-title="{{ __('role_permission.create_role.title') }}"
                           data-placement="top" title="{{ __('role_permission.create_role.title') }}">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </i>
                            <span>{{ __('role_permission.create_role.title') }}</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form wire:submit.prevent="submit">
                            <div class="table-wrapper">
                                <table class="table table-bordered " style="margin-left: 15%">
                                    <thead>
                                    <tr>
                                        <th class="first-col">#</th>
                                        @foreach ($roles as $role)
                                            <th class="text-center">{{ convertToTitleCase($role->name) }}
                                                @if($role->name !== config('constant.SUPER_ADMIN'))
                                                    <a href="#"
                                                       data-bs-toggle="tooltip"
                                                       data-modal-form="form" data-icon="person_add"
                                                       data-size="{{ $modalSize }}"
                                                       data--href="{{ route('system.edit.role', $role['id']) }}"
                                                       data-app-title="{{ __('role_permission.edit_role.title') }}"
                                                       data-placement="top"
                                                       title="{{ __('role_permission.edit_role.title') }}">
                                                        <svg fill="none" xmlns="http://www.w3.org/2000/svg"
                                                             width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24">
                                                            <path
                                                                d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                  stroke="currentColor" stroke-width="1.5"
                                                                  stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                  stroke="currentColor"
                                                                  stroke-width="1.5" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr class="bg-body">
                                            <td class="first-col">{{ $permission['name'] }}
                                            </td>
                                            @foreach ($roles as $role)
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                           {{ $role->name == config('constant.SUPER_ADMIN') ? 'disabled' : '' }}
                                                           id="role-{{ $role->id }}-permission-{{ $permission->id }}"
                                                           wire:key="role-{{ $role->id }}-permission-{{ $permission->id }}"
                                                           wire:model="permissionMatrix.{{ $permission->name }}.{{ $role->name }}"
                                                           name="permissionMatrix[{{ $permission->name }}][{{ $role->name }}]"
                                                           value='{{ $role->name }}'
                                                        {{ (\App\Helpers\AuthHelper::checkRolePermission($role, $permission->name)) ? 'checked' : '' }}>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-md btn-primary">{{ __('global-message.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
