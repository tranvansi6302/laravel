 @props(['messages'])

 @if ($messages)
     @foreach ((array) $messages as $message)
         <p class="px-4 py-3 rounded-md mb-4 bg-red-200 text-gray-900 border border-red-300">Email hoặc mật khẩu chưa
             chính xác</p>
     @endforeach
 @endif
