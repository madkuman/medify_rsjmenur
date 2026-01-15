<!doctype html>
<html lang="en" class="no-focus">

<head>
    <title>{{ $form->nama_show }} - {{ $kasus->judul_kasus }}</title>
    <style>
        .medify-form-genv4-input-container {
            display: none !important;
        }
    </style>
</head>

<body>
    @includeIf('kasus.asesmen.' . $slug . '.form-template')
</body>

</html>
