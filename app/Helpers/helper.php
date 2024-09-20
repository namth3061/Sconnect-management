<?php
function removeSession($session)
{
    if (\Session::has($session)) {
        \Session::forget($session);
    }
    return true;
}

function randomString($length, $type = 'token')
{
    if ($type == 'password')
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    elseif ($type == 'username')
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    else
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr(str_shuffle($chars), 0, $length);
    return $token;
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if ($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function checkRecordExist($table_list, $column_name, $id)
{
    if (count($table_list) > 0) {
        foreach ($table_list as $table) {
            $check_data = \DB::table($table)->where($column_name, $id)->count();
            if ($check_data > 0) return false;
        }
        return true;
    }
    return true;
}

// Model file save to storage by spatie media library
function storeMediaFile($model, $file, $name)
{
    if ($file) {
        $model->clearMediaCollection($name);
        if (is_array($file)) {
            foreach ($file as $key => $value) {
                $model->addMedia($value)->toMediaCollection($name);
            }
        } else {
            $model->addMedia($file)->toMediaCollection($name);
        }
    }
    return true;
}

// Model file get by storage by spatie media library
function getSingleMedia($model, $collection = 'image_icon', $skip = true, $type = '')
{
    if (!\Session::has('accessToken') && $skip) {
        return asset('images/avatars/01.png');
    }

    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }

    $imgurl = isset($media) ? $media->getPath() : '';

    if (file_exists($imgurl)) {
        return replaceFullUrlFile($media, $type);
    } else {
        switch ($collection) {
            case 'image_icon':
                $media = asset('images/icons/01.png');
                break;
            case 'profile_image':
                $media = asset('images/avatars/01.png');
                break;
            default:
                $media = asset('images/common/add.png');
                break;
        }

        return $media;
    }
}

function getMultipleMedia($model, $collection, $skip = true, $type = ''): array|string
{
    $medias = [];
    $paths = [];

    if (!\Session::has('accessToken') && $skip) {
        return asset('images/avatars/01.png');
    }

    if ($model !== null) {
        $medias = $model->getMedia($collection);
    }

    foreach ($medias as $media) {
        $imgUrl = isset($media) ? $media->getPath() : '';
        $paths = file_exists($imgUrl) ? array_merge($paths, [replaceFullUrlFile($media, $type)]) : $paths;
    }

    return $paths;
}

function replaceFullUrlFile($media, $type)
{
    $base_url = config('app.url');

    return str_replace($base_url . '/' . $base_url, $base_url, $media->getFullUrl($type));
}

// File exist check
function getFileExistsCheck($media)
{
    $mediaCondition = false;
    if ($media) {
        if ($media->disk == 'public') {
            $mediaCondition = file_exists($media->getPath());
        } else {
            $mediaCondition = \Storage::disk($media->disk)->exists($media->getPath());
        }
    }
    return $mediaCondition;
}


function tenancy(): ?\App\Models\Tenant
{
    return \App\Models\Tenant::current();
}

function convertToTitleCase($string)
{
    // Replace underscores with spaces
    $string = str_replace('_', ' ', $string);

    // Replace dots with spaces
    $string = str_replace('.', ' ', $string);

    // Capitalize the first letter of each word
    $string = ucwords($string);

    return $string;
}

function convertRoleName($input)
{
    return preg_replace('/([a-z])([A-Z])/', '$1 $2', $input);
}

function htmlSpecial($input): string
{
    return trim(htmlspecialchars($input));
}

function htmlSpecialDecode($input): string
{
    return trim(htmlspecialchars_decode($input));
}

function hasAccessToken(): bool
{
    return \Session::has('accessToken');
}

function checkExpired($time): bool
{
    return $time < \Carbon\Carbon::now()->timestamp;
}

function getToken(): string
{
    return \Session::get('accessToken');
}

function getInfoAuthSession()
{
    if (hasAccessToken()) {
        $authUser = getToken();

        list($header, $payload, $signature) = explode('.', $authUser);

        $payload = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

        return $payload;
    }
}

function isTokenExpired(): bool
{
    $infoAuth = getInfoAuthSession();

    if (! hasAccessToken() || checkExpired($infoAuth['exp'])) {
        \Session::forget('accessToken');

        return true;
    }

    return false;
}

function getAccessToken()
{
    if (isTokenExpired()) {
        return getToken();
    }
}
