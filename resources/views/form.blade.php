<!-- resources/views/form.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- Tambahkan Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .toast-bottom-left {
            bottom: 12px;
            left: 12px;
        }

        .toast-custom {
            background-color: #1a202c;
            color: #fff;
        }
    </style>
</head>

<body>
    <div>
        @if (session('success'))
            <script>
                window.onload = function() {
                    toastr.success("{{ session('success') }}", null, {
                        positionClass: 'toast-bottom-left',
                        progressBar: true,
                        closeButton: true,
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        timeOut: 5000,
                        extendedTimeOut: 2000
                    }).addClass('toast-custom');
                }
            </script>
        @endif

        <form action="{{ route('form.submit', ['page' => $page]) }}" method="POST">
            @csrf
            <div>
                <label for="answer">{{ $question }}</label>
                <input type="text" id="answer" name="answer" value="{{ old('answer') }}">
                @error('answer')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Kirim</button>
        </form>
    </div>

    <!-- Tambahkan Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
