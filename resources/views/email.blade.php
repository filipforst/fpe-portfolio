<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
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

   
    <div class="velikost">
       <h6>NAPIŠ MI</h6>
   
       <input type="text" name="" id="email" placeholder="ZDE ZADEJ SVŮJ EMAIL.."><br>
       <textarea name="" id="zprava" placeholder="ZDE NAPIŠ ZPRÁVU..."></textarea><br>
       
       <div id="tlacitko"><button type="submit">Odeslat</button></div>
       
   </div>
    
</body>
</html>