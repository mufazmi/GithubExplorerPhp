<?php require_once('include/header.php') ?>

<?php
$domain1 = 'http://api.github.com/users/';

function get_http_response_code($domain1) {
  $headers = get_headers($domain1);
  return substr($headers[0], 9, 3);
}
$get_http_response_code = get_http_response_code($domain1);

if ($get_http_response_code != 200 ) {
    ?>
    <div class="center">
        <br><br>
        <i class="material-icons large">tag_faces</i>
        <h1><b>Api Call Limit Exceeded </b></h1>
        <h3><b>For Your Ip <?php echo $_SERVER['REMOTE_ADDR']; ?></b></h3>

    </div>
    <?php
    exit();
} 
?>

<?php
    $error=false;
    
    require_once('include/functions.php');
    if($_GET['username'] || strlen($_GET['username'])>1)
    {
      $username = $_GET['username'];
      $username = str_replace(' ','',$username);
      $response = getUser($username);
      $followersResponse = getFollowers($username);
      $followingResponse = getFollowing($username);
      $repositoryResponse = getRepository($username);
      if(isset($repositoryResponse['message']))
      {
        echo "baye baye";
        exit();
      }
      $login = $response['login'];
      $name = $response['name'];
      $image =$response['avatar_url'];
      $followers =$response['followers'];
      $following=$response['following'];
      $about = $response['bio'];
      $location = $response['location'];
      $company = $response['company'];
      $blog = $response['blog'];
    }
    else
    {
      header("LOCATION:index.php");
    }
?>

    <div class="row">
      <div class="col s12">
        <img src="http://demo.thedevelovers.com/dashboard/queenadmin-1.2/assets/img/city.jpg" style="width:100%;" height="250px" alt="">
      </div>
        <div class="col s12 l3 m3" style="margin-top: -120px;">
            <div class="" style="padding:15px;">
              <div class="center">
                <img style="width: 180px; border:3px solid white" class=" circle responsive-img z-depth-1" src="<?php if(isset($image))echo $image?>" alt="">
              </div>
                  <div class="">
                      <h5 class="center"><?php if(isset($name))
                      {
                        echo $name;
                      }
                      else
                      {
                         if(isset($login))echo $login;
                      }
                      ?></h5>
                    
                    <div class="col s6 m6 l6">
                          <button class="btn"> <?php if(isset($followers))echo $followers?> Followers</button>
                    </div>
                    <div class="col s6 m6 l6">
                      <button class="btn"> <?php if(isset($following))echo $following?> Following</button>
                    </div>
                    <br>
                    <br>
                   <div style="padding: 10px;">
                      <b>About Me</b>
                      <div class="divider"></div>
                      <p><?php if(isset($about))echo $about?></p>                  
                      <b>Statics</b>
                      <div class="divider"></div>
                      <b>Location : &nbsp;&nbsp;</b>
                      <span><?php if(isset($location))echo $location?></span>
                      <br>
                      <b>Company : &nbsp;&nbsp;</b>
                      <span><?php if(isset($company))echo $company?></span>
                 </div>
                  </div>
                </div>
        </div>
        <div class="col s12 l9 m9">
          <div class="card">
            <div class="col s12">
              <div class="col s12">
                <ul class="tabs">
                  <li class="tab col s1"><a href="#about">About</a></li>
                  <li class="tab col s2"><a href="#projects">Projects</a></li>
                  <li class="tab col s2"><a href="#followers">Followers</a></li>
                  <li class="tab col s2"><a href="#followings">Followings</a></li>
                </ul>
              </div>
              <div id="about" class="col s12">
                <h5><i class="material-icons">person</i> About</h5>
                <div class="col s12 m12 l6" style="padding: 20px;">
                  <div class="col s5 m5 l5">
                    <b>Name</b>
                  </div>
                  <div class="col s7 m7 l7">
                    <span>Umair Farooqui</span>
                  </div>
                </div>
                <div class="col s12 m12 l6">

                </div>
              </div>
              <div id="projects" class="col s12">
              <?php foreach($repositoryResponse as $project)
                {
                  $name = $project['name'];
                  $avatar_url = $project['owner']['avatar_url'];
                  $description = $project['description'];
                ?>
                <a href="?username=<?php if(isset($name)) echo $name; ?>">
                    <div class="card z-depth-0">
                      <div class="row">
                        <div class="col s2 m2 l1">
                          <img src="<?php if(isset($avatar_url)) echo $avatar_url; ?>" class="circle responsive-img" alt="">
                        </div>
                        <div class="col s10 l10 m11">
                          <b><p class="black-text"><?php if(isset($name)) echo $name; ?></p></b>
                          <p><?php if(isset($description)) echo $description; ?></p>
                        </div>
                      </div>
                    </div>
                  </a>
                  <?php
                }
                ?>
              </div>

              <!-- Code For Followers Tab -->
              <div id="followers" class="col s12">
                <?php foreach($followersResponse as $fr)
                {
                  $name = $fr['login'];
                  $avatar_url = $fr['avatar_url'];
                ?>
                  <div class="col s6 m3 l2">
                  <div class="card  hoverable " style="border-radius: 20px 20px 0px 0px; border-top: 10px solid black; border-right: 1px solid black; border-left: 1px solid black;">
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
                ?>
              </div>

              <!-- Code For Following Tabs -->
              <div id="followings" class="col s12">
              <?php foreach($followingResponse as $fgr)
                {
                  $login = $fgr['login'];
                  $avatar_url = $fgr['avatar_url'];
                ?>
                  <div class="col s6 m3 l2">
                  <div class="card  hoverable " style="border-radius: 20px 20px 0px 0px; border-top: 10px solid black; border-right: 1px solid black; border-left: 1px solid black;">
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
                ?>
              </div>
            </div>
          </div>
        </div>
    </div>

      <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
        $(document).ready(function(){
        $('.tabs').tabs();
        });
      </script>
    </body>
  </html>
        