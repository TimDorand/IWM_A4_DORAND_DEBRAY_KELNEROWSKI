{{--<style>
    .alertcustom {
        position: absolute;
        z-index: 100;
        width: 100%;
    }
</style>--}}
{{--
<script>jQuery(window).load(function () {
        $('.alertcustom').delay(10000).fadeOut("2000");
    });
</script>--}}

<br>
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="notification is-{{$msg}}">
            {!!  Session::get('alert-' . $msg)  !!}
        </div>
    @endif
@endforeach

@if(isset($success))
    @if($success = Session::get('success'))
        <div class="alertcustom alert alert-success">
            <div class="container">
                {{ $success}}
            </div>
        </div>
    @endif
@endif

@if (count($errors) > 0)
    <div class="alertcustom alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (isset($custom_error))
    <div class="alertcustom alert alert-danger">
        {{$custom_error}}
    </div>
@endif

@if(isset($errors))
    @if($errors = Session::get('custom_errors'))
        <div class="alertcustom alert alert-danger">
            <div class="container">
                ERREUR ! {{ $errors}}
            </div>
        </div>
    @endif
@endif