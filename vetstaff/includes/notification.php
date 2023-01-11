
<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.navbar {
  background-color: #0066ff;
  padding: 0 1rem;
}

.navbar ul {
  list-style: none;
}

.navbar > ul > li {
  position: relative;
  display: inline-block;
}

.navbar > ul > li .dropdown-check {
  display: none;
}

.navbar > ul > li > a {
  color: #fff;
  font-size: 1.5rem;
  padding: 1rem 0;
  display: inline-block;
  cursor: pointer;
}

.navbar > ul > li > a .count {
  position: absolute;
  right: -1px;
  top: 14px;
  border-radius: 50%;
  font-size: 0.8rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fff;
  color: #0066ff;
  width: 12px;
  height: 12px;
}

.navbar > ul > li .dropdown-check:checked ~ .dropdown {
  visibility: visible;
  opacity: 1;
}

.navbar ul li .dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 1rem;
  visibility: hidden;
  opacity: 0;
  width: 250px;
  transition: 0.3s;
}

.navbar ul li .dropdown li {
  margin-bottom: 1rem;
  border-bottom: 1px solid #ccc;
  padding-bottom: 1rem;
}

.navbar ul li .dropdown li:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: 0;
}

</style>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
</head>

<body>
  <nav class="navbar">
    <ul>
      <li>
        <?php 
        $sql = "SELECT * FROM notification WHERE status='0' ORDER BY id DESC";
        $res = mysqli_query($db, $sql); ?>
        <a href="#" id="notifications">
          <label for="check">
            <i class="fa fa-bell-o" aria-hidden="true"></i>
            <span class="count"><?php echo mysqli_num_rows($res); ?></span>
          </label>
        </a>
        <input type="checkbox" class="dropdown-check" id="check" />
        <ul class="dropdown">
          <?php
          if (mysqli_num_rows($res) > 0) {
            foreach ($res as $item) {
          ?>
              <li><?php echo $item["text"]; ?></li>
          <?php }
          } ?>
        </ul>
      </li>
    </ul>
  </nav>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#notifications").on("click", function() {
        $.ajax({
          url: "readNotifications.php",
          success: function(res) {
            console.log(res);
          }
        });
      });
    });
  </script>
</body>

</html>