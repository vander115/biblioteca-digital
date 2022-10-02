<main class="cont">
  <section class="turmas">
    <div class="options">
      <div class="option-item trigger" onclick="acao()">
        <span class="material-symbols-rounded">
          hotel_class
        </span>
        <label for="">
          Cadrastar Turma
        </label>
      </div>
    </div>
    <form class="search" method="GET" action="">
      <input type="hidden" name="p" value="turmas">
      <input type="text" name="qt" placeholder="Pesquisar Turma" value="<?php if (isset($_GET['qt'])) echo $_GET['qt']; ?>">
      <button class="icon" title="Pesquisar">
        <span class="material-symbols-rounded">
          search
        </span>
      </button>
    </form>
  </section>
</main>

<div class="modal">
  <div class="modal-cont">
    <div class="modal-header">
      <h1>
        <span class="material-symbols-rounded">
          magic_button
        </span>
        Cadrastar Turma
      </h1>
      <button class="close">
        <span class="material-symbols-rounded">
          close
        </span>
      </button>
    </div>
    <div class="modal-main">
      <form class="form-modal" method="POST" action="src/modules/page_turmas/cad_turma.php">
        <fieldset class="oneline-modal">
          <div><label for="">Nome</label><input name="nome" id="title" type="text"></div>
          <div class="ano">
            <label for="">Série</label>
            <select name="ano">
              <option disabled selected>Ano</option>
              <option value="1">1º</option>
              <option value="2">2º</option>
              <option value="3">3º</option>
            </select>
          </div>
        </fieldset>
        <fieldset><button>Cadrastar Turma</button></fieldset>
      </form>
    </div>
  </div>
</div>