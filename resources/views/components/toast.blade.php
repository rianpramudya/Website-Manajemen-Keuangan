@if(session('success') || session('error'))
<div class="toast {{ session('error') ? 'toast-error' : 'toast-success' }}" role="{{ session('error') ? 'alert' : 'status' }}" data-toast data-success="{{ session('success') ? 'true' : 'false' }}">
    <div class="flex items-start gap-3">
        @if(session('success'))<svg class="check-draw w-6 h-6 text-success shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="m4 12 5 5L20 6" stroke-width="2" /></svg>@else<x-icon name="warning-circle" class="text-danger text-2xl" />@endif
        <p class="flex-1">{{ session('error') ?? session('success') }}</p>
        <x-button variant="tertiary" icon="x" data-dismiss-toast aria-label="Tutup pemberitahuan" />
    </div>
</div>
@endif
@if($errors->any())
<div class="page" role="alert"><div class="panel border-danger"><h2 class="text-danger">Periksa kembali isianmu</h2><ul class="mt-3 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
@endif
