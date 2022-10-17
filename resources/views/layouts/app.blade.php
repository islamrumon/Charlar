<!DOCTYPE html>
<html lang="htmlLang()">

<head>

    <title>{{ getSystemSetting('type_name') }} | {{ getSystemSetting('cms_title') }} - @yield('title') </title>
    @include('layouts.include.head')
    @include('layouts.include.style')
</head>

<body>

    @yield('main-content')

    @include('layouts.include.script')

    @include('layouts.include.pnotify')
    @include('layouts.include.model')
    @include('layouts.include.delete')
</body>

</html>
