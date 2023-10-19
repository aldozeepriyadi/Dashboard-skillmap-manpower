<div id='content'>
    <div id='login-form-wrapper' class="w-50 h-50 m-5">
        <div class="w-100">
            <p>
                LOGIN
            </p>
        </div>
        <div class="w-100">
            <form action="actions/login.php" method="post">
                <div class='d-flex-row align-items-center'>
                    <div class="w-100">
                        <label class='m-0' for="username">Username:</label>
                    </div>
                    <div class="w-100">
                        <input class="login-input" type="text" name="username" id="username" required>
                    </div>
                </div>
                <div class='d-flex-row pt-3 align-items-center'>
                    <div class="w-100">
                        <label class='m-0' for="password">Password:</label>
                    </div>
                    <div class="w-100">
                        <input class="login-input" type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="w-100 mt-5">
                    <input class='cu-submit-btn w-25' type="submit" value="LOGIN">
                </div>
            </form>
    </div>
</div>