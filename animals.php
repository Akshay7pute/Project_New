   <?php
   session_start();
   $visitor=$_SESSION['visitor'];
    echo"<h3> visitor are :" .$visitor ."</h3>";
include('connect.php');
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Animal Information Show </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
   
  </div>
</nav>

<div class="container">
<div class="row">
 <div class="col-sm-1">
 </div>
  <div class="col-sm-10">
  <fieldset style="border-bottom:3px solid white;">
  <legend style="border-bottom:3px solid white">
  <h2 style="font-family:Copperplate Gothic Light">
  </span>Animal Information Show</h2></legend>

                    <a href="submission.php" > NEW  <i class="plus"></i></a>
  <form action="animals.php" method="POST">
    <h1 id='user_count'></h1>
<table align="center" border="1" style="width:100%; margin-top:40px">
<tr>
<th>Date Wise Search</th>
<td>
<input type="date" name="created_date"   class="form-control">                                                                    
    </td>
    &nbsp;
    <th>Category </th>
    <td>
      <select name="category" id="category" class="form-control">
        <option value="">Select Category Wise</option>
  <option value="Herbivores">Herbivores</option>
        <option value="Omnivores">Omnivores</option>
        <option value="Carnivores">Carnivores</option>
</select>
</td>
<th>Select Life Expectancy </th>
<td>
       <select class="form-control" id="life" name="life_expectancy" >
        <option value="">Select Life Expectancy</option>
        <option value="0-1 year">0-1 year</option>
        <option value="1-5 year">1-5 year</option>
        <option value="5-10 year">5-10 year</option>
        <option value="10+ year">10+ year</option>
    </select>
  </td>
         
</tr>
</table>
<br><br>
<center>
<td colspan="3" align="center"><input type="submit" name="submit" value="show"></td>
</center>
</form>
<br>
<br>
<br>

  <div class="card-body table-responsive">
                <table id="example" class="table-bordered table table-hover" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Sr No</th>
                            <th>Name of the animal</th>
                            <th>Category Type</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Life Expectancy</th>
                            <th>Date</th> 
                        </tr>


                    </thead>
                    <tbody>
                        
                         <?php



  include('connect.php');
    $sql="SELECT * FROM `animal`";
    $category=null;
    $created_date=null;
    $life_expectancy=null;
    if(isset($_POST['submit']))

  {
    
      if($_POST['created_date']){
        $created_date=$_POST['created_date'];
    $sql="SELECT * FROM `animal` WHERE created_date='$created_date' OR created_date='' ";
  }
  if($_POST['category']){
    $category=$_POST['category'];
     $sql="SELECT * FROM `animal` WHERE category='$category' ";

  }
  if($_POST['life_expectancy']){
     $life_expectancy=$_POST['life_expectancy'];

    $sql="SELECT * FROM `animal` WHERE life_expectancy='$life_expectancy' ";
  }
}
    $run=mysqli_query($con,$sql);
  if(mysqli_num_rows($run)<1)
  {
    echo"<tr><td colspan='7'>No records found</td></tr>";
  }
  else
  {
    $count=0;
    while($data=mysqli_fetch_assoc($run))
    {
      $count++;
      ?>
                      <tr>
<td><?php echo $count;?></td>
<td><?php echo $data['animal_name'];?></td>
<td><?php echo $data['category'];?></td>
<td><img style="height: 70px;width: 100px" src="<?php echo $data['image'];?>"></td>
<td><?php echo $data['description'];?></td>
<td><?php echo $data['life_expectancy'];?></td>
<td><?php echo $data['created_date'];?></td>
</tr>
      <?php
    }
  }

?>

                    </tbody>
                </table>
            </div>
 
</div>
</div>
</fieldset>
</div>
 
 
</body>
</html> 

