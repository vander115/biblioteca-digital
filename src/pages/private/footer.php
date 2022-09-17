</body>


<script type="text/javascript">

    const modal = document.querySelector('.modal');

    const acao = () => {
        modal.style.display = 'flex';
    };
    function close() {
        modal.style.display = 'none';
    };

    modal.style.display = 'flex';
    }

    const close = () => {
    
    let modal = document.querySelector('.modal');

    modal.style.display = 'none';

    }

    const button = document.querySelector('.close');

    button.addEventListener('click', close, false);

    const pass = document.querySelector('#pass');

    function view() {
        if (pass.type === "text") {
            pass.type = "password";
        } else {
            pass.type = "text";
        }
    }

    const show = document.querySelector('.show');

    show.addEventListener('click', view, false);
</script>

</html>