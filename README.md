## Testing Testing
<pre>

                     `..----..`                    
                 .-://////////:-.                 
               .:////////////////:.               
              -////////////////////-              
             -////////-....-////////-             
            `://////:`      `://////:`            
            .///////.        .///////.            
            `///////-       `:///////`            
  `-:::-.    -///////:`    `:///////-    .::::-`  
  ://////-    :///////:`  `:///////-    -//////:  
  :///////-    -///////: `:///////-    -///////:  
  `:///////:    -/////:`.:///////-    :///////:`  
   `:///////:`   .///:`.////////-   `:///////:`   
    `:///////:`   .::`.////////-   `:///////:`    
     `:///////:`   ``.////////-   `:///////:`     
      `:///////:.   .////////-   `:///////:`      
        -///////:. -////////-`. `:///////:`       
        `:////////:////////-`:/-:///////:`        
          :///////////////.`://////////:`         
           -/////////////.`://////////:           
            -///////////- ://////////:            
             -/////////-  `:////////-`            
              -///////.    .://////:              
               `.---.`      `.----.               
                                                  


       oyyyyyyyyyyy+          .yyyyyyyyyyyy       
       ``:yyyyyyy-``       ``` ```osyyyyyo:`      
          oyyyyyo`:/+ossyyyyyyyysso+////-+yy/`    
          oyyyyyo.yyyyyyyyyyyyyyyyyyyyyyo/+yyy/`  
          oyyyyyo.yyo+/:-..`.//////+oyyyyyyyyyyy/`
       .+-oyyyyyo`.       `/yyyyyy+`  .:oyyyyyyys:
     `oyy-oyyyyyo       `/yyyyyyo.       `:oyys:  
    :yyyy-oyyyyyo     `/yyyyyyo.            .-    
   /yyyyy-oyyyyyo   `/yyyyyyo.                    
  :yyyyy/ oyyyyyo `/yyyyyyo.                      
 `yyyyy+  oyyyyyo/yyyyyyy/                        
 /yyyyy`  oyyyyyyyyyyyyyyyo.                      
:yyyyys   oyyyyyyyyyoyyyyyyy/`                    
.yyyyy+   oyyyyyyy+. .oyyyyyys:                   
 /yyyys   oyyyyys`     -syyyyyyo.                 
 `syyyy:  oyyyyyo        /yyyyyyy+`               
  -yyyyy- oyyyyyo         `+yyyyyyy:              
   -yyyyy:.syyyyo           -syyyyyys.         ./-
    .syyyyo-/yyyo             :yyyyyyy+`     `/yy/
      /yyyyyo-:++              `+yyyyyyy:  `/yyyy:
       `/syyyys/.                .oyyyyyys-/ys+-.`
          -+syyyyyo/-.`           `:syyyyyy+-     
          o+:-:+syyyyyyyssooooossyyo./yyyyyyy/    
       ``.syyys+:--::/+oossssssoo+/:-`.syyyyyys-` 
       oyyyyyyyyyyy+                :yyyyyyyyyyyy/

</pre>

http://latebart.com
Late BART Alert is a web service that will send you a text message if your specific train is going to be late.

BART has a handy API for late trains. It even can send you text messages about late train, yet it doesn't filter them at all. Late BART Alert does the filtering for you, reducing the noise, so that you only hear about the delays to the one train you actually care about.

Late BART runs on the very handy and time saving https://www.dotcloud.com/ service.
Late BART pulls down public BART data from their API at http://api.bart.gov/api/bsa.aspx?cmd=bsa&key=MW9S-E7SL-26DU-VV8V&date=today
Late BART sends out text messages using the super simple http://www.twilio.com/ service.
