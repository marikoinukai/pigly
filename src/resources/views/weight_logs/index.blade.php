<h1>体重管理画面</h1>

<ul>
@foreach($logs as $log)
<li>{{ $log->date }}：{{ $log->weight }}kg（{{ $log->calories }}kcal）</li>
@endforeach
</ul>