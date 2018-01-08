<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Resto | @yield('title')</title>
  </head>
  <script type="text/javascript" src="{!!asset('public/js/jquery.js')!!}"></script>
  <meta http-equiv="Cache-Control" content="no-store" />
  <link rel="stylesheet" href="{!!asset('public/css/public.css')!!}">
  <link rel="stylesheet" href="{!!asset('public/css/sweetalert.css')!!}">
  <script type="text/javascript" src="{!!asset('public/js/sweetalert.min.js')!!}"></script>
  <script type="text/javascript" src="{!!asset('public/js/public.js')!!}"></script>
  @section('lib')
    @show
  <body>
    <center><div id="load"></div></center>
    @section('popup')
      @show
    <header>
      <aside>
        <label class="judul">My Resto</label>
      </aside>
      <aside>
          <button class="brick logout prosesbtn sign animasi" id="out" onclick="log_out()" name="out" type="button">LOG OUT</button>
      </aside>
    </header>
    {{-- left sidebar menu --}}
    <div class="wrapcontent">
      <div id="slidesidebar" class="animasi" onclick="showslidesidebar()">
        <div class="rightarrow arrow"></div>
      </div>
      <div id="leftsb_menu" class="animasi">
        <div class="list-akun">
          <table class="log-akun">
            <tr>
              <td rowspan=2 width=30%>
                <img id="fotoicon" src="{{$_SESSION["icon"]}}" width=60px height=60px>
              </td>
              <td>
                  {{$_SESSION["nip"]}}
              </td>
            </tr>
            <tr>
              <td>
                {{$_SESSION["nama"]}}
              </td>
            </tr>
          </table>
        </div>
        @section('child')
        @show

      </div>
      {{-- left sidebar btn --}}
      {{-- content --}}
      <div id="content">
        @section('content')

          @show
      </div>
    </div>
  </body>
  <script type="text/javascript">
    document.getElementById("content").onclick= function(){
      $("#leftsb_menu").removeClass("showsidebar");
      $("#slidesidebar").removeClass("leftslide");
      $("#slidesidebar div").removeClass("rotatearrow");
    }
  </script>
</html>
