<h1>Home Page</h1>
{{-- Hiển thị dưới dạng thực thể --}}
<h2>{{$welcome}}</h2>
{{-- Hiển thị dưới dạng html dùng !! --}}

<hr>
{{-- Vòng lặp i --}}
@for ($i=1;$i<=10;$i++)
    <p>Phần tử thứ {{$i}}</p>
@endfor

{{-- Vòng lặp while --}}
@php
    $index=0;
@endphp
@while ($index)
{{-- Thay thế cho <?php ?> --}}
@php
    $index++;
@endphp
@endwhile

{{-- Foreach --}}
@foreach ($dataArr as $item)
    <p>{{$item}}</p>
@endforeach

{{-- Phiên bản nâng cấp foreach --}}
@forelse ($dataArr as $item)
    <p>{{$item}}</p>
@empty
    <p>Không có gì</p>
@endforelse

{{-- if --}}
@if (true)
    
@endif
{{-- if else --}}
@if (true)
    
@else
    
@endif

{{-- if elseif --}}
@if (true)
    
@elseif (false)

@endif

{{-- swich case --}}
@switch(true)
    @case(1)
        @break
    @case(2)
        
        @break
    @default
        
@endswitch

{{-- Không muốn biên dịch một biến @{{name}} --}}

{{-- Không muốn biên dịch một khối mã --}}
@verbatim
    
@endverbatim

{{-- include có thể nhận dữ liệu từ path cha--}}
@include('parts.notice')