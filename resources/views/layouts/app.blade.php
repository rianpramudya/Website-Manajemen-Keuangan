<!DOCTYPE html>
<html lang="id">
<head><x-document-head /></head>
<body data-ui-user="{{ auth()->id() }}">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:btn">Langsung ke konten</a>
    @include('layouts.navigation')
    <x-toast />
    <main id="main-content">@isset($header)<div class="page">{{ $header }}</div>@endisset{{ $slot }}</main>
    <footer class="footer">Dompet Rantau · Catatan kecil untuk rencana besar.</footer>
</body>
</html>
