<!DOCTYPE html>
<html lang="en">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="scripts/jquery-3.6.0.min.js" type="text/javascript"></script>
   
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="style.css"> 
  

    
        <script >
        $(function() {
            $('.delete').click(function(e){
               
                e.preventDefault();
                let id1=$(this).attr('id');
                let todecrease =$(this).attr('title');
               
                //alert(todecrease);
                $.get("delete.php",{"id":id1},function(info){
                    $('#'+id1+'1').remove();

                    if(info.iscomp==='0')
                    {
                   
                   let oldvalue= $("#"+todecrease).text();
                   //alert(oldvalue);
                 if(oldvalue!=0)
                { let newvalue=oldvalue-1;
                  
                  
                   if(newvalue!=0)
                   {
                   //alert(newvalue);
                   $("#"+todecrease).text(newvalue);
                }

                   // alert('#'+id1+'1');
                   else{
                        $("#"+todecrease).text('');
                    }

                  }}
                });
                
              

            })
            $('.checkboxs').change(function(e){
             

                let id2=$(this).attr('id');
                let todecrease=$(this).attr('title');
                let toedit=$(this).attr('rel');
              
                $.get("update.php",{"id":id2},function(data){

                   
                   
                    let oldvalue= $("#"+todecrease).text();
                  
                   //alert(oldvalue);
                   
                   let newvalue;
                   
               
                    if(data.completed==='0')
                    {

                      newvalue=parseInt(oldvalue)-1;
                      $('#'+toedit+'2').css("text-decoration","line-through");


                    }
                    else{
                       newvalue=parseInt(oldvalue)+1;
                    
                      $('#'+toedit+'2').css("text-decoration","none");
                    }

                   // alert(newvalue);
                   
                   //alert(newvalue);
                   $("#"+todecrease).text(newvalue);
                  
                    



                });




            });

            $('.important').click(function(e){
               
               e.preventDefault();
               let id1=$(this).attr('title');
               let title=$(this).attr('type');

            
               
               //alert(todecrease);
               $.get("updateimportant.php",{"id":id1},function(data){
                
                
            
               if(data.important==='0')
               {
                $("#"+id1+'3').text('star');
               }
               else{
                $("#"+id1+'3').text('star_border');
               }
                  
               });
               
             

           })
            

            
           // AJAX part
        });
        </script>
   
  </head>
 
  
<?php 
require "db.php";

session_start();
if( !validSession()) {
  header("Location: taskmanager.php?error") ;
  exit ; 
}

if(!empty($_GET))
extract($_GET);


//var_dump($_SESSION);

extract($_SESSION);
//var_dump($user);



?>
<style type="text/css">
.wrapper {
    padding-left: 300px;
}
.completed{
        
        text-decoration:line-through;
      }
.notcompleted{
       
        text-decoration:none;
      }
</style>
<body>
<script  src="scripts/10-jquery-dom.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div style="display:flex;">

