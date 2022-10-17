// alert("jQuery imported")
$( function(){

    let scrollPos = $("html,body").scrollTop() ;
    console.log("scroll position"+scrollPos);
   // alert("Page is loaded")
   $("#btnStart").click(function(){
       // alert("clicked")

       // Part 1 : CSS manipulation
       // get: css(propName)
       // set: css(propName, propValue)
       // set: css({prop1:value1, prop2:value2 ...})

       $("h1:first").css("color", "blue")
                    .css({"font-family":"arial", "border-bottom" : "2px solid #99F"})

       $(".fa-peace").css({"font-size" : "50px", "color" : "green"})
       $(".topPanel td:first").css("background", "#aa6")
       $(".topPanel td:nth-of-type(2)").css("background", "#6f6")

       // chaining
       $(".topPanel h1").css("font-style", "italic")
                        .prepend("All ")
                        .css("font-family", "arial")
    
        // get css property
        let fontSize = $("h1").css("font-size") ; // first selected elements css property, in string
        console.log("Font size is " + fontSize) 
        
        // addClass("class1 class2 ...")
        $("h1:first").addClass("gradient")

        // hasClass(className) --> boolean (true, false)
        console.log("h1:first has class 'gradient' :" , $("h1:first").hasClass("gradient"));
        console.log("h1:first has class 'big-font' :" , $("h1:first").hasClass("big-font"));

        // removeClass(className)
        $("h1:first").removeClass("right")
                     .addClass("center")
        
        // size of the element, width and height
        // get: width(), height()
        // set: width(number), height(number)
        $(".topPanel h1").addClass("gradient")
                         .width(250)
                         .height(50)
                         .css({"line-height":"50px", "margin" : "20px auto" })
        
        console.log("Width of TopPanel ", $(".topPanel").width())

        // Position

        // relative to its offset parent
        $(".fa-peace:first").css({position: "absolute", top: "20px", left: "80px"})

        // position() --> {top, left}
        console.log("Relative to offset Parent : ", $(".fa-peace:first").position());
        console.log("Relative to document : ", $(".fa-peace:first").offset());
        
        $(".fa-peace:last").css("position", "absolute").offset({top:20, left:80})
   })

   $("#toggleP").click(function(){
       // click event handler for paragraph#toggleP
       // this --> clicked paragraph DOM element
       // $(this) --> jQuery object that contains clicked P
       /*if ( $(this).hasClass("big-font")) {
           $(this).removeClass("big-font")
       } else {
           $(this).addClass("big-font")
       } */
       $(this).toggleClass("big-font")
   })

   $("#btnScroll").click(function(){
       let scrollPos = $("html,body").scrollTop() ;
       console.log("Scroll Top Pos: " , scrollPos);
       $("html,body").scrollTop(0) ;
       //$("html,body").animate({scrollTop:0}, 1000) ;
   })

   // 2. CONTENT MANAGEMENT
   // <p>Hello World</p>   --> content
   // <p>Hello <b>this</b> World</p> --> html:  Hello <b>this</b> World
   // <p>Hello <b>this</b> World</p> --> text:  Hello this World
   // <input type="text" /> -- form content
   // <img src="a.jpg" /> --> a.jpg is the image content

   // get: html() , set: html(newContent)

   $("#btnIncr").click(function() {
       // get the content of p#counter
     let counter = $("#counter").text() ; // "0" in string format
       counter = Number(counter) + 1 ;
       $("#counter").text(counter) ;  // set new content 
   })

   $("#btnAdd").click(function(){
       $(".topPanel table").append(`
           <tr>
            <td>Lemon</td>
            <td>Watermelon</td>
           </tr>
           `) ;
   })

   $("#btnDelete").click(function(){
       $(".topPanel table tr:first").remove();
   })

   $("#btnAddAnimal").click(function(){
       let animalName = $("#animalInput").val() ;
       if ( animalName.trim().length !== 0) {
           $("#animalText").append(animalName.trim() + " ")
       }
       $("#animalInput").val("");
   })

   // 3. ATTRIBUTE MANIPULATION
   $(".imagePanel span").click(function(){
      // alert("span clicked")
      // this --> reference to the clicked span element
      // $(this) --> convert to jquery object
     let id = $(this).attr("id") ;
      //alert(id)
     let images = { 
         "first" : "./img/lightning.jpg", 
         "second" : "./img/bugatti.jpg", 
         "last":"./img/agera.jpg"
    }
      //alert( images[id])

     // accessing a property of an object with a variable
     let imageName = images[id] ;  
      $(".imagePanel img").attr("src", imageName)

      $(".imagePanel span").removeClass("selected")
      $(this).addClass("selected")

   })
 
})