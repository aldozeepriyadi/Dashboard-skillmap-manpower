<div class='d-flex justify-content-center align-items-center h-100 w-100'>
    <div id='login-form-wrapper' class="w-25 h-50 m-5 background-light">
        <div class='w-100'>
            <img class='w-50' src="img/kyb-merah.png" alt="">
        </div>
        <div class="w-100 mt-2 mb-4">
            <p>
                Skill Map Man Power Dashboard
            </p>
        </div>
        <div class="w-100 h-100">
            <form action="actions/login.php" class='d-flex flex-column h-100'method="post">
                <div class='d-flex-row align-items-center'>
                    <div class="w-50">
                        <label class='m-0' for="username">Username:</label>
                    </div>
                    <div class="w-100">
                        <input class="login-input" type="text" name="username" id="username" required>
                    </div>
                </div>
                <div class='d-flex-row pt-3 align-items-center'>
                    <div class="w-50">
                        <label class='m-0' for="password">Password:</label>
                    </div>
                    <div class="w-100">
                        <input class="login-input" type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="w-100 flex-float-bottom mb-3">
                    <input class='cu-submit-btn w-25' type="submit" value="LOGIN">
                </div>
            </form>
        </div>
    </div>
</div>