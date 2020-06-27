<footer>
      <div class="container">
         <div class="social">
            <p class="p-bottom"><strong>GET IN TOUCH</strong></p>
            <div>
               <div class="social-1">
                  <div class="box">
                  <a href="#"><p class="social-icon"><i class="fab fa-twitter"></i></p></a>
                  <a href="#"><p>&nbsp;&nbsp;RduoManila</p></a>
                  </div>
                  <div class="box">
                  <a href="#"><p class="social-icon"><i class="fab fa-facebook-f"></i></p></a>
                  <a href="#"><p>&nbsp;&nbsp;RduoManila</p></a>
                  </div>
                  <div class="box">
                  <a href=""><p class="social-icon"><i class="fab fa-google"></i></p></a>
                  <a href=""><p>&nbsp;&nbsp;rduomanila@gmail.com</p></a>
                  </div>
                  <div class="box">
                  <a href=""><p class="social-icon"><i class="fas fa-phone"></i></p></a>
                  <a href=""><p>&nbsp;&nbsp;09351172061</p></a>
                  </div>
                  <div class="footer-copyright">
                     <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; 2020 &ndash; R Duo Manila</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="explore">
            <p class="p-bottom"><strong>EXPLORE</strong></p>
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="#">Advertise</a></li>
               <li><a href="#">Guide</a></li>
            </ul>
         </div>
         <div class="policies">
            <p class="p-bottom"><strong>POLICIES</strong></p>
            <ul>
               <li><a href="#">Terms And Conditions</a></li>
               <li><a href="#">Privacy Policy</a></li>
            </ul>
         </div>
         <div class="others">
            <ul>

               <li>
                  <?php 
                  
                     if (isset($_SESSION['user_username'])) {
                        echo "<a href='logout.php'>Logout</a>";
                     }  else {
                        echo "<a href='login.php'>Login</a>";
                     }

                  ?>
              </li>
               <li><a href="register.php">Create An Account</a></li>
            </ul>
         </div>
      </div>
   </footer>
</body>
</html>
<!-- <p class="text-center">Copyright &copy; 2020 All Rights Reserved</p> -->