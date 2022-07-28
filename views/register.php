<h1>Register</h1>

<form action="" method="post">
    <div class="row">
        <div class="col">

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" value="Yves" class="form-control ">
                <div class="invalid-feedback"></div>
                <div class="col">

                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" name="lastname" value="Toubhans" class="form-control ">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Your email</label>
                <input type="text" name="email" value="y@free.fr" class="form-control ">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label>Your password</label>
                <input type="password" name="password" value="" class="form-control ">
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label>Password check</label>
                <input type="password" name="confirmPassword" value="" class="form-control ">
                <div class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
</form>

<style>
    .btn {
        margin-top: 20px;
    }
</style>