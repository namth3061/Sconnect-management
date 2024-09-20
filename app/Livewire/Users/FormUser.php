<?php

namespace App\Livewire\Users;

use App\View\Components\Form\Select;
use App\View\Components\Form\TextInput;
use App\Enums\UserStatus;
use App\Services\RoleService;
use App\Services\TenantService;
use App\View\Components\Form\UploadFile;

class FormUser
{
    public array $roles;
    public array $tenants;

    public RoleService $roleService;
    public TenantService $tenantService;

    public function uploadFile($setRule = false, $user = null): array
    {
        return [
            UploadFile::make('user_image')
                ->type('file')
                ->className('file-upload invisible')
                ->hasId('user_image')
                ->isImage()
                ->accept('image/*')
                ->setRule($setRule),
        ];
    }

    public function addUser($setRule = false, $user = null): array
    {
        return [
            Select::make('tenant_id')
                ->label(__('users.form.label.tenant'))
                ->className('select2-component form-control')
                ->urlSelect(route('system.get_tenant'))
                ->placeholder(__('users.form.format.select_tenant'))
                ->required()
                ->setRule($setRule),
            Select::make('status')
                ->label(__('users.form.label.status_form'))
                ->options($this->getStatus())
                ->className('select2-component form-control')
                ->placeholder(__('users.form.format.select_status'))
                ->required()
                ->setRule($setRule),
            Select::make('user_type')
                ->label(__('users.form.label.user_role'))
                ->className('select2-component form-control')
                ->urlSelect(route('system.get_role'))
                ->placeholder(__('users.form.format.select_role'))
                ->required()
                ->setRule($setRule),
            TextInput::make('facebook_url')
                ->label(__('users.form.label.facebook_url'))
                ->className('form-control')
                ->placeholder(__('users.form.placeholder.facebook_url'))
                ->isUrl()
                ->default($user->userProfile->facebook_url ?? '')
                ->setRule($setRule),
            TextInput::make('twitter_url')
                ->label('Twitter Url:')
                ->className('form-control')
                ->placeholder(__('users.form.placeholder.twitter_url'))
                ->isUrl()
                ->default($user->userProfile->twitter_url ?? '')
                ->setRule($setRule),
            TextInput::make('instagram_url')
                ->label(__('users.form.label.instagram_url'))
                ->className('form-control')
                ->placeholder(__('users.form.placeholder.instagram_url'))
                ->isUrl()
                ->default($user->userProfile->instagram_url ?? '')
                ->setRule($setRule),
            TextInput::make('linkedin_url')
                ->label(__('users.form.label.linkedin_url'))
                ->className('form-control')
                ->placeholder(__('users.form.placeholder.linkedin_url'))
                ->isUrl()
                ->default($user->userProfile->linkedin_url ?? '')
                ->setRule($setRule),
        ];
    }

