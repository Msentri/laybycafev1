<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>index</title>
    <meta name="description" content="" />
    <meta name="author" content="Christoph Oberhofer" />

    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="includes/serratus/example/css/styles.css" />
  </head>

  <body>
      <header>
          <div class="headline">
              <h1>QuaggaJS</h1>
              <h2>An advanced barcode-scanner written in JavaScript</h2>
          </div>
      </header>
    <section id="container" class="container">
        <h3>Working with static images</h3>
        <p>This examples uses static image files as input which are loaded from the server on startup.
            The locating and decoding process takes place inside the browser.
            Hit the <strong>next</strong> button to try a different image. You can also switch between
            two different test-sets. Each of those contains 10 images, demonstrating the capabilities of decoding
            <strong>Code128</strong> and <strong>EAN</strong> encoded barcodes.
        </p>
      <div class="controls">
          <fieldset class="input-group">
              <button class="next">Next</button>
          </fieldset>
          <fieldset class="reader-config-group">
              <span>Barcode-Type</span>
              <select name="decoder_readers;input-stream_src">
                  <option value="code_128">Code 128</option>
                  <option value="code_39">Code 39</option>
                  <option value="code_39_vin">Code 39 VIN</option>
                  <option value="ean" selected="selected">EAN</option>
                  <option value="ean_extended">EAN-extended</option>
                  <option value="ean_8">EAN-8</option>
                  <option value="upc">UPC</option>
                  <option value="upc_e">UPC-E</option>
                  <option value="codabar">Codabar</option>
                  <option value="i2of5">I2of5</option>
              </select>
          </fieldset>
      </div>
      <div id="result_strip">
        <ul class="thumbnails"></ul>
      </div>
      <div id="interactive" class="viewport"></div>
        <div id="debug" class="detection"></div>
    </section>
          <footer>
        <p>
          &copy; Copyright by Christoph Oberhofer
        </p>
      </footer>
    <script src="vendor/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script src="includes/serratus/dist/quagga.js" type="text/javascript"></script>
    <?php include 'includes/serratus/js/static_images.php'; ?>
  </body>
</html>
