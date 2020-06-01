<?php
include('include/functions.php');
$error=false;
if(isset($_GET['q']))
{
    $username = $_GET['q'];
    if(!strlen($username)<1)
    {
        $username = str_replace(' ','+',$username);
        $response = searchUser($username);
        $total_count = $response['total_count'];
        if($total_count>1 || $total_count==1)
            {
                $response = $response['items'];
            }
            else
            {
                $error=true;
                $error = "No Record Found";
            }
    }
    else
    {
        $error=true;
        $error = "No Record Found";
    }
}
?>
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
    <nav class="black">
    <a href="#" class="brand-logo">Github Explorer</a>

    </nav>

    <div class="center">
        <h5 class="center red-text">
            <?php
                if(isset($error))
                {
                    echo $error;
                }
            ?>
        </h5>
    </div>

    <div class="container">    
        <form action="" method="get" align="center">
            <input type="text" name="q" id=""><br><br>
            <input type="submit"class="btn black" style="height:50px; border-radius:50px;" name="" value="Search User" id="">
        </form>
    </div>
        
        <div class="row">
        <?php 
                    if($error)
                    {
                        exit();
                    }
                    if(isset($_GET['q']))
                    {
                        foreach($response as $item)
                        {
                            $name = $item['login'];
                            $avatar_url = $item['avatar_url'];
                        ?>
                <div class="col l2 m2 s6">  
                  <div class="card hoverable " style="border-radius: 20px 20px 0px 0px; border-top: 10px solid black; border-right: 1px solid black; border-left: 1px solid black;">
                    <div class=""style="padding: 20px 20px 0px 20px;" >
                      <img style=" border: 3px solid black;" src="<?php if(isset($avatar_url)) echo $avatar_url; ?>" alt="" class="z-depth-1 circle responsive-img">
                    </div>
                    <b><p class="center" style="margin-top: 0px;"><?php if(isset($name)) echo $name; ?></p></b>
                    <div class="card-saction center">
                      <a href="user.php?username=<?php if(isset($name)) echo $name; ?>" class="btn black" style="width: 100%; ">More</a>
                    </div>
                  </div>
                </div>
                <?php
                        }
                    }
                    ?>
        </div>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
