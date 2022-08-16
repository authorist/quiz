<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$header}} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts                   js in defer ini sildim  ççünkü js kodum çalışmıyordu-->
        <script src="{{ mix('js/app.js') }}"      ></script>  
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                       {{ $header }}           <!-- {{ __('Dashboard') }} -->
                    </h2>
                       
                    </div>
                </header>
            @endif
            

            <!-- Page Content -->
        <main>
            <div class="py-6">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

 <!-- //hata meşaj kodunu her blade de değilde burada app blade içinde tanımladık böylece kod tekrarını önlemiş olacak -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)                  
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </div>    
                                    @endif 

<!-- //bu withSuccess('Merhaba') ile yazdıgımız meşajları ekrana basması için oluşturduk not with den sonra yazılanlar değişken değil session olarak geçer onun için veriyi $ değişkeni lle tanımlamıyoruz-->
<!-- 
                                    @isset($success)
                                        <div class="alert alert-success">
                                            {{$success}}
                                        </div>
                                    @endif
 -->

                                @if(session('success'))
                                <div class="alert alert-success">
                                    <i class="fa fa-check"></i>
                                    {{session('success')}}
                                </div>
                                @endif

                {{ $slot }}   
                                <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    <x-jet-welcome />
                                </div> -->
                              
                </div>
             </div>  
            </main>

        </div>

        @stack('modals')

                @isset($js)    <!--         isset kullanmamızın sebebi sayfalar arası geçiş yaptığımızda veya js in isset oldugu durunmda laravel js değişkeinini bulamıyor onun için kullandık -->
                    {{$js}}         <!--   =>  quiz  create.blade.php de enalta x slotun içine bir js kodu yazdık -->
                @endif    

        @livewireScripts
    </body>
</html>
