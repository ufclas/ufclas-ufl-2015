<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Form</title>
	<link href="css/style.css" rel="stylesheet">
	<link rel="apple-touch-icon" href="img/client-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/client-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/client-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/client-icon-ipad-retina.png">
	<link rel="icon" href="favicon.png" >
</head>

<body class="loading">
  <?php include 'inc/svg.php'; ?>
  <?php include 'inc/header.php'; ?>

  <div id="main" class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Form Style Guide</h1>

        <h2>Input Fields</h2>
        <div class="row">
          <div class="col-sm-9">
            <form action="">
              <div class="row">
                <div class="col-sm-5">
                  <label for="field1" class="visuallyhidden">field1</label>
                  <input type="text" id="field1" placeholder="Short Input Field">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                  <label for="field3" class="visuallyhidden">field1</label>
                  <input type="text" id="field3" placeholder="Long Input Field">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label for="field4" class="visuallyhidden">field1</label>
                  <textarea id="field4" placeholder="Message Here"></textarea>
                </div>
              </div>
            </form>
          </div>
        </div>

        <h2>Dropdowns</h2>
        <div class="row">
          <div class="col-sm-9">
            <form action="">
              <div class="row">
                <div class="col-sm-5">
                  <label for="select" class="visuallyhidden">Select</label>
                  <select id="select" class="styled">
                    <option value="one">Drop down Selection Option One</option>
                    <option value="two">Drop down Selection Option Two</option>
                    <option value="three">Drop down Selection Option Three</option>
                    <option value="four">Drop down Selection Option Four</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-5">
                  <label for="select" class="visuallyhidden">Select</label>
                  <select id="select" class="styled">
                    <option value="one">Drop down Selection Option One</option>
                    <option value="two">Drop down Selection Option Two</option>
                    <option value="three">Drop down Selection Option Three</option>
                    <option value="four">Drop down Selection Option Four</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
        </div>

        <h2>Checkboxes</h2>
        <div class="row">
          <div class="col-sm-9">
            <form action="">
              <div class="row">
                <div class="col-sm-5">
                  <label class="uf-check"><input type="checkbox">Select</label>
                  <label class="uf-check"><input type="checkbox">Select</label>
                </div>
                <div class="col-sm-5">
                  <label class="uf-check"><input type="checkbox">Select</label>
                  <label class="uf-check"><input type="checkbox">Select</label>
                </div>
              </div>
            </form>
          </div>
        </div>

        <h2>Radio buttons</h2>
        <div class="row">
          <div class="col-sm-9">
            <form action="">
              <div class="row">
                <div class="col-sm-5">
                  <label class="uf-check"><input type="radio" name="radio">Select</label>
                  <label class="uf-check"><input type="radio" name="radio">Select</label>
                </div>
                <div class="col-sm-5">
                  <label class="uf-check"><input type="radio" name="radio">Select</label>
                  <label class="uf-check"><input type="radio" name="radio">Select</label>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

	<?php include 'inc/footer.php'; ?>
  <?php include 'inc/scripts.php'; ?>
</body>
</html>