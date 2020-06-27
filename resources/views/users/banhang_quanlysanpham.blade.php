@extends('users.banhang')
@section('content')
 <div class="row">
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Basic Input</label>
              <input class="form-control" id="basicInput" name="nameproduct"type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Input text with help</label>
              <small class="text-muted">eg.<i>someone@example.com</i></small>
              <input class="form-control" id="helpInputTop" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Disabled Input</label>
              <input class="form-control" id="disabledInput" disabled="" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Readonly Input</label>
              <input class="form-control" id="readonlyInput" readonly value="You can't update me :P" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Input with Placeholder</label>
              <input class="form-control" id="placeholderInput" placeholder="Enter Email Address" type="email">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Static Text</label>
              <p class="form-control-static m-bot-1" id="staticInput">email@pixinvent.com</p>
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Rounded Input</label>
              <input id="roundText" class="form-control round" placeholder="Rounded Input" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Square Input</label>
              <input id="squareText" class="form-control square" placeholder="square Input" type="text">
            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>With Helper Text</label>
              <input id="helperText" class="form-control" placeholder="Name" type="text">
              <p> <small class="text-muted">Find helper text here for given textbox.</small> </p>
            </fieldset>
          </div>
          <div class="col-lg-12">
            <fieldset class="form-group">
              <label>Textarea with Description</label>
              <textarea class="form-control" id="descTextarea" rows="3" placeholder="Textarea with description" style="height: 300px"></textarea>
            </fieldset>
          </div>
        </div>        
@endsection
