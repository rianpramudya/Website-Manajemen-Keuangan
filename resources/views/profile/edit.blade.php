<x-app-layout>
    <div class="min-h-screen bg-slate-50 pb-20 font-sans relative overflow-x-hidden">
        
        <!-- Dekorasi Latar Belakang (Konsisten dengan Dashboard) -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-indigo-100/50 to-transparent -z-10 pointer-events-none"></div>
        <div class="absolute top-[-100px] right-[-100px] w-96 h-96 bg-purple-200/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-[200px] left-[-100px] w-80 h-80 bg-amber-100/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Header -->
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pengaturan Akun ⚙️</h2>
                <p class="text-slate-500 mt-2 font-medium">Kelola profil, keamanan, dan preferensi akunmu.</p>
            </div>

            <div class="space-y-8">
                
                <!-- Update Profile Information -->
                <div class="p-8 bg-white shadow-lg shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[3rem] -mr-6 -mt-6 opacity-50"></div>
                    <div class="relative z-10 max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="p-8 bg-white shadow-lg shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[3rem] -mr-6 -mt-6 opacity-50"></div>
                    <div class="relative z-10 max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User -->
                <div class="p-8 bg-white shadow-lg shadow-slate-200/50 rounded-[2.5rem] border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[3rem] -mr-6 -mt-6 opacity-50"></div>
                    <div class="relative z-10 max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>