    public function information($setRule = false, $user = null): array
    {
        return [
            TextInput::make('first_name')
                ->label(__('users.form.label.first_name'))
                ->className('form-control')
                ->hasId('fname')
                ->placeholder(__('users.form.placeholder.first_name'))
                ->required()
                ->default($user->first_name ?? '')
                ->maxLength('255')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('last_name')
                ->label(__('users.form.label.last_name'))
                ->className('form-control')
                ->hasId('lname')
                ->placeholder(__('users.form.placeholder.last_name'))
                ->required()
                ->maxLength('255')
                ->default($user->last_name ?? '')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('street_addr_1')
                ->label(__('users.form.label.streetAddress1'))
                ->className('form-control')
                ->hasId('add1')
                ->placeholder(__('users.form.placeholder.streetAddress1'))
                ->default($user->userProfile->street_addr_1 ?? '')
                ->maxLength('255')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('street_addr_2')
                ->label(__('users.form.label.streetAddress2'))
                ->className('form-control')
                ->hasId('add2')
                ->placeholder(__('users.form.placeholder.streetAddress2'))
                ->default($user->userProfile->street_addr_2 ?? '')
                ->maxLength('255')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('company_name')
                ->label(__('users.form.label.company_name'))
                ->className('form-control')
                ->hasId('cname')
                ->placeholder(__('users.form.placeholder.company_name'))
                ->default($user->userProfile->company_name ?? '')
                ->maxLength('255')
                ->required()
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('country')
                ->label(__('users.form.label.country_name'))
                ->className('form-control')
                ->hasId('country')
                ->placeholder(__('users.form.placeholder.country_name'))
                ->default($user->userProfile->country ?? '')
                ->maxLength('255')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('phone_number')
                ->label(__('users.form.label.mobile_number'))
                ->className('form-control')
                ->hasId('mobno')
                ->placeholder(__('users.form.placeholder.mobile_number'))
                ->default($user->phone_number ?? '')
                ->minLength('10')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('alt_phone_number')
                ->label(__('users.form.label.alternate_contact'))
                ->className('form-control')
                ->hasId('altconno')
                ->placeholder(__('users.form.placeholder.alternate_contact'))
                ->default($user->userProfile->alt_phone_number ?? '')
                ->minLength('10')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('email')
                ->type('email')
                ->label(__('users.form.label.email'))
                ->className('form-control')
                ->hasId('email')
                ->placeholder(__('users.form.placeholder.e_mail'))
                ->default($user->email ?? '')
                ->required()
                ->unique(isset($user->email) ? 'users,email,' . $user->id : 'users')
                ->maxLength('255')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('identification_number')
                ->type('identification_number')
                ->label(__('users.form.label.identification_number'))
                ->className('form-control')
                ->default($user->userProfile->identification_number ?? '')
                ->maxLength('255')
                ->hasId('identification_number')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('city')
                ->type('city')
                ->label(__('users.form.label.town_city'))
                ->className('form-control')
                ->default($user->userProfile->city ?? '')
                ->maxLength('255')
                ->hasId('city')
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('state')
                ->type('state')
                ->label(__('users.form.label.state'))
                ->className('form-control')
                ->default($user->userProfile->state ?? '')
                ->maxLength('255')
                ->hasId('state')
                ->col('col-md-6')
                ->setRule($setRule),
        ];
    }

    public function security($setRule = false, $user = null): array
    {
        return [
            TextInput::make('username')
                ->label(__('users.form.label.username'))
                ->className('form-control')
                ->placeholder(__('users.form.placeholder.username'))
                ->default($user->username ?? '')
                ->required()
                ->maxLength('255')
                ->unique(isset($user->username) ? 'users,username,' . $user->id : 'users')
                ->col('col-md-12')
                ->setRule($setRule),
            TextInput::make('password')
                ->type('password')
                ->label(__('users.form.label.password'))
                ->className('form-control')
                ->maxLength('255')
                ->placeholder(__('users.form.placeholder.password'))
                ->required(!isset($user->password))
                ->col('col-md-6')
                ->setRule($setRule),
            TextInput::make('password_confirmation')
                ->type('password')
                ->label(__('users.form.label.repeat_password'))
                ->className('form-control')
                ->maxLength('255')
                ->hasId('rpass')
                ->placeholder(__('users.form.placeholder.repeat_password'))
                ->required(!isset($user->password))
                ->col('col-md-6')
                ->setRule($setRule)
        ];
    }

    public function getStatus(): array
    {
        return [
            [
                'value' => UserStatus::ACTIVE,
                'text' => __('users.form.format.active'),
            ],
            [
                'value' => UserStatus::PENDING,
                'text' => __('users.form.format.pending'),
            ],
            [
                'value' => UserStatus::BANNED,
                'text' => __('users.form.format.banned'),
            ],
            [
                'value' => UserStatus::INACTIVE,
                'text' => __('users.form.format.inactive'),
            ],
        ];
    }
}
