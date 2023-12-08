<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Illuminate\Http\Request;

class UrunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urunler = Urun::Paginate(5);

        return view("urunler",compact("urunler"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "urunad" => "required|min:5",
            "urundetay" => "required",
            "urunfiyat" => "required"
        ]);

        Urun::create($request->All());

        return redirect()->back()->with("olumlu","Ürün başarıyla eklendi");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Urun $urun)
    {
        return view("edit", compact("urun"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Urun $urun)
    {
        $request->validate([
            "urunad" => "required|min:5",
            "urundetay" => "required",
            "urunfiyat" => "required"
        ]);

        $urun->urunad = $request->urunad;
        $urun->urundetay = $request->urundetay;
        $urun->urunfiyat = $request->urunfiyat;

        $urun->save();
        return redirect()->back()->with("olumlu","Ürün başarıyla güncellendi");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Urun $urun)
    {
        try {
            // Ürünü veritabanından sil
            $urun->delete();
    
            // Başarıyla silindiğine dair bir mesaj gönder
            return redirect()->back()->with("olumlu","Ürün başarıyla silindi.");
        } catch (\Exception $e) {
            // Hata durumunda bir mesaj döndür
            return redirect()->back()->with("olumlu","Ürün silinirken bir hata oluştu");
        }
    }
}
