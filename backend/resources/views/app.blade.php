<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
</head>
<body>
    <!-- Your application content -->
    <div id="app"></div>
    <!-- Include your Vue.js application -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
