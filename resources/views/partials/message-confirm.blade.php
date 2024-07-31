@if (session('message'))
    {{-- //⬅️ qui va il bnome che abbiamo messo nel controller. nel nostro caso é message --}}
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
