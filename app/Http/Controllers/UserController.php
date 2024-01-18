<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    public function ReprezentaceUzivatelu()
    {
        $uzivatel = User::All();
        $user = Auth::user();
        $id_uzivatele = $user->id;
        $photos = Image::where('id_uzivatele', $id_uzivatele)->first();
        //dd($photos);
       
        return view('index', ['obrazks' => $photos, 'uzivatele' => $uzivatel]);
    }


    public function UzivatelskyProfil($id)
    {
        $uzivatel = User::Find($id);
        $id_uzivatele = $uzivatel->id;
        $photos = Image::where('id_uzivatele', $id_uzivatele)->get();
        $profilovka = Image::where('id_uzivatele', $id_uzivatele)->first();
        return view('strankaUzivatele', ['obrazks' => $photos,'uzivatel' => $uzivatel,'profilovka' =>  $profilovka]);
    }



    public function MujProfil()
    {
        $user = Auth::user(); 
        $id_uzivatele = $user->id;
        $photos = Image::where('id_uzivatele', $id_uzivatele)->get();
        $profilovka = Image::where('id_uzivatele', $id_uzivatele)->first();
        //$uzivatel = User::Find($id);
        return view('myprofile', ['obrazks' => $photos, 'informace' => $user,'profilovka' =>  $profilovka]);

    }

    public function NahravaniUdaju(Request $request)
    {
        $user = Auth::user();
        $id_uzivatele = $user->id;
        $photos = Image::where('id_uzivatele', $id_uzivatele)->get();

        $jmeno = $request->name;
        $email = $request->email;

        $user->name = $jmeno;
        $user->email = $email;

        $user->save();

        Log::info($request);
        //return view('myprofile', ['obrazks' => $photos,'informace' => $user]);
        return redirect()->route('myinformation');
    }

    public function NahravaniFotek(Request $request)
{
    $user = Auth::user();
    $id_uzivatele = $user->id;
    $photos = Image::where('id_uzivatele', $id_uzivatele)->get();

    if ($request->hasFile('img') && $request->file('img')->isValid()) {
        $validatedData = $request->validate([
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:409200',
        ]);

        $img_type = $request->file('img')->getClientOriginalExtension();
        $img_name = $request->file('img')->getClientOriginalName();

        // Přesunutí souboru na cílovou cestu ve veřejném adresáři
        $request->file('img')->move(public_path('images'), $img_name);
        $img_path = '/images/' . $img_name;

        // Vytvoření nového záznamu v tabulce images pomocí modelu Image
        \App\Models\Image::insert([
            'id_uzivatele' => $user->id, // nebo jakkoliv je pojmenován identifikátor uživatele
            'nazev_obrazku' => $img_name,
        ]);

        Log::info('Obrázek úspěšně nahrán.', ['img_path' => $img_path]);
    } else {
        Log::error('Soubor nebyl úspěšně nahrán.');
    }

   // return view('myprofile', ['obrazks' => $photos,'informace' => $user]);
   return redirect()->route('myinformation');
}

    function saveImage(Request $request){

        Log::info('ContentController:saveImage');

        if($request->img != "") {
            $validatedData = $request->validate([
                'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4092',
            ]);

            $img_type = $request->file('img')->getClientOriginalExtension();
            $img_name = $request->file('img')->getClientOriginalName();
//          $img_path = Carbon::now()->toDateTimeString().'.'.$img_type;
            request()->img->move(public_path('/images'), $img_name);
            $img_name = '/images/'.$img_name;
        }

        $img = new Images;
        $img->url = $img_name;
        $check = $img->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Images!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    public function showPhotos() {
        $user = Auth::user();
        $userId = $user->id;
        $photos = [];

        // Získání seznamu fotografií v /public/images
        $imagePath = public_path('images');
        if (File::exists($imagePath)) {
            $files = File::files($imagePath);

            foreach ($files as $file) {
                $photos[] = ['file_name' => pathinfo($file)['filename']];
            }
        }

        return view('myprofile', ['photos' => $photos]);
    }



}
