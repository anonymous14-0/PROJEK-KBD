<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Account information") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        {{-- NAME --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input 
                id="name" 
                type="text" 
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" 
                :value="$user->nama_lengkap" 
                disabled 
            />
        </div>

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                type="email" 
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" 
                :value="$user->email" 
                disabled 
            />
        </div>
    </div>
</section>