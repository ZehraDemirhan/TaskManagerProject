$(function (){
var anim_id;
var container=$("#gameContainer");
var truck=$("#truck");
var tank1=$("#tank1");
var tank2=$("#tank2");
var tank3=$("#tank3");

var line1=$("#line1");
var line2=$("#line2");
var line3=$("#line3");

var tree1=$("#tree1");


var restart_div=$("#restartdiv");
var restart_btn=$("#restart");
var score=$("#score");
var Startbutton=$(".startButton");


var table=$("#scoreTable1");

//Initial Setup
var container_left =parseInt(container.css('left'));
var container_width=parseInt(container.width());
var container_height=parseInt(container.height());
var truck_width = parseInt(truck.width());
var truck_height = parseInt(truck.height());

//some other declarations
var game_over = true;

var score_counter = 1;

var speed = 3;
var line_speed = 5.5;

var move_right = false;
var move_left = false;
var move_up = false;
var move_down = false;



Startbutton.click(function(){
  

    score.text(0);
    game_over=false;
    score_counter=0;
    table.html("");
    tried=1;
    truck.css({bottom:0});
    tank1.css({top:-100});
    tank2.css({top:-450});
    tank3.css({top:-800});

    restart_div.slideUp();

    requestAnimationFrame(repeat);

});
 /* ------------------------------GAME CODE STARTS HERE------------------------------------------- */
 $(document).on('keydown',function(e) {

    if(game_over===false)
    {
        var key=e.keyCode; 
          //Saving key to a variable
        if(key===37 && move_left ===false)   { //Left
            move_left=requestAnimationFrame(left);
        }   
        else if (key===39 && move_right ===false)  //Right
        { 
              move_right=requestAnimationFrame(right);
        }  
        else if (key===38 && move_up ===false)  
        { 
              move_up=requestAnimationFrame(up);
        }  
        else if (key===40 && move_up ===false)  
        { 
              move_down=requestAnimationFrame(down);
        }  

    }

        
    
 });


$(document).on('keyup',function(e){
    if(game_over==false)
    {
        var key =e.keyCode;
        if(key===37 )//Left
        {
            cancelAnimationFrame(move_left);
            move_left=false;
        }

        else if(key===39)//Right
        {
            cancelAnimationFrame(move_right);
            move_right=false;
        }
        else if(key===38)//Up
        {
            cancelAnimationFrame(move_up);
            move_up=false;
        }
        else if(key===40)//Down
        {
            cancelAnimationFrame(move_down);
            move_down=false;
        }

    }
});


 function left() //For moving the truck to left 
 {
     if(game_over===false && parseInt(truck.css('left'))>0)
     {                              //If trucks left is grater than 0 then move it
    
         truck.css('left',parseInt(truck.css('left'))-1.5);
         move_left=requestAnimationFrame(left);
     }
 }

 function right()//For moving the truck to right 
 {
    if(game_over===false && parseInt(truck.css('left'))<container_width-truck_width)
    {                              
   
        truck.css('left',parseInt(truck.css('left'))+2);
        move_right=requestAnimationFrame(right);
    }
 }; 
 function up()//For moving the truck to right 
 {
    if(game_over===false && parseInt(truck.css('top'))>0)
    {                              
   
        truck.css('top',parseInt(truck.css('top'))-2);
        move_up=requestAnimationFrame(up);
    }
 }; 
 function down()
 {
    if(game_over===false && parseInt(truck.css('top'))<container_height-truck_height)
    {                              
   
        truck.css('top',parseInt(truck.css('top'))+2);
        move_down=requestAnimationFrame(down);
    }
 }

 anim_id=requestAnimationFrame(repeat);
 scorekept=0;
 function repeat(){
     if(game_over===false){
         if(collision(truck,tank1) || collision(truck,tank2) ||collision(truck,tank3) )
         { 
             stop_the_game();
         };
         score_counter++;
         if(score_counter % 40 == 0){
             score.text(parseInt(score.text())+1);
             scorekept++;
         }
         if(score_counter %800===0)//Increasing the hardness of the game;
         {
             speed++;
             line_speed++;

         }
         tank_down(tank1);
         tank_down(tank2);
         tank_down(tank3);

         tank_down(tree1);
       

         line_down(line1);
         line_down(line2);
         line_down(line3);

         anim_id=requestAnimationFrame(repeat);
     }
 };
 function tank_down(tank)
 {
     var current_top =parseInt(tank.css('top'));
     if(current_top>container_height){
     current_top=-200;
     var tank_left=parseInt(Math.random()*(container_width-tank.width()));
     tank.css('left',tank_left);
     }

     tank.css('top',current_top+speed );
 }

 

 function line_down(line)
 {
     var line_current_top =parseInt(line.css('top'));
    
     if(line_current_top>container_height){
         line_current_top=-450;
     }
     line.css('top',line_current_top+line_speed);

 }

var tried=1;
 function stop_the_game()
 {
    
     game_over=true;
     cancelAnimationFrame(anim_id);
     
     restart_btn.css("display","inline-block")
     restart_div.slideDown();
     
     out=` <tr height=60px > <td class="c1">${tried}.</td> 
     <td class="c2">${scorekept} pts. </td>
     
     
     </tr>`;
   
     table.append(out);
     scorekept=0;
  
     tried++;
    
     restart_btn.focus();
     speed=3;
     line_speed=5.5;
    


  
     
 }
 /*   background-image: url("images/Truck3.png");
     background-size: cover;
        position: absolute;
        bottom:8%;
        left:60%;
        height:140px;
        width:80px;
        background-color: red;
         truck.offset({top:0,left:0});
         truck.width(80).height(140);*/
 restart_btn.click(function(){
 game_over=false;


truck.css({bottom:0});
tank1.css({top:-100});
tank2.css({top:-450});
tank3.css({top:-800});

score_counter=0;
score.text(0);

 restart_div.slideUp();

 requestAnimationFrame(repeat);
 });

  /* ------------------------------GAME CODE ENDS HERE------------------------------------------- */

 //Function to decide whether the tank is crushed or not 
  function collision($div1, $div2) {
    var x1 = $div1.offset().left;
    var y1 = $div1.offset().top;
    var h1 = $div1.outerHeight(true);
    var w1 = $div1.outerWidth(true);
    var b1 = y1 + h1;
    var r1 = x1 + w1;
    var x2 = $div2.offset().left;
    var y2 = $div2.offset().top;
    var h2 = $div2.outerHeight(true);
    var w2 = $div2.outerWidth(true);
    var b2 = y2 + h2;
    var r2 = x2 + w2;

    if (b1 < y2 || y1 > b2 || r1 < x2 || x1 > r2) return false;
    return true;
}

});
