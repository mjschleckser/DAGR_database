<ul class="ul-navbar">
  <li class="li-navbar"><a class="li-navbar-a" href="main.php">Home</a></li>
  <li class="li-navbar"><a class="li-navbar-a" href="insert.php">Insert</a></li>
  <li class="li-navbar"><a class="li-navbar-a" href="3.php">Delete DAGR</a></li>
  <li class="li-navbar"><a class="li-navbar-a" href="4.php">Search DAGRs</a></li>
  <li class="li-navbar"><a class="li-navbar-a" href="5.php">Categories</a></li>
</ul>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
            }
        });
    });
</script>