@if ($errors->any())
<div class="alert alert-error">
    Error dalam memasukan nilai input
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
@if (session('info'))
<div class="alert alert-info">
    {{session('info')}}
</div>
@endif
<style>
    .alert {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .alert-error {
        background: #B40404;
        color: #fff;
    }

    .alert-success {
        background: #298A08;
        color: #fff;
    }

    .alert-info {
        background: #088A85;
        color: #fff;
    }

    .alert-warning {
        background: #AEB404;
        color: #fff;
    }
</style>
