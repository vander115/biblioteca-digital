-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Nov-2022 às 02:49
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
(3, 'DOM CASMURRO', 2, 'MACHADO DE ASSIS', 'INTRISECA', '327548753', 3, 'disponivel', '2022-10-16'),
(7, 'TRISTE FIM DE POLICARPO QUARESMA', 2, 'LIMA BARRETO', 'EDITORA RIDEEL', '12.600/16', 1, 'disponivel', '2022-11-06'),
(8, 'A ESCRAVA ISAURA', 2, 'BERNARDO GUIMARÃES', 'LPM', '12.640/16', 1, 'disponivel', '2022-11-06'),
(9, 'O SEMINARISTA', 2, 'BERNARDO GUIMARÃES', 'SEGUINTE', '12.64/16', 3, 'disponivel', '2022-11-06');

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
(14, 'WILKEMAR', 'Professor', 0, '', '$2y$10$x.bndl.NXiq1ScGgpNcnI.QQMa6MlLFaqvZ/.twwFNCR9WmSb8P2S', 'ativo');

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
  `statusReq` enum('ativa','pendente','concluida') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_req`
--

INSERT INTO `tb_req` (`idReq`, `idPessoa`, `idLivro`, `dataReq`, `dataEntregaReq`, `statusReq`) VALUES
(25, 12, 1, '2022-11-05', '2022-11-10', 'concluida'),
(26, 14, 3, '2022-12-06', '2022-11-11', 'concluida'),
(27, 12, 3, '2022-11-06', '2022-11-11', 'ativa'),
(28, 12, 8, '2022-11-07', '2022-12-12', 'ativa');

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
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_req`
--
ALTER TABLE `tb_req`
  MODIFY `idReq` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
