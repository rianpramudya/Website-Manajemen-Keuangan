<!DOCTYPE html>
<html lang="id">
<head><x-document-head /></head>
<body>
    <a href="#main-content" class="sr-only focus:not-sr-only focus:btn">Langsung ke konten</a>
    @include('layouts.navigation')
    <x-toast />
    <main id="main-content" class="auth-shell"><div class="panel stack" data-reveal>{{ $slot }}</div></main>
    <footer class="footer">Dompet Rantau · Satu catatan, selangkah lebih teratur.</footer>
</body>
</html>
