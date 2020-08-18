<?php
date_default_timezone_set("Asia/Tehran") ;
	define( "SMS_IN_HOST", "http://sms.api.ir/Api/SendSMS.asmx?WSDL" ) ;
	define( "SMS_NUMBER", "10002000080000" ) ;
	define( "SMS_SIGNATURE", "CC5AE093-2A45-4139-857E-E470CE7CF1C5" ) ;
	define( "SMS_IN_FLASH", false ) ;
        
function send_sms_iran($Mobiles,$textMessage){   
     
    $webServiceURL  = SMS_IN_HOST;  
    $webServiceSignature = SMS_SIGNATURE;  
    $webServiceNumber   = SMS_NUMBER;    
    $isFlash = SMS_IN_FLASH; // falsh sms => open quick in phone and after close message , cleare from phone ;
    
    //$Mobiles      = array ( "09149110486"); // all mobile add in this array => support one or more
    $textMessage= mb_convert_encoding($textMessage,"UTF-8"); // encoding to utf-8 // OR

     $parameters['signature'] = $webServiceSignature;
     $parameters['from' ]= $webServiceNumber;
     $parameters['to' ]  = $Mobiles;
     $parameters['text' ]=$textMessage;
     $parameters[ 'isFlash'] = $isFlash;
     $parameters['udh' ]= ""; // this is string  empty
     $parameters['success'] = 0x0; // return refrence success count // success count is number of send sms  success
     $parameters[ 'retStr'] = array( 0  ); // return refrence send status and mobile and report code for delivery
      
    try 
    {
        //libxml_disable_entity_loader(false);
        $con = new SoapClient($webServiceURL,array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true, "exception" => 0));  
        $responseSTD = (array) $con ->SendGroupSMS($parameters); 
        $responseSTD['retStr'] = (array) $responseSTD['retStr'];
       
       // return ( $responseSTD['success']==1) ?true : false ;
        //return $responseSTD;



         if( $responseSTD['success']>1)
         {         
              $res = array();
              foreach ($responseSTD['retStr']['string'] as $key => $val)
              {
                   // echo '@';
                   // echo $val;
                    // pattern => mobile;sendstatus;reportId
                   //@09331001391;0;124172151191542323
                   //@09331001391;0;115161825942015958 
                   $res_string = explode(';',$responseSTD['retStr']['string']); 
                   $webServiceRecID =  $res_string['2']; 
                   $res[] = array( 'phone'=>$res_string['0'] , 'status' => get_delivery_sms($webServiceRecID));   
               }
           }
           elseif ( $responseSTD['success']==1)
           {   
             $res_string = explode(';',$responseSTD['retStr']['string']);    
             $webServiceRecID =  $res_string['2']; 
           // var_dump($res_string) ;
            //echo  $webServiceRecID;
             return get_delivery_sms($webServiceRecID);
           }
           else    
           {
              return  $responseSTD;
           }



    }
    catch (SoapFault $ex) 
    {
       echo $ex->faultstring;  
    }  
        
 }
 

 function get_delivery_sms($webServiceRecID)
 {

      $webServiceURL       = SMS_IN_HOST; //آدرس وب سرویس را در این قسمت وارد کنید
      $webServiceSignature = SMS_SIGNATURE; // امضای دیجیتالی خود را در این قسمت وارد کنید
     // $webServiceRecID = ""; // کد رهگیری را وارد کنید

      $parameters  = array( // در این قسمت گزینه های مورد نظر ساخته می شوند برای ارسال
          'signature' => $webServiceSignature,
          'RecID' => $webServiceRecID,
        );
        
        
      try {
        $connectionS = new SoapClient($webServiceURL); // ایجاد یک ارتباط اولیه با وب سرویس
        $responseSTD = (array) $connectionS->GetDelivery($parameters); // ارسال درخواست و گرفتن نتیجه آن ها
        if ( $responseSTD['GetDeliveryResult'] == -1 ) {
          return " امضای وارد شده معتبر نیست";
        //بررسی حابت ها موحود بر روی مقدار خروجی تابع
        } else if ( $responseSTD['GetDeliveryResult'] == 40 ) {
          return " پیامک مورد نظر منتظر تحویل می باشد";
        } else if ( $responseSTD['GetDeliveryResult'] == 41 ) {
          return "پیامک مورد نظر تحویل شد";
        } else if ( $responseSTD['GetDeliveryResult'] == 42 ) {
          return "پیامک مورد نظر تحویل نشد";
        } else if ( $responseSTD['GetDeliveryResult'] == 43 ) {
          return "حطا در مخابرات";
        } else if ( $responseSTD['GetDeliveryResult'] == 44 ) {
          return "پیامک ارسال نشد";
        } else if ( $responseSTD['GetDeliveryResult'] == 45 ) {
          return "خطا";
        } else if ( $responseSTD['GetDeliveryResult'] == 46 ) {
          return "کد رهگیری وارد شده یافت نشد";
        } else if ( $responseSTD['GetDeliveryResult'] == 47 ) {
          return "کدرهگیری وارد شده معتبر نیست";
        }
        
      }
      catch (SoapFault $ex) {
         return $ex->faultstring; //زمانی که خطایی رخ دهد این قسمت خطا را چاپ می کند
          
      }
      
      
      send_sms_iran("09128995376","hello");
 }
 