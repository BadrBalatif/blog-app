<?php

namespace App\Http\Controllers;

use App\Events\videoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CrudController extends Controller
{
    use OfferTrait;
    //
    public function __construct()
    {
        
    }

    public function getOffers(){
        return Offer::get();
    }
/*
   public function store(){
        Offer::create([
            'name' => 'Offer3',
            'price' => '5000',
            'details' => 'offer details'
        ]);
    } */

    //for view the page in browser
    public function create(){
        return view('offers.create');
    }


    public function store(OfferRequest $request){

        //validate data before insert to DB
         //call the Rules and the Messages
    
      /**
       *   $rules = $this-> getRules();
      *  $messages = $this-> getMessages();
       * $validator = Validator($request->all(),$rules,$messages);

       * if($validator->fails()){
         *   return redirect()->back()->withErrors($validator)->withInputs($request->all());
       * }  
       */

        $file_name = $this -> saveImage($request->photo, 'images/offersImages');

        // for insert data from user to DB .
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'photo' => $file_name,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

  public function getAllOffers(){
  /*return -JSON*/  $offers =  Offer::select('id','price',
                    'name_'.LaravelLocalization::getCurrentLocale().' as name',
                    'details_'.LaravelLocalization::getCurrentLocale(). ' as details')->get();
               return view('offers.all', compact('offers'));
  }


  public function editOffer($offer_id)
  {
 // Offer::findOrFail($offer_id);  //bring id from DB or get error if the id not available
    $offer = Offer::find($offer_id); //give you just the id in the table
          if(!$offer)
              return redirect()->back();
    $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')-> find($offer_id);
       return view('offers.edit',compact('offer'));

  }

  public function updateOffer(OfferRequest $request, $offer_id){
      //vlidation request
      //check if offer exists
      $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')-> find($offer_id);
      if(!$offer)
      return redirect()->back();
     //update data
      $offer->update($request->all());
      return redirect()->back()->with(['success' => 'تم تحديث العرض بنجاح']);

  }


  public function deleteOffer($offer_id)
  {
      $offer = Offer::find($offer_id);
             if(!$offer)
                 return redirect()->back()->with(['error'=> __('messages.offer not exist')]);

      $offer -> delete();
      return redirect()->route('offers.all')->with(['success'=>__('messages.offer deleted successfully')]);
  }
  

 public function getVideo(){
     $video = Video::first();
     event(new videoViewer($video));
     return view('video')->with('video', $video);
 }

}
