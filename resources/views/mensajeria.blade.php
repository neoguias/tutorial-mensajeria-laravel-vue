<x-vue-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mensajería') }}
        </h2>
    </x-slot>
    <app :user="{{ auth()->user() }}"></app>
</x-vue-layout>