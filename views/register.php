<script type="module" src="js/register.js"></script>

<h1 id="h1title">Register</h1>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label id="lfname">First Name</label>
            <input id="ifname" type="text" name="firstname" value="Yves" class="form-control ">
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label id="llname">Last name</label>
            <input id="ilname"  type="text" name="lastname" value="Toubhans" class="form-control ">
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label id="lemail">Your email</label>
    <input id="iemail"  type="text" name="email" value="y@free.fr" class="form-control ">
    <div class="invalid-feedback">
    </div>
</div>
<div class="form-group">
    <label id="lpassword">Your password</label>
    <input id="ipassword"  type="password" name="password" value="" class="form-control ">
    <div class="invalid-feedback">

    </div>
</div>
<div class="form-group">
    <label id="lpasswordcheck">Password check</label>
    <input id="ipasswordcheck"  type="password" name="confirmPassword" value="" class="form-control ">
    <div class="invalid-feedback">
    </div>
</div>
<button id="b-registeruser" class="btn btn-primary mt-3">Submit</button>
