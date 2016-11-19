<?php
  $playable = '';
  if ( isset( $_POST['url'] ) ) {
    if ( ! empty( $_POST['url'] ) ) {
      $playable = $_POST['url'];
    }
  }
  function getYoutubeIdFromUrl($url) {
      $parts = parse_url($url);
      if(isset($parts['query'])){
          parse_str($parts['query'], $qs);
          if(isset($qs['v'])){
              return $qs['v'];
          }else if(isset($qs['vi'])){
              return $qs['vi'];
          }
      }
      if(isset($parts['path'])){
          $path = explode('/', trim($parts['path'], '/'));
          return $path[count($path)-1];
      }
      return false;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BigTube</title>
  <link rel="stylesheet" href="./styles.css">
</head>
<body>
  <header>
    <div class="logo">BigTube!</div>
    <form action="." method="post">
      <input type="text" name="url" placeholder="Youtube link here ..." value="<?php echo $playable ?>">
    </form>
  </header>
      <?php 
        if ( ! empty( $playable ) ) {
          ?>
          <div style="text-align: center;">
            <iframe class="video-player" src="https://www.youtube.com/embed/<?php echo getYoutubeIdFromUrl( $playable ) ?>"></iframe>
          </div>
          <?php
        }
      ?>
  <script src="./jquery-3.1.1.min.js"></script>
  <script>
    function yo () {
      $( document ).ready( function () {
        let player = $( 'iframe' );
        player.width( $( window ).width() - 20 );
        player.height( $( window ).height() - $( 'header' ).height() - 10 );
      } );
    }
    yo();
    $( window ).resize(function() {
      yo();
    });
  </script>
</body>
</html>