</body>

<script type="text/javascript">
    const acao = () => {
    
    let modal = document.querySelector('.modal');

    modal.style.display = 'flex';
    }

    const close = () => {
    
    let modal = document.querySelector('.modal');

    modal.style.display = 'none';

    }

    const button = document.querySelector('.close');

    button.addEventListener('click', close, false);
</script>
</html>