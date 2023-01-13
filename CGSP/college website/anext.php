<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="anext.css">
    <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #D6EEEE;
}
</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
  <table class="table align-middle bg-dark ">
    <thead >
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Problem</th>
        <th> PDF & Access</th>
      </tr>
    </thead>
    <tbody>
    <?php include('config.php');
$sql=mysqli_query($con,"select * from userproblem");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
      <tr>
        <td>
          <div class="d-flex align-items-center">
            
            <div class="ms-3">
              <p class="fw-bold mb-1"><?php echo $row['Username'];?></p>
              
            </div>
          </div>
        </td>
        <td>
          <div class="d-flex align-items-center">
            
            <div class="ms-3">
             
              <p class="text-muted mb-0"><?php echo $row['Email'];?></p>
            </div>
          </div>
        </td>
        <td>
          <p class="fw-normal mb-1"><?php echo $row['Mobile'];?></p>
         
        </td>
        <td>
          <p class="fw-normal mb-1"><?php echo $row['Problem'];?></p>
         
        </td>
       <td>
          <button type="button" class=" btn btn-linkbtn-sm btn-rounded">
            
            <?php echo $row['Files'];?>
          
          </button>&nbsp;
         <a href="https://drive.google.com/file/d/111LOLNEGvCtWv0X8MiDqy7FmDMwuNoHv/view?usp=sharing"> <button type="button" class="btn btn-linkbtn-sm btn-rounded">Access</button></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  
                    
                    
</body>
</html>