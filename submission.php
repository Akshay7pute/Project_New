
<?php
session_start();
 include('connect.php');
$sql="SELECT *FROM animal WHERE id=1";
 $run=mysqli_query($con,$sql);
  while($data=mysqli_fetch_assoc($run))
    {
        $visitor=$data['visitor'];
    }
    
    $_SESSION['visitor']=$visitor;
     echo"<h3> visitor are :" .$visitor ."</h3>";
     $visitor=$visitor+1;
      $sql="UPDATE  animal SET visitor='$visitor' WHERE id=1 ";
       $run=mysqli_query($con,$sql);
    if(isset($_POST['submit']))
    {
       
      $animal_name=$_POST["animal_name"];
$category=$_POST["category"];
$description=$_POST["description"];
$life_expectancy=$_POST["life_expectancy"];
  (isset($_POST['image'])); 
  
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
        $folder = 'image/'.$filename;
             (move_uploaded_file($tempname, $folder)); 
        
        
        $qry="INSERT INTO animal (animal_name,category,image,description,life_expectancy) VALUES('$animal_name','$category','$folder','$description','$life_expectancy')";

        
        $run=mysqli_query($con,$qry);
    
        if($run==true)
        {
            ?>
            <script>
            alert("Data inserted Successfully");
            </script>
            <?php
            header("Location: animals.php");
        }
        
    
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Animal Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body   onload="createCaptcha();">
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
   
  </div>
</nav>

<div class="container">
<div class="row">
 <div class="col-sm-4">
 </div>
  <div class="col-sm-4">
  <fieldset style="border-bottom:3px solid white;">
  <legend style="border-bottom:3px solid white">
  <h2 style="font-family:Copperplate Gothic Light">
  </span>Animal Information</h2></legend>
  
     <a href="animals.php" > View Data </a>
                
  <form action="submission.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="animal">Name of the animal:</label>
      <input type="text" class="form-control" id="animal" placeholder="Name of the animal" 
      name="animal_name" required >
    </div> 
     <div class="form-group">
    <label for="category">Category:</label>
    <select class="form-control" id="category" name="category" >
        <option value="">Select Category</option>
        <option value="Herbivores">Herbivores</option>
        <option value="Omnivores">Omnivores</option>
        <option value="Carnivores">Carnivores</option>
    </select>
    </div>
     <div class="form-group">
        <label>Image upload</label>
       <input type="file" id="image" name="image" required/>
    </div>
    <div class="form-group">
      <label for="description">Description :</label>
            <textarea name="description"  autofocus="" class="form-control" id="description" placeholder="Enter description" rows="3"> </textarea>
    </div>
     <div class="form-group">
    <label for="life">Life Expectancy :</label>
    <select class="form-control" id="life" name="life_expectancy" >
        <option value="">Select Life Expectancy</option>
        <option value="0-1 year">0-1 year</option>
        <option value="1-5 year">1-5 year</option>
        <option value="5-10 year">5-10 year</option>
        <option value="10+ year">10+ year</option>
    </select>
    <br>
     <table>
            <tr>
               <td>
               </td>
            </tr>
            <tr>
               <td>
                  <input type="text" id="captcha"readonly="readonly"/> 
                  <input type="button" id="refresh" value="Refresh" onclick="createCaptcha();" />

               </td>
            </tr>
            <tr>
               <td>
                <br>
                  <input type="text" id="captchainput"/>  
                  <input id="Button1" type="button" value="Check" onclick="validate();"/>  
               </td>
            </tr>
            <tr>
            </tr>
            <tr>
               <td><span id="error" style="color:red"></span></td>
            </tr>
            <tr>
               <td><span id="success" style="color:green"></span></td>
            </tr>
         </table>
    </div>
    <button type="submit" class="btn btn-info" name="submit" value="submit" onclick="validate();" style="width:100%;">Submit</button>
  </form>

</div>
</div>
</fieldset>
</div>
</body>
</html>
 <script type="text/javascript">
       var res;
         function createCaptcha()
         {
             var first= new Array(11,22,33,44,55,66,77,88,99);
            var sec = new Array(1,2,3,4,5,6,7,8,9);
             var sign=new Array('+','-');
            
             
               var a = first[Math.floor(Math.random() * first.length)];
               var b = sec [Math.floor(Math.random() * sec.length)];
               var sign = sign[Math.floor(Math.random() * sign.length)];
              
              
             if(sign=='+')

{
              res=a+b;
}
              if(sign=='-')
{
              res=a-b;
}

            var code = a + '' + sign + '' + '' + b;
            document.getElementById("captcha").value = code
          }
          function validate(){
              var string1 = res
              var string2 =document.getElementById('captchainput').value;
              if (string1 == string2){
         document.getElementById('success').innerHTML = "Form is validated Successfully";
        
                return true;
              }
              else{       
         document.getElementById('error').innerHTML = "Please enter a valid captcha."; 
        
                return false;
         
              }
          }
          function removeSpaces(string){
            return string.split(' ').join('');
          }
      </script>    
