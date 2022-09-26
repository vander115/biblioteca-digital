  
    <main class="container">
        <div class="bar"></div>
        <div class="bar2"></div>
        <form id="login-form" method="POST" autocomplete="off" action="src/modules/val_user.php">
            <div class="logo">
                <div class="logo-cont">
                    <div class="b">
                        <div class="b1"></div>
                        <div class="b2"></div>
                    </div>
                    <div class="d"></div>
                </div>
            </div>

            <div class="oneline">
                <input placeholder="  Usuário" id="login" name="login" type="text">
                <input id="pass" placeholder="  Senha" name="pass" type="password">
            </div>

            <div class="show">
                <label class="switch">
                    <input class="show" onclick="view()" type="checkbox">
                    <span class="slider round"></span>
                </label>
                <p class="title">Mostrar Senha</p>
            </div>
            <button class="submit" type="button" onclick="loginVerify()">Entrar</button>
        </form>
    </main>
    
    <script type="text/javascript">
        const loginForm = document.getElementById('login-form');
        const loginInput = document.getElementById('login');
        const passInput = document.getElementById('pass'); 

        loginInput.addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                passInput.focus();
            }
        })
        
        passInput.addEventListener('keypress', (e) => {
            if (e.key === "Enter") {
                loginVerify();
            }
        })

        const view = () => {
            if (passInput.type === "text") {
                passInput.type = "password";
            } else {
                passInput.type = "text";
            }
        }

        const loginVerify = () => {
            if (loginInput.value === "") {
                toastr.warning("Informe seu endereço de login!");
                loginInput.focus();
                return;
            }
            if (passInput.value === "") {
                toastr.warning("Informe sua senha!");
                passInput.focus();
                return;
            }
            loginForm.submit();
        }
    </script>