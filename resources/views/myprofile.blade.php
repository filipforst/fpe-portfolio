<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myprofile.css') }}">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <h1>Portfolio</h1>

    <div id="menu" class="col-12 row" >

       <div id="menu_left">
             <a href="{{ route('index') }}">
                 <i class="bi bi-house-door-fill"></i>
             </a>
         </div>


        <div id="menu_right">
             <a href="{{ route('myinformation') }}">
                <i class="bi bi-person-fill"></i>
            </a>
        </div>

    </div>


    <div class="container text-center">
        <div class="row">
          <div class="col col-lg-4">
              <img src="{{ asset("img/profil_foto.JPG") }}" alt="" id="profil_foto">
          </div>
          <div class="col col-lg-8 position-relative">
             <form id="udaje" action="/zmenaOsobnichInformaci" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Jméno" value="{{$informace->name}}" ><br>
                <input name="email" type="email" placeholder="Email" value="{{$informace->email}}" ><br>
                <input name="date" type="email" placeholder="Deb vytvoření" value="{{$informace->created_at}}" readonly><br>
                <div><input class="tlacitko" type="submit" id="" name="" value="Odeslat"></div>
                
                <a href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                </a>
               
             </form>
          </div>
        </div>


        <div class="row">
            <form id="nahrani" action="/uploadFotografie" method="POST" enctype="multipart/form-data">
                @csrf
                <input  type="file" name="img">
                <input class="tlacitko2" type="submit" name="submit">
            </form>
        </div>



        <div class="row">
            @foreach($obrazks as $obrazk)
            <div class="col-4">
            <a href="{{ asset("images/{$obrazk->nazev_obrazku}") }}"><img src="{{ asset("images/{$obrazk->nazev_obrazku}") }}" alt=""></a>
            </div>
            @endforeach
          </div>
        </div>

    



</body>
</html>
