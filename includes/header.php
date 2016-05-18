<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <?php 
          if(isset($_SESSION['username'])){
            print '<li>Welcome '.$_SESSION['username'].'</li>';
            print '<li><a href="post.php">Make a post</a></li>';
            print '<li><a href="logout.php">Logout</a></li>';
          }else{
            print '<li><a href="register.php">Register</a></li>';
            print '<li><a href="login.php">Login</a></li>';
          }        
        ?>
        <li><a href="#">Page 3</a></li> 
        
      </ul>
    </div>
  </nav>