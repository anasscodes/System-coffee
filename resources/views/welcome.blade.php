<x-app-layout>
   <h1>مرحبا</h1>
  {!! QrCode::size(200)->generate('Hello Anas') !!}


</x-app-layout>
