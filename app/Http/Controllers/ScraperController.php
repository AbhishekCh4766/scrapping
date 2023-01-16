<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Goutte;
// use GuzzleHttp\Client as GuzzleClient;
// use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Http;

class ScraperController extends Controller
{
    public function index($data)
    {
        // $client = new Client();

        $client = new Client(HttpClient::create(['timeout' => 60]));
// or 
// $guzzleClient = new GuzzleClient(['timeout' => 60, 'verify' => false]); // pass this to Goutte Client
        // $guzzleClient = new GuzzleClient(array(
        //     'timeout' => 60,
        // ));

        // $guzzleClient->setClient($client);

        // $crawler = $guzzleClient->request(method:'GET', url:'https://www.q84sale.com/en/sub/99/1/');
         
        // $crawler->filter()->each(function($node){
        //     dump($node->text());
        // });

        $crawler = $client->request('GET', 'https://duckduckgo.com/html/?q=Laravel');
        $crawler->filter('.result__title .result__a')->each(function ($node) {
            dump($node->text());
        });


        
        // $website = $client->request('GET', 'https://www.q84sale.com/en/sub/99/1/mobile-phones');
        // // return json_encode($website);
        // dump($website);
        //  echo $data;
       // $companies = $website->filter($data)->each(function ($node) {
           
            // dump($node);
           // return $website;
        // });
        

   }


   public function doWebScraping()
   {
    //    $goutteClient = new Client();
    //    $guzzleClient = new GuzzleClient(array(
    //        'timeout' => 60,
    //        'verify' => false
    //    ));
    //    $goutteClient->setClient($guzzleClient);
    $client = new Client(HttpClient::create(['timeout' => 60]));
    //    $crawler = $client->request('GET', 'https://duckduckgo.com/html/?q=Laravel');
       $crawler = $client->request('GET', 'https://www.q84sale.com/en/sub/99/1/mobile-phones');
       $crawler->filter('a .DefaultCard_link__2CnVJ')->each(function ($node) {
           dump($node->text());
       });
   }

   public function getScrap(){

    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://www.q84sale.com/en/sub/99/1/mobile-phones');
    $response = $request->collect();
   
    return $response;



    $response = Http::get('https://www.q84sale.com/en/sub/99/1/mobile-phones/iphone?c=2285');

        // $response->body();
        // $response->json();
        // $response->object();
        // $response->collect($key = null);
        // $response->status();
        // $response->ok();
        // $response->successful();
        // $response->redirect();
        // $response->failed();
        // $response->serverError();
        // $response->clientError();
        // // $response->header($header = null);
        // $response->headers();

        return $response->body();
   }

   public function getcust(){
    $crawler = Goutte::request('GET', 'https://www.q84sale.com/en/sub/99/1/mobile-phones/');

    
    // $image = $crawler->selectImage('ايفون 14 بروماكس 512 مستعمل')->image();
    // print_r($image);
    $crawler->filter('.site-wrapper .styles_container__m1Y59 .col-lg-9 .styles_listings_wrapper__rL63C')->each(function ($node) {
        // echo "<pre>";
    //   print_r($node->text());
    $data = $node->children();
        print_r($node->children());
    //    print_r('ايفون 14 بروماكس 512 مستعمل')

    // $data = $node->getResponse()->getContent();

    //  print_r($data);

    
    echo "----------------------------------------------------";
      print_r($node->text());
        
      //print_r(explode('amplitudeFiltersProperties',$ufdata->children()));

      //$jsonData = eval($ufdata);
      echo "--";
    //    print_r($ufdata);
      echo "--";
     
    });
    

    
   }

    public function getHtml($var = null)
   {
    $siteData = '';
    $crawler = Goutte::request('GET', 'https://www.q84sale.com/en/sub/99/1/mobile-phones/');

    $crawler->filter('.site-wrapper ')->each(function ($node) {
        // print_r($node->text());
        $object = json_encode($node->children()->each(function ($product) {
            return $product->text();
        }));
    
        $encData = json_decode($object);
        //print_r($encData);
       $siteData = json_encode($encData[2]);

       $encData = json_decode($siteData);
       echo "-----------------------------------------------------";
       echo "</pre>";
        // print_r(json_decode($encData));

       $arrayData = get_object_vars(json_decode($encData));
       
       echo "---------------------------------------------------PPPPPPPPPPPP--";

   
       $pageProps = get_object_vars($arrayData['props']);

       //print_r($pageProps);
       //print_r(json_encode((array)$pageProps['pageProps']->_nextI18Next->initialI18nStore->en) );
       $lsitings =json_decode( json_encode((array)$pageProps['pageProps']->listings));
       //print_r(json_encode((array)$pageProps['pageProps']->listings) );

       foreach($lsitings as $i=> $list){
        echo "-----------".$i."----------";
        echo $list->title;
       }

    });

    // $crawler->filter('.site-wrapper ')->each(function ($node) {
    //     // print_r($node->text());
    //     $object = json_encode($node->children()->each(function ($product) {
    //         return $product->children();
    //     }));
    
    //     print_r(json_decode($object));
    // });

    // print_r($object);

   }

}
