-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Dez-2022 às 19:24
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_biblioteca_digital`
--
CREATE DATABASE IF NOT EXISTS `bd_biblioteca_digital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_biblioteca_digital`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_adm`
--

CREATE TABLE `tb_adm` (
  `idAdm` int(11) NOT NULL,
  `nomeAdm` varchar(60) DEFAULT NULL,
  `loginAdm` varchar(100) DEFAULT NULL,
  `passAdm` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_adm`
--

INSERT INTO `tb_adm` (`idAdm`, `nomeAdm`, `loginAdm`, `passAdm`) VALUES
(1, 'Biblioteca', 'biblio', '$2y$10$0FettP3iAU4rPqE0UD9rMeQO3cWQB2LyYNRHXDGKtYTT4y9c9plWW');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_genero_livro`
--

CREATE TABLE `tb_genero_livro` (
  `idGenero` int(11) NOT NULL,
  `nomeGenero` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_genero_livro`
--

INSERT INTO `tb_genero_livro` (`idGenero`, `nomeGenero`) VALUES
(2, 'ROMANCE'),
(5, 'REVISTAS E QUADRINHOS'),
(6, 'LITERATURA NACIONAL'),
(7, 'LITERATURA ESTRANGEIRA'),
(8, 'INFANTO JUVENIL'),
(10, 'AUTOAJUDA E MOTIVACIONAIS'),
(11, 'POEMA E POESIA'),
(12, 'TEATRO'),
(13, 'CRÔNICA'),
(14, 'BIOGRAFIAS'),
(15, 'CÍRCULO DE LEITURA'),
(16, 'FILOSOFIA '),
(17, 'BIOLOGIA '),
(18, 'GEOGRAFIA'),
(19, 'HISTÓRIA'),
(20, 'MATEMÁTICA'),
(21, 'LITERATURA'),
(22, 'GRAMÁTICA'),
(23, 'FÍSICA'),
(24, 'QUÍMICA'),
(25, 'SOCIOLOGIA'),
(26, 'INGLÊS'),
(27, 'ESPANHOL'),
(28, 'INFORMÁTICA'),
(29, 'ELETROMECÂNICA'),
(30, 'ENFERMAGEM'),
(31, 'FINANÇAS'),
(32, 'REDES DE COMPUTADORES'),
(33, 'ADMINISTRAÇÃO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_livros`
--

CREATE TABLE `tb_livros` (
  `idLivro` int(11) NOT NULL,
  `tituloLivro` varchar(150) DEFAULT NULL,
  `generoLivro` int(11) NOT NULL,
  `autorLivro` varchar(100) NOT NULL,
  `editoraLivro` varchar(80) DEFAULT NULL,
  `tomboLivro` varchar(150) NOT NULL,
  `qtdLivro` int(11) NOT NULL,
  `statusLivro` enum('disponivel','emprestado','perdido') DEFAULT NULL,
  `dataCadLivro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_livros`
--

INSERT INTO `tb_livros` (`idLivro`, `tituloLivro`, `generoLivro`, `autorLivro`, `editoraLivro`, `tomboLivro`, `qtdLivro`, `statusLivro`, `dataCadLivro`) VALUES
(1, 'QUINZE DIAS', 2, 'VITOR MARTINS', 'SEGUINTE', '32754875378398527345', 2, 'disponivel', '2022-10-08'),
(3, 'DOM CASMURRO', 2, 'MACHADO DE ASSIS', 'INTRISECA', '327548753', 2, 'disponivel', '2022-10-16'),
(7, 'TRISTE FIM DE POLICARPO QUARESMA', 2, 'LIMA BARRETO', 'EDITORA RIDEEL', '12.600/16', 0, 'emprestado', '2022-11-06'),
(9, 'O SEMINARISTA', 2, 'BERNARDO GUIMARÃES', 'SEGUINTE', '12.64/16', 3, 'disponivel', '2022-11-06'),
(10, 'EU ESTOU MAIS PERTO DO QUE VOCÊ IMAGINA', 2, 'VANDERLEI FURTUNA', 'SUNCAT', '123456', 1, 'disponivel', '2022-11-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pessoa`
--

CREATE TABLE `tb_pessoa` (
  `idPessoa` int(11) NOT NULL,
  `nomePessoa` varchar(150) NOT NULL,
  `tipoPessoa` enum('Aluno','Professor','Diretor','Coordenador','Secretário','Limpeza','Funcionário') DEFAULT NULL,
  `turmaPessoa` int(11) NOT NULL,
  `tipoIdentPessoa` enum('CPF','Matricula') DEFAULT NULL,
  `identPessoa` varchar(300) NOT NULL,
  `statusPessoa` enum('ativo','inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_pessoa`
--

INSERT INTO `tb_pessoa` (`idPessoa`, `nomePessoa`, `tipoPessoa`, `turmaPessoa`, `tipoIdentPessoa`, `identPessoa`, `statusPessoa`) VALUES
(12, 'MARIO ANDRÉ ARAUJO ALBUQUERQUE', 'Aluno', 11, 'Matricula', '$2y$10$IiPW3ErVXrDGVDQtsLta/ObZqrfDvjsxQjN1XqzFzE2sc/tkGBe3i', 'ativo'),
(14, 'WILKEMAR', 'Professor', 0, 'CPF', '$2y$10$AsjotRU/qNzfeQswGzf6P.BrUPJBl9F9EkRYzaED0of8Uu0e1jVcS', 'ativo'),
(15, 'JOSÉ VANDERLEI FURTUNA TOMÉ', 'Aluno', 11, 'Matricula', '$2y$10$kfrjeVCOeTMiKd6LXhVj2utS6YG6sSJe1jqVdcs67sO3Q3BUlMW.6', 'ativo'),
(16, 'JANIEL', 'Aluno', 2, 'CPF', '$2y$10$V3HsEMLRztRZqUAU9tNl3uasMOmyoNZ0oDtXIunmDNtNq2k4BSbhO', 'ativo'),
(19, 'JOSÉ VANDERLEI FURTUNA TOMÉ', 'Aluno', 8, 'Matricula', '$2y$10$gKHofR/Q8tUeCsButKddluT5mFrpE4cOFnK2cYMWDo9FSg9ZShEF2', 'inativo'),
(20, 'DAYLLON', 'Aluno', 2, 'Matricula', '$2y$10$ybnS3DEssMflnOZwiCKKSObP2HPhWYLbAUwOgqfM6DkzBTCg74YZy', 'ativo'),
(21, 'BEATRIZ', 'Aluno', 12, 'CPF', '$2y$10$v2bUTj0nhx2xJIPryzL17.ZP/.lRe2niKoLcofR6dXgdqC4.eI/LG', 'ativo'),
(22, 'KALLINA', 'Aluno', 12, 'CPF', '$2y$10$Qt1ti1sJLR0ofQusnDttmOGD5z6r21Tpg9IeTtcwNgjRGOr8GduiC', 'ativo'),
(23, 'MÁRCIO', 'Coordenador', 0, 'CPF', '$2y$10$2wklDaUWnmcgPjeYW6tGoOvEosWO4.Mh1zN7gnexdxBCOrB72aSFC', 'ativo'),
(24, 'TIA VAL', 'Limpeza', 0, 'CPF', '$2y$10$w3DHjngQ3WYmONOAxAJHLewSfX5Ql9uFgzvyhPbQPj1nln67cG2w.', 'ativo'),
(25, 'NAÍSA', 'Professor', 0, 'CPF', '$2y$10$3I2UD1xGjF3Q8B1aK5PQgebaRfLStd.ZyjNPQBdP0cmBl0LBuU8lS', 'ativo'),
(26, 'VICENTE', 'Professor', 0, 'CPF', '$2y$10$HJWjNJnmAoYTJ56.ZfhkG.k5Qk4IXehT.pYDayT9DrZiIpgeCmaeS', 'ativo'),
(27, 'DANIELA', 'Diretor', 0, 'Matricula', '$2y$10$k15wRP632YuM4J6MugnS8e3sMWpdcaXZIOx2qnP8YQXkND6GJfLtC', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_req`
--

CREATE TABLE `tb_req` (
  `idReq` smallint(6) NOT NULL,
  `idPessoa` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `dataReq` date DEFAULT NULL,
  `dataEntregaReq` date DEFAULT NULL,
  `statusReq` enum('ativa','pendente','concluida') DEFAULT NULL,
  `qtdReq` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_req`
--

INSERT INTO `tb_req` (`idReq`, `idPessoa`, `idLivro`, `dataReq`, `dataEntregaReq`, `statusReq`, `qtdReq`) VALUES
(36, 12, 7, '2022-11-24', '2022-11-28', 'pendente', 1),
(37, 14, 9, '2022-11-29', '2022-12-04', 'concluida', 1),
(38, 19, 3, '2022-11-29', '2022-12-04', 'concluida', 1),
(39, 20, 3, '2022-12-08', '2022-12-13', 'concluida', 1),
(40, 22, 10, '2022-12-08', '2022-12-13', 'concluida', 1),
(41, 21, 3, '2022-12-08', '2022-12-13', 'ativa', 1),
(42, 12, 3, '2022-12-08', '2022-12-13', 'ativa', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turma`
--

CREATE TABLE `tb_turma` (
  `idTurma` int(11) NOT NULL,
  `nomeTurma` varchar(100) NOT NULL,
  `anoTurma` enum('1','2','3') DEFAULT NULL,
  `anoInicial` smallint(6) DEFAULT NULL,
  `anoFinal` smallint(6) DEFAULT NULL,
  `statusTurma` enum('egressa','concluida') DEFAULT 'egressa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_turma`
--

INSERT INTO `tb_turma` (`idTurma`, `nomeTurma`, `anoTurma`, `anoInicial`, `anoFinal`, `statusTurma`) VALUES
(0, 'FUNCIONÁRIOS', '1', 0, 0, 'concluida'),
(2, 'REDES DE COMPUTADORES', '1', 2022, 2024, 'egressa'),
(3, 'DESENVOLVIMENTO DE SISTEMAS', '1', 2022, 2024, 'egressa'),
(6, 'ELETROMECÂNICA', '1', 2022, 2024, 'egressa'),
(7, 'ELETROMECÂNICA', '2', 2021, 2023, 'egressa'),
(8, 'ELETROMECÂNICA', '3', 2020, 2022, 'egressa'),
(9, 'ADMINISTRAÇÃO', '2', 2021, 2023, 'egressa'),
(10, 'ADMINISTRAÇÃO', '3', 2020, 2022, 'egressa'),
(11, 'INFORMÁTICA', '3', 2020, 2022, 'egressa'),
(12, 'FINANÇAS', '2', 2021, 2023, 'egressa'),
(13, 'INFORMÁTICA', '2', 2021, 2023, 'egressa'),
(14, 'FINANÇAS', '3', 2020, 2022, 'egressa'),
(17, 'ADMINISTRAÇÃO', '1', 2022, 2024, 'egressa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_adm`
--
ALTER TABLE `tb_adm`
  ADD PRIMARY KEY (`idAdm`);

--
-- Índices para tabela `tb_genero_livro`
--
ALTER TABLE `tb_genero_livro`
  ADD PRIMARY KEY (`idGenero`);

--
-- Índices para tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD PRIMARY KEY (`idLivro`),
  ADD UNIQUE KEY `tomboLivro` (`tomboLivro`),
  ADD KEY `generoLivro` (`generoLivro`);

--
-- Índices para tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  ADD PRIMARY KEY (`idPessoa`),
  ADD KEY `turmaPessoa` (`turmaPessoa`);

--
-- Índices para tabela `tb_req`
--
ALTER TABLE `tb_req`
  ADD PRIMARY KEY (`idReq`),
  ADD KEY `idPessoa` (`idPessoa`),
  ADD KEY `idLivro` (`idLivro`);

--
-- Índices para tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  ADD PRIMARY KEY (`idTurma`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_adm`
--
ALTER TABLE `tb_adm`
  MODIFY `idAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_genero_livro`
--
ALTER TABLE `tb_genero_livro`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_req`
--
ALTER TABLE `tb_req`
  MODIFY `idReq` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD CONSTRAINT `tb_livros_ibfk_1` FOREIGN KEY (`generoLivro`) REFERENCES `tb_genero_livro` (`idGenero`);

--
-- Limitadores para a tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  ADD CONSTRAINT `tb_pessoa_ibfk_1` FOREIGN KEY (`turmaPessoa`) REFERENCES `tb_turma` (`idTurma`);

--
-- Limitadores para a tabela `tb_req`
--
ALTER TABLE `tb_req`
  ADD CONSTRAINT `tb_req_ibfk_1` FOREIGN KEY (`idPessoa`) REFERENCES `tb_pessoa` (`idPessoa`),
  ADD CONSTRAINT `tb_req_ibfk_2` FOREIGN KEY (`idLivro`) REFERENCES `tb_livros` (`idLivro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
