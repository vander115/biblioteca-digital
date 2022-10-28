-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2022 às 21:38
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
(1, 'LGBTQIA+'),
(2, 'ROMANCE'),
(3, 'CONTO'),
(4, 'FICÇÃO');

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
(1, 'QUINZE DIAS', 1, 'VITOR MARTINS', 'SEGUINTE', '32754875378398527345', 3, 'disponivel', '2022-10-08'),
(3, 'DOM CASMURRO', 2, 'MACHADO DE ASSIS', 'INTRISECA', '327548753', 1, 'disponivel', '2022-10-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pessoa`
--

CREATE TABLE `tb_pessoa` (
  `idPessoa` int(11) NOT NULL,
  `nomePessoa` varchar(150) NOT NULL,
  `tipoPessoa` enum('Aluno','Funcionario') DEFAULT NULL,
  `turmaPessoa` int(11) NOT NULL,
  `tipoIdentPessoa` enum('CPF','Matricula') DEFAULT NULL,
  `identPessoa` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_pessoa`
--

INSERT INTO `tb_pessoa` (`idPessoa`, `nomePessoa`, `tipoPessoa`, `turmaPessoa`, `tipoIdentPessoa`, `identPessoa`) VALUES
(10, 'JOSÉ VANDERLEI FURTUNA TOMÉ', 'Aluno', 11, 'Matricula', '$2y$10$193s52RnxbycTLf/Drivn.FtnUNsjZnRz0nMleZYh4mlUpoVA5D3C'),
(11, 'JOÃO PEDRO DOS SANTOS SILVA', 'Aluno', 3, 'Matricula', '$2y$10$0KNkss1wkD.jX1Jkc96hI.RPrDUnyIKHR.4bhwZoRwLVCdPvh30ii'),
(12, 'MARIO ANDRÉ ARAUJO ALBUQUERQUE', 'Aluno', 11, 'Matricula', '$2y$10$u7ZgxkG/zK9QHyuVylERAOz0eAnPlvS0W62IsY05AnkuQyATFK/Qe');

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
  `statusReq` enum('em vigor','pendente','concluida') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_req`
--

INSERT INTO `tb_req` (`idReq`, `idPessoa`, `idLivro`, `dataReq`, `dataEntregaReq`, `statusReq`) VALUES
(1, 10, 1, '2022-10-16', '2022-10-21', 'em vigor'),
(2, 10, 1, '2022-10-16', '2022-10-21', 'em vigor'),
(3, 10, 1, '2022-10-16', '2022-10-21', 'em vigor'),
(4, 10, 3, '2022-10-16', '2022-10-21', 'em vigor'),
(5, 10, 1, '2022-10-16', '2022-10-31', 'em vigor'),
(6, 10, 1, '2022-10-16', '2022-10-21', 'em vigor'),
(7, 11, 3, '2022-10-25', '2022-10-30', 'em vigor'),
(8, 11, 1, '2022-10-25', '2022-10-30', 'em vigor'),
(9, 11, 1, '2022-10-26', '2022-10-31', 'em vigor'),
(10, 11, 3, '2022-10-26', '2022-11-25', 'em vigor');

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
(2, 'REDES DE COMPUTADORES', '1', 2022, 2024, 'egressa'),
(3, 'DESENVOLVIMENTO DE SISTEMAS', '1', 2022, 2024, 'egressa'),
(4, 'ADMINISTRAÇÃO', '1', 2022, 2024, 'egressa'),
(6, 'ELETROMECÂNICA', '1', 2022, 2024, 'egressa'),
(7, 'ELETROMECÂNICA', '2', 2021, 2023, 'egressa'),
(8, 'ELETROMECÂNICA', '3', 2020, 2022, 'egressa'),
(9, 'ADMINISTRAÇÃO', '2', 2021, 2023, 'egressa'),
(10, 'ADMINISTRAÇÃO', '3', 2020, 2022, 'egressa'),
(11, 'INFORMÁTICA', '3', 2020, 2022, 'egressa'),
(12, 'FINANÇAS', '2', 2021, 2023, 'egressa'),
(13, 'INFORMÁTICA', '2', 2021, 2023, 'egressa'),
(14, 'FINANÇAS', '3', 2020, 2022, 'egressa');

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
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_req`
--
ALTER TABLE `tb_req`
  MODIFY `idReq` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
