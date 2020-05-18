<nav class="navbar navbar-expand-md navbar-light">   
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="logo"><img src="/storage/ztp.svg" height="50" alt="ZetaTechPro"></div>
        </a>
        @guest
        @if(!Request::route()->named('brand'))
           <div style="margin-left:-600px;padding:5px;border: 1px solid black;"><a href="https://zetatechpro.ru/brand" style="color:black"><img src="/storage/medal.svg" alt="">О проекте</a></div>
               
        @endif
        
         
        @endguest 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--        <a href="tel:88002012342 " class="phone">8 800 201-23-42 <span--}}
        {{--                    class="phone-title">Звонки для регионов бесплатно</span></a>--}}
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @yield('menu')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    

                   <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    </li>-->
                  

                    @if (Route::has('register'))
                        <!--<li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>-->
                       
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <!--{{ __('Logout') }}-->Выйти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@permission('update-project')
    <main>

        <div class="home">
            <h1>Проектные решения</h1>
            <div class="links">
                <a href="{{route('catalog')}}" class="btn inverse"><img src="/storage/cart.svg" alt="">Каталог</a>
                <a href="{{route('projects')}}"
                   class="btn inverse"><img src="/storage/money.svg" alt="">
                    Проекты
                </a>
                @permission('confirm-users')
                <a href="{{route('unconfirmed_users')}}"
                   class="btn inverse">
                    <v-icon>mdi-account-cog</v-icon>
                    Новые <br> пользователи
                </a>
                @endpermission
                <br>
                <!-- <a href="/storage/price.xlsx" class="btn"><img src="/storage/price.svg" alt="">Прайс</a> -->
                @if(Request::route()->page=='brand')
                    <div class="btn active"><img src="/storage/medal.svg" alt="">О проекте</div>
                @else
                    <a href="{{route('info',['page'=>'brand'])}}" class="btn">
                        <img src="/storage/medal.svg" alt="">О проекте
                    </a>
                @endif

                @if(Request::route()->page=='contacts') 
                    <div class="btn active"><img src="/storage/bank.svg" alt="">Контакты</div>
                @else
                    <a href="{{route('info',['page'=>'contacts'])}}" class="btn">
                        <img src="/storage/bank.svg" alt="">Контакты
                    </a>
                @endif

                @if(Request::route()->page=='sertificate')
                    <div class="btn active"><img src="/storage/convert.svg" alt="">Документация</div>
                @else
                    <a href="{{route('info',['page'=>'sertificate'])}}" class="btn">
                        <img src="/storage/convert.svg" alt="">Документация
                    </a>
                @endif

                @if(Request::route()->page=='bonus')
                    <div class="btn active">
                        <img src="/storage/bonus.svg" alt="">
                        Бонусная <br>программа
                    </div>
                @else
                    <a href="{{route('info',['page'=>'bonus'])}}" class="btn">
                        <img src="/storage/bonus.svg" alt="">
                        Бонусная <br>программа
                    </a>
                @endif

                <a href="/storage/ztp_cat.pdf" target="_blank" class="btn"><img src="/storage/download.svg" alt="">Скачать
                    каталог<br> Проектные решения</a>
                    
                <a href="/storage/zetamuft.pdf" target="_blank" class="btn"><img src="/storage/download.svg" alt="">Скачать каталог Муфт</a>

            </div>
            <div class="dekor1"><img src="/storage/main_logo.png" alt=""></div>
            <div class="dekor2"></div>
        </div>

    </main>
@endpermission
