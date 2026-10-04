@php
    preg_match_all('/(--[a-z-]+):\s*([^;]+);/', file_get_contents(resource_path('css/app.css')), $matches, PREG_SET_ORDER);
    $tokens = [];
    foreach ($matches as $match) {
        $tokens['var('.$match[1].')'] = trim($match[2]);
    }
    $printStyles = strtr(file_get_contents(resource_path('css/report-pdf.css')), $tokens);
@endphp
<style>{{ $printStyles }}</style>
