<?php
/**
 * Template Name: Form Style Guide
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

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

<?php get_footer(); ?>