<x-app-layout>
    <h1>Dashboard</h1>
    <h3>Allocated House <span>({{ count(auth()->user()->ddHouse) }})</span></h3>

{{--    {{ phpinfo() }}--}}
{{--    @php--}}
{{--        $currentUser = auth()->user()->ddHouse;--}}
{{--        foreach ($currentUser as $user){--}}
{{--            echo '<pre>';--}}
{{--            print_r($user->id);--}}
{{--            echo '</pre>';--}}
{{--        }--}}
{{--    @endphp--}}
</x-app-layout>