<ul style="width:500px;"id="slide-out" class="side-nav fixed">
    <li> <div class="user-view">

  <div style="margin:0 10px;"class="black-text name">
  <img style="margin:0 10px;width:80px;height:80px;float:left;" src="<?=$user['file']?>" alt="" class="circle">
  <div style="padding-top:12px;font-size:18px;"><?=filter_var($user['Username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS)?> </div>
  <div  class="grey-text darken-3 email"><?=filter_var($user['email'],FILTER_SANITIZE_EMAIL)?></div>
 </div>



<div><a href="logout.php"><i style="margin-left:170px;" class="material-icons prefix">exit_to_app</i></a> </div>




</div>
</li>
<li>

  <div class="collection">
    <a  href="?title=Important&belongstoUser=<?=$user['id']?>"class="collection-item"><span class="badge"></span> <i style="margin-right:10px;color:black;"class="small material-icons prefix">star_border</i><span style='position:relative;top:-7px;'>Important</span></a>
     <!-- Modal Trigger -->

     <?php
     //var_dump($_POST);
     
     if (isset($_POST['newlist'])){
        extract($_POST);
        //var_dump($_POST);
        if(strlen(trim($newlist))!=0)
      
        addtoListtable($newlist,$user['id']);
        
     }
     if (isset($_POST['addedTask']) && isset($id)){
        extract($_POST);
        extract($_GET);
       //var_dump($_GET);
       // var_dump($_POST);
       if(strlen(trim($addedTask))!=0)
      
        addContentToLists($addedTask,$id,$belongstoUser);
        
     }
    

     $stmt=$db->prepare("select * from liststable where listBelongsTo=?");
     $stmt->execute([$user['id']]);
     $lists=$stmt->fetchAll(PDO::FETCH_ASSOC);
     //var_dump($lists);
     //var_dump($lists);

    
     //var_dump($lists);
     foreach($lists as $list)
     {
        
         $stmt=$db->prepare("select * from listcontents where itemBelongsto=? and completed='0' ");
         $stmt->execute([$list['id']]);
         $incompletedlistitems=$stmt->fetchAll(PDO::FETCH_ASSOC);
         //var_dump($incompletedlistitems);
   
         $size=count($incompletedlistitems);
       

         
        $list_name=filter_var($list['listName'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        echo "<a href='?title=$list[listName]&id=$list[id]&belongstoUser=$list[listBelongsTo]' class='collection-item'>
    
        <span id='$list[id]' class='badge'>$size     </span> <i style='margin-right:15px;color:black;'
        class='material-icons prefix'>dehaze</i><span  style='position:relative;top:-6px;'>$list_name </a> ";
     }
    
     //<i style='text-align:center;'class='material-icons prefix'>close</i>
    
     ?>
 
   <a class="collection-item modal-trigger" href="#modal1">
    
   <span class="badge"></span> <i style="margin-right:12px;color:black;"class="material-icons prefix">add</i> <span  style='position:relative;top:-6px;'>New List</span> </a></i>

</a>
    
  </div>
 

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
   
    <form action="" method="post">
    <div class="input-field col s6">
          <input id="list" type="text" name="newlist" class="validate">
          <label for="list">List Name</label>
        </div>

  </form>
  </div>
</div>
</li>
</ul>
<div  style="background-color:#29b6f6;height:1000px;width:100%;">

    
     <h3 style="color:white;margin-left:25px;"><?=$title??''?></h3>
     <br>
     <?php
     //var_dump($_SESSION);
     if( isset($_GET['title']) && $_GET['title']==='Important')
     {
        $stmt=$db->prepare("select * from listcontents where important='1' and completed='0' and itemsbelongstouser=$user[id]");
        $stmt->execute([]);
       
        $listitems=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($listitems as $item)
        {
            $stmt2=$db->prepare("select * from liststable where id=?");
            $stmt2->execute([$item['itemBelongsto']]);
            $listname=$stmt2->fetch(PDO::FETCH_ASSOC);
            
            $list_content_name=filter_var($item['listcontentname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo "
    
            
           
        
            <div id='$item[id]1'  style='background-color:white;width:65%;height:70px;border-radius:8px;margin:20px auto;display:flex'>
         
          
            <div style='width:30px;padding:12px;'>
    
            <a   href='' class=''  title='$item[id]' type='$title'> <i ' style='margin:10px;'class='material-icons prefix'>star_border</i> </a>
            </div>
      
          
             <div style='margin:5px 25px;padding:10px;'>
              <span  style=';color:grey'id='$item[listcontentname]1'>  $list_content_name </span>
           <br>
        

              <span style='font-weight:bold;font-style:italic' id=''>
              ($listname[listName]) </span>
          
    

</div>
            
           
           
           
      </div>  ";

        }
      

     }
    
     if(isset($_GET['id']) )

    {
 

     $stmt=$db->prepare("select * from listcontents where itemBelongsto=?");
     $stmt->execute([$id]);
     $listitems=$stmt->fetchAll(PDO::FETCH_ASSOC);

    

   // var_dump($listitems);
     foreach($listitems as $item)
     {
        $star=$item['important'] ?  'star' :'star_border';
        $checked=($item['completed']==='1') ? 'checked': '' ;
        $style= ($item['completed']==='1') ? 'completed' :'notcpmpleted';
        $list_content_name=filter_var($item['listcontentname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        echo "
    
        
        <div id='$item[id]1'  style='background-color:white;width:65%;height:50px;border-radius:8px;margin:20px auto;display:flex'>
        
        
        <div  style='background-color:;padding:11px;width:100px;'>
        <label   >
          <input style='margin:10px;' type='checkbox' class='checkboxs' id='$item[listcontentname]'  $checked title='$item[itemBelongsto]' rel='$item[id]' />
          <span style='width:300px;' class=$style id='$item[id]2'> $list_content_name</span>
        </label>
        </div>

<div style='width:100%'>

        <span style='float:right;position:relative;right:0'>
        <a   href='' class='important'  title='$item[id]' type='$title'> <i id='$item[id]3' style='margin:10px;'class='material-icons prefix'>$star</i> </a>

        <a  href='' id='$item[id]' title='$item[itemBelongsto]'class='delete' 
        > <i style='margin:10px;'class='material-icons prefix'>delete_forever</i> </a>

    </span>
    </div>
        
       
       
       
  </div>  ";
     }
     }
     
     
     ?>
<?php if(isset($title) && $title!='Important'):?>
     <form action=" "method="post">

   <div id="addTask" style="background-color:#5c6bc0;width:50%;border-radius:8px;position:fixed;bottom:25px;padding:10px;text-align:center;margin-left:14%;">
          <div  class="input-field col s3">
          <i style="margin-right:10px;color:white;"class="material-icons prefix">add</i>
         
          <input style="color:white;width:80%" id="last_name" type="text" class="validate"  name="addedTask" placeholder="Add a Task" autofocus>
          
         
        </div>


    
    </div>
    
    </form>
    <?php endif ?>


</div>


</body>
</html>

<script>
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

 
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });
</script>