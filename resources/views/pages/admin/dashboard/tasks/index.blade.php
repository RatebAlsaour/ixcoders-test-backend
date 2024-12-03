@extends('layouts.admin.dashboard')

@section('content')
    <div class="page-wrapper ">
        <div class="container-fluid">
           
            @include('layouts.message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 justify-between w-full">
                                <h4 class="flex-grow card-title">{{ __('All Tasks') }}</h4>                                
                    <div  class="flex-grow" href="javascript:void(0)">
                        <form>
                        <div class="customize-input">
    <form method="GET" action="{{ route('admin.tasks.index') }}">
        <input 
            name="search-key" 
            value="{{ request('search-key') }}" 
            class="form-control custom-shadow custom-radius border-0 bg-white" 
            type="search" 
            placeholder="Search" 
            aria-label="Search"
            onkeydown="handleEnterKey(event)">
        <!-- Optional: A hidden button for improved accessibility -->
        <button type="submit" style="display: none;"></button>
    </form>
</div>

<script>
    function handleEnterKey(event) {
    if (event.key === "Enter") {
        event.target.form.submit(); 
    }
}

</script>

                        </form>
</div>

                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap v-middle mb-0">
                                    <thead>
                                        <tr class="border-0">
                                            <th class="border-0 font-14 font-weight-medium text-muted">{{ __('Description') }}
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted px-2">{{ __('Title') }}
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted">{{ __('Status') }}</th>
                                            <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                {{ __('Status') }}
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                {{ __('User') }}
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <!-- <div class="mr-3"><img
                                                                src="{{ asset('assets/images/users/avatar.png') }}"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div> -->
                                                        <div class="">
                                                           
                                                            <span class="text-muted font-14">{{ $task->description }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $task->title }}</td>
                                                <td class="border-top-0 px-2 py-4">{{ $task->status }}</td>
                                                <td class="border-top-0 text-center px-2 py-4">
                                                    <i class="fa fa-circle font-12 @if($task->status == 'completed') text-success @else text-danger @endif" data-toggle="tooltip"
                                                        data-placement="top" title="@if($task->status == 'completed') Active @else Inactive @endif"></i></td>
                                                <td
                                                    class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                    {{ $task->user->first_name }}
                                                </td>
            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